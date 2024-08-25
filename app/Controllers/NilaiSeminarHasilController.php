<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailIndikatorPenilaian;
use App\Models\IndikatorPenilaian;
use App\Models\SeminarHasil;
use App\Models\SeminarKemajuan;
use App\Models\TempPenilaian;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiSeminarHasilController extends BaseController
{
    public function index()
    {
        // session get user
        $session = session();
        $user = $session->get('user');

        $data['title'] = 'Nilai Seminar Hasil';

        // get seminar hasil
        $seminarHasilModel = new SeminarHasil();
        $data['listAccSeminarHasil'] = $seminarHasilModel
            ->select('seminar_hasil.*, users.nama_lengkap, users.username')
            ->join('users', 'users.id = seminar_hasil.user_id')
            ->where('status_validasi', true)
            ->groupStart()
            ->orWhere('id_dosen_penguji_1', $user['id'])
            ->orWhere('id_dosen_penguji_2', $user['id'])
            ->orWhere('id_dosen_pembimbing_1', $user['id'])
            ->orWhere('id_dosen_pembimbing_2', $user['id'])
            ->groupEnd()
            ->findAll();

        $maksimal_bobot = (new DetailIndikatorPenilaian())->getMaksBobot("seminar_hasil");

        // merge array data list acc seminar kemajuan & show nilai
        $data['listAccSeminarHasil'] = array_map(function ($seminarHasil) use ($maksimal_bobot, $user) {
            $tempPenilaianModel = new TempPenilaian();
            $nilaiSeminarHasil = $tempPenilaianModel
                ->join('detail_indikator_penilaian', 'detail_indikator_penilaian.id = temp_penilaian.id_detail_indikator')
                ->join('indikator_penilaian', 'indikator_penilaian.id = detail_indikator_penilaian.id_indikator')
                ->where('indikator_penilaian.tipe', 'seminar_hasil')
                ->where('id_mahasiswa', $seminarHasil['user_id'])
                ->where('id_dosen', $user['id'])
                ->findAll();

            if (count($nilaiSeminarHasil) > 0) {
                if ($maksimal_bobot > 0) {
                    $total_nilai = (array_sum(array_column($nilaiSeminarHasil, 'bobot')) / $maksimal_bobot) * 100;
                    $total_nilai = number_format($total_nilai, 2);
                } else {
                    $total_nilai = 0;
                }
            } else {
                $total_nilai = 0;
            }

            return [
                ...$seminarHasil,
                'nilai' => $nilaiSeminarHasil,
                'jumlah_nilai' => $total_nilai,
            ];
        }, $data['listAccSeminarHasil']);

        // Nilai Total dari seluruh dosen penguji dan pembimbing
        $data['nilaiTotal'] = [];
        foreach ($data['listAccSeminarHasil'] as $seminarHasil) {
            $tempPenilaianModel = new TempPenilaian();
            $nilaiSeminarHasil = $tempPenilaianModel
                ->join('detail_indikator_penilaian', 'detail_indikator_penilaian.id = temp_penilaian.id_detail_indikator')
                ->join('indikator_penilaian', 'indikator_penilaian.id = detail_indikator_penilaian.id_indikator')
                ->where('indikator_penilaian.tipe', 'seminar_hasil')
                ->where('id_mahasiswa', $seminarHasil['user_id'])
                ->findAll();

            if (count($nilaiSeminarHasil) > 0) {
                if ($maksimal_bobot > 0) {
                    $total_nilai = (array_sum(array_column($nilaiSeminarHasil, 'bobot')) / $maksimal_bobot) * 100;
                    $total_nilai = number_format($total_nilai, 2);

                    // total nilai / jumlah dosen yg memberikan nilai (di disctinct) 
                    $total_nilai = ($total_nilai / count(array_unique(array_column($nilaiSeminarHasil, 'id_dosen'))));
                    $total_nilai = number_format($total_nilai, 2);
                } else {
                    $total_nilai = 0;
                }
            } else {
                $total_nilai = 0;
            }

            $data['nilaiTotal'][] = [
                'id_mahasiswa' => $seminarHasil['user_id'],
                'jumlah_nilai' => $total_nilai,
            ];
        }

        // merge nilai total ke list acc seminar hasil dengan cara looping
        foreach ($data['listAccSeminarHasil'] as $key => $value) {
            $data['listAccSeminarHasil'][$key]['nilaiTotal'] = 0;
            foreach ($data['nilaiTotal'] as $nilaiTotal) {
                if ($value['user_id'] == $nilaiTotal['id_mahasiswa']) {
                    $data['listAccSeminarHasil'][$key]['nilaiTotal'] = $nilaiTotal['jumlah_nilai'];
                }
            }
        }

        $data['formattedDataIndikatorPenilaian'] = $this->getDataIndikatorPenilaian('seminar_hasil');

        // return response()->setJSON($data);
        return view('dashboard/nilai-seminar-hasil/index', $data);
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
