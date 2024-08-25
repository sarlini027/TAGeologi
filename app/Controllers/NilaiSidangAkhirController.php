<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailIndikatorPenilaian;
use App\Models\IndikatorPenilaian;
use App\Models\SeminarHasil;
use App\Models\SeminarKemajuan;
use App\Models\SidangAkhir;
use App\Models\TempPenilaian;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiSidangAkhirController extends BaseController
{
    public function index()
    {
        // session get user
        $session = session();
        $user = $session->get('user');

        $data['title'] = 'Nilai Sidang Akhir';

        // get seminar hasil
        $sidangAkhirModel = new SidangAkhir();
        $data['listAccSidangAkhir'] = $sidangAkhirModel
            ->select('sidang_akhir.*, users.nama_lengkap, users.username')
            ->join('users', 'users.id = sidang_akhir.user_id')
            ->where('status_validasi', true)
            ->groupStart()
            ->orWhere('id_dosen_penguji_1', $user['id'])
            ->orWhere('id_dosen_penguji_2', $user['id'])
            ->orWhere('id_dosen_pembimbing_1', $user['id'])
            ->orWhere('id_dosen_pembimbing_2', $user['id'])
            ->groupEnd()
            ->findAll();

        $maksimal_bobot = (new DetailIndikatorPenilaian())->getMaksBobot("sidang_akhir");

        // merge array data list acc sidang akhir & show nilai
        $data['listAccSidangAkhir'] = array_map(function ($sidangAkhir) use ($maksimal_bobot, $user) {
            $tempPenilaianModel = new TempPenilaian();
            $nilaiSidangAkhir = $tempPenilaianModel
                ->join('detail_indikator_penilaian', 'detail_indikator_penilaian.id = temp_penilaian.id_detail_indikator')
                ->join('indikator_penilaian', 'indikator_penilaian.id = detail_indikator_penilaian.id_indikator')
                ->where('indikator_penilaian.tipe', 'sidang_akhir')
                ->where('id_mahasiswa', $sidangAkhir['user_id'])
                ->where('id_dosen', $user['id'])
                ->findAll();

            if (count($nilaiSidangAkhir) > 0) {
                if ($maksimal_bobot > 0) {
                    $total_nilai = (array_sum(array_column($nilaiSidangAkhir, 'bobot')) / $maksimal_bobot) * 100;
                    $total_nilai = number_format($total_nilai, 2);
                } else {
                    $total_nilai = 0;
                }
            } else {
                $total_nilai = 0;
            }

            return [
                ...$sidangAkhir,
                'nilai' => $nilaiSidangAkhir,
                'jumlah_nilai' => $total_nilai,
            ];
        }, $data['listAccSidangAkhir']);

        // Nilai Total dari seluruh dosen penguji dan pembimbing
        $data['nilaiTotal'] = [];
        foreach ($data['listAccSidangAkhir'] as $sidangAkhir) {
            $tempPenilaianModel = new TempPenilaian();
            $nilaiSidangAkhir = $tempPenilaianModel
                ->join('detail_indikator_penilaian', 'detail_indikator_penilaian.id = temp_penilaian.id_detail_indikator')
                ->join('indikator_penilaian', 'indikator_penilaian.id = detail_indikator_penilaian.id_indikator')
                ->where('indikator_penilaian.tipe', 'sidang_akhir')
                ->where('id_mahasiswa', $sidangAkhir['user_id'])
                ->findAll();

            if (count($nilaiSidangAkhir) > 0) {
                if ($maksimal_bobot > 0) {
                    $total_nilai = (array_sum(array_column($nilaiSidangAkhir, 'bobot')) / $maksimal_bobot) * 100;
                    $total_nilai = number_format($total_nilai, 2);

                    // total nilai / jumlah dosen yg memberikan nilai (di disctinct) 
                    $total_nilai = ($total_nilai / count(array_unique(array_column($nilaiSidangAkhir, 'id_dosen'))));
                    $total_nilai = number_format($total_nilai, 2);
                } else {
                    $total_nilai = 0;
                }
            } else {
                $total_nilai = 0;
            }

            $data['nilaiTotal'][] = [
                'id_mahasiswa' => $sidangAkhir['user_id'],
                'jumlah_nilai' => $total_nilai,
            ];
        }

        // merge nilai total ke list acc seminar hasil dengan cara looping
        foreach ($data['listAccSidangAkhir'] as $key => $value) {
            $data['listAccSidangAkhir'][$key]['nilaiTotal'] = 0;
            foreach ($data['nilaiTotal'] as $nilaiTotal) {
                if ($value['user_id'] == $nilaiTotal['id_mahasiswa']) {
                    $data['listAccSidangAkhir'][$key]['nilaiTotal'] = $nilaiTotal['jumlah_nilai'];
                }
            }
        }

        $data['formattedDataIndikatorPenilaian'] = $this->getDataIndikatorPenilaian('sidang_akhir');

        // return response()->setJSON($data);
        return view('dashboard/nilai-sidang-akhir/index', $data);
    }

    public function storeNilai()
    {
        // return response()->setJSON($this->request->getPost());

        $listIdIndikator = $this->request->getPost('id_indikator');
        $listIdDetailIndikator = $this->request->getPost('id_detail_indikator');

        $tempPenilaianModel = new TempPenilaian();

        if (count($listIdIndikator) > 0 && count($listIdDetailIndikator) > 0) {
            $dataTempPenilaian = [];

            for ($i = 0; $i < count($listIdIndikator); $i++) {
                array_push($dataTempPenilaian, [
                    'id_indikator'          => $listIdIndikator[$i],
                    'id_detail_indikator'   => $listIdDetailIndikator[$i],
                    'id_dosen'              => session()->get('user')['id'],
                    'id_mahasiswa'          => $this->request->getPost('id_mahasiswa')
                ]);
            }

            // Insert new
            $tambahNilai = $tempPenilaianModel->insertBatch($dataTempPenilaian);

            if ($tambahNilai) {
                return redirect()->back()->with('success', 'Berhasil menginput nilai');
            } else {
                return redirect()->back()->with('error', 'Gagal menginput nilai');
            }
        }

        return redirect()->back()->with('error', 'Silahkan Pilih Indikator!');
    }

    public function updateNilai()
    {
        $listIdIndikator = $this->request->getPost('id_indikator');
        $listIdDetailIndikator = $this->request->getPost('id_detail_indikator');

        $tempPenilaianModel = new TempPenilaian();

        if (count($listIdIndikator) > 0 && count($listIdDetailIndikator) > 0) {
            $dataTempPenilaian = [];

            for ($i = 0; $i < count($listIdIndikator); $i++) {
                array_push($dataTempPenilaian, [
                    'id_indikator'          => $listIdIndikator[$i],
                    'id_detail_indikator'   => $listIdDetailIndikator[$i],
                    'id_dosen'              => session()->get('user')['id'],
                    'id_mahasiswa'          => $this->request->getPost('id_mahasiswa')
                ]);

                $deleteOld = $tempPenilaianModel
                    ->where('id_mahasiswa', $this->request->getPost('id_mahasiswa'))
                    ->where('id_dosen', session()->get('user')['id'])
                    ->where('id_indikator', $listIdIndikator[$i])
                    ->delete();
            }

            // Delete old

            // Insert new
            $tambahNilai = $tempPenilaianModel->insertBatch($dataTempPenilaian);

            if ($tambahNilai) {
                return redirect()->back()->with('success', 'Berhasil mengupdate nilai');
            } else {
                return redirect()->back()->with('error', 'Gagal mengupdate nilai');
            }
        }

        return redirect()->back()->with('error', 'Silahkan Pilih Indikator!');
    }

    protected function getDataIndikatorPenilaian($tipe)
    {
        $indikatorPenilaianModel = new IndikatorPenilaian();
        $listIndikatorPenilaian = $indikatorPenilaianModel->where('tipe', $tipe)->findAll();

        $detailIndikatorPenilaianModel = new DetailIndikatorPenilaian();

        $formattedDataIndikatorPenilaian = [];
        foreach ($listIndikatorPenilaian as $row) {
            $listDetailIndikatorPenilaian = $detailIndikatorPenilaianModel->where('id_indikator', $row['id'])->orderBy('bobot', 'desc')->findAll();

            $formattedDataIndikatorPenilaian[] = [
                ...$row,
                'detail_indikator' => $listDetailIndikatorPenilaian,
            ];
        }

        return $formattedDataIndikatorPenilaian;
    }
}
