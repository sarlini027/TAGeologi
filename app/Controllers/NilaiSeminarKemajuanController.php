<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailIndikatorPenilaian;
use App\Models\IndikatorPenilaian;
use App\Models\SeminarKemajuan;
use App\Models\TempPenilaian;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiSeminarKemajuanController extends BaseController
{
    public function index()
    {
        // session get user
        $session = session();
        $user = $session->get('user');

        $data['title'] = 'Nilai Seminar Kemajuan';

        // get seminar kemajuan
        $seminarKemajuanModel = new SeminarKemajuan();
        $data['listAccSeminarKemajuan'] = $seminarKemajuanModel
            ->select('seminar_kemajuan.*, users.nama_lengkap, users.username')
            ->join('users', 'users.id = seminar_kemajuan.user_id')
            ->where('status_validasi', true)
            ->groupStart()
                ->orWhere('id_dosen_penguji_1', $user['id'])
                ->orWhere('id_dosen_penguji_2', $user['id'])
                ->orWhere('id_dosen_pembimbing_1', $user['id'])
                ->orWhere('id_dosen_pembimbing_2', $user['id'])
            ->groupEnd()
            ->findAll();

        $maksimal_bobot = (new DetailIndikatorPenilaian())->getMaksBobot("seminar_kemajuan");

        // merge array data list acc seminar kemajuan & show nilai
        $data['listAccSeminarKemajuan'] = array_map(function ($seminarKemajuan) use ($maksimal_bobot, $user) {
            $tempPenilaianModel = new TempPenilaian();
            $nilaiSeminarKemajuan = $tempPenilaianModel
                ->join('detail_indikator_penilaian', 'detail_indikator_penilaian.id = temp_penilaian.id_detail_indikator')
                ->where('id_mahasiswa', $seminarKemajuan['user_id'])
                ->where('id_dosen', $user['id'])
                ->findAll();

            if (count($nilaiSeminarKemajuan) > 0) {
                $total_nilai = (array_sum(array_column($nilaiSeminarKemajuan, 'bobot')) / $maksimal_bobot) * 100;
                $total_nilai = number_format($total_nilai, 2);
            } else {
                $total_nilai = 0;
            }

            return [
                ...$seminarKemajuan,
                'nilai' => $nilaiSeminarKemajuan,
                'jumlah_nilai' => $total_nilai,
            ];
        }, $data['listAccSeminarKemajuan']);

        // return response()->setJSON($data);

        // Nilai Total dari seluruh dosen penguji dan pembimbing
        $data['nilaiTotal'] = [];
        foreach ($data['listAccSeminarKemajuan'] as $seminarKemajuan) {
            $tempPenilaianModel = new TempPenilaian();
            $nilaiSeminarKemajuan = $tempPenilaianModel
                ->join('detail_indikator_penilaian', 'detail_indikator_penilaian.id = temp_penilaian.id_detail_indikator')
                ->where('id_mahasiswa', $seminarKemajuan['user_id'])
                ->findAll();

            if (count($nilaiSeminarKemajuan) > 0) {
                $total_nilai = (array_sum(array_column($nilaiSeminarKemajuan, 'bobot')) / $maksimal_bobot) * 100;
                $total_nilai = number_format($total_nilai, 2);

                // total nilai / jumlah dosen yg memberikan nilai (di disctinct) 
                $total_nilai = ($total_nilai / count(array_unique(array_column($nilaiSeminarKemajuan, 'id_dosen'))));
                $total_nilai = number_format($total_nilai, 2);
            } else {
                $total_nilai = 0;
            }

            $data['nilaiTotal'][] = [
                'id_mahasiswa' => $seminarKemajuan['user_id'],
                'jumlah_nilai' => $total_nilai,
            ];
        }

        // merge nilai total ke list acc seminar kemajuan dengan cara looping
        foreach ($data['listAccSeminarKemajuan'] as $key => $value) {
            $data['listAccSeminarKemajuan'][$key]['nilaiTotal'] = 0;
            foreach ($data['nilaiTotal'] as $nilaiTotal) {
                if ($value['user_id'] == $nilaiTotal['id_mahasiswa']) {
                    $data['listAccSeminarKemajuan'][$key]['nilaiTotal'] = $nilaiTotal['jumlah_nilai'];
                }
            }
        }

        $data['formattedDataIndikatorPenilaian'] = $this->getDataIndikatorPenilaian('seminar_kemajuan');

        // return response()->setJSON($data);
        return view('dashboard/nilai-seminar-kemajuan/index', $data);
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
            }

            // Delete old
            $deleteOld = $tempPenilaianModel->where('id_mahasiswa', $this->request->getPost('id_mahasiswa'))->where('id_dosen', session()->get('user')['id'])->delete();

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
