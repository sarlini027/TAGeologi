<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SidangAkhir;
use CodeIgniter\HTTP\ResponseInterface;

class SidangAkhirController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Sidang Akhir';

        return view('dashboard/sidang-akhir/index', $data);
    }

    public function store()
    {
        try {
            // Validation
            $rules = [
                'kendali_bimbingan' => [
                    'label' => 'Kendali Bimbingan',
                    'rules' => [
                        'uploaded[kendali_bimbingan]',
                        'max_size[kendali_bimbingan,1024]',
                        'ext_in[kendali_bimbingan,pdf]'
                    ]
                ],
                'form_pendaftaran_sidang' => [
                    'label' => 'Form Pendaftaran Sidang',
                    'rules' => [
                        'uploaded[form_pendaftaran_sidang]',
                        'max_size[form_pendaftaran_sidang,1024]',
                        'ext_in[form_pendaftaran_sidang,pdf]'
                    ]
                ],
                'form_bimbingan' => [
                    'label' => 'Form Bimbingan',
                    'rules' => [
                        'uploaded[form_bimbingan]',
                        'max_size[form_bimbingan,1024]',
                        'ext_in[form_bimbingan,pdf]'
                    ]
                ],
                'kehadiran_seminar' => [
                    'label' => 'Kehadiran Seminar',
                    'rules' => [
                        'uploaded[kehadiran_seminar]',
                        'max_size[kehadiran_seminar,1024]',
                        'ext_in[kehadiran_seminar,pdf]'
                    ]
                ],
                'nilai_kompre' => [
                    'label' => 'Nilai Kompre',
                    'rules' => 'required'
                ],
                'transkrip_nilai' => [
                    'label' => 'Transkrip Nilai',
                    'rules' => [
                        'uploaded[transkrip_nilai]',
                        'max_size[transkrip_nilai,1024]',
                        'ext_in[transkrip_nilai,pdf]'
                    ]
                ],
            ];

            // Retrieve POST data for validation
            $postData = $this->request->getPost();

            if (!$this->validate($rules)) {
                $data = ['errors' => $this->validator->getErrors(), 'title' => 'Sidang Akhir'];
                return view('dashboard/sidang-akhir/index', $data);
            }

            // Store the files
            $kendaliBimbingan = $this->request->getFile('kendali_bimbingan');
            $formPendaftaranSidang = $this->request->getFile('form_pendaftaran_sidang');
            $formBimbingan = $this->request->getFile('form_bimbingan');
            $kehadiranSeminar = $this->request->getFile('kehadiran_seminar');
            $transkripNilai = $this->request->getFile('transkrip_nilai');

            // declare folder for the files
            $folderFile = 'uploads/sidang-akhir/';
            $folderFileKendaliBimbingan = $folderFile . 'kendali-bimbingan/';
            $folderFileFormPendaftaranSidang = $folderFile . 'form-pendaftaran-sidang/';
            $folderFileFormBimbingan = $folderFile . 'form-bimbingan/';
            $folderFileKehadiranSeminar = $folderFile . 'kehadiran-seminar/';
            $folderFileTranskripNilai = $folderFile . 'transkrip-nilai/';

            // Move the files
            $kendaliBimbingan->move($folderFileKendaliBimbingan);
            $formPendaftaranSidang->move($folderFileFormPendaftaranSidang);
            $formBimbingan->move($folderFileFormBimbingan);
            $kehadiranSeminar->move($folderFileKehadiranSeminar);
            $transkripNilai->move($folderFileTranskripNilai);

            // Save to database
            $sidangAkhirModel = new SidangAkhir();
            $saveSidang = $sidangAkhirModel->insert([
                'user_id'               => session()->user['id'],
                'kendali_bimbingan'     => base_url($folderFileKendaliBimbingan) . $kendaliBimbingan->getName(),
                'form_pendaftaran'      => base_url($folderFileFormPendaftaranSidang) . $formPendaftaranSidang->getName(),
                'form_bimbingan'        => base_url($folderFileFormBimbingan) . $formBimbingan->getName(),
                'kehadiran_seminar'     => base_url($folderFileKehadiranSeminar) . $kehadiranSeminar->getName(),
                'nilai_kompre'          => $this->request->getPost('nilai_kompre'),
                'transkrip_nilai'       => base_url($folderFileTranskripNilai) . $transkripNilai->getName(),
            ]);

            if ($saveSidang) {
                return redirect()->back()->with('success', 'Pendaftaran sidang akhir berhasil');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mendaftar sidang akhir');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
