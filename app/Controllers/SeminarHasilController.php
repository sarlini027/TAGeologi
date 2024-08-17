<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SeminarHasil;
use CodeIgniter\HTTP\ResponseInterface;

class SeminarHasilController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Seminar Hasil';

        return view('dashboard/seminar-hasil/index', $data);
    }

    public function store()
    {
        try {
            // Validation
            $rules = [
                'bukti_kehadiran' => [
                    'label' => 'Bukti Kehadiran',
                    'rules' => [
                        'uploaded[bukti_kehadiran]',
                        'max_size[bukti_kehadiran,1024]',
                        'ext_in[bukti_kehadiran,pdf]'
                    ]
                ],
                'kendali_bimbingan_semhas' => [
                    'label' => 'Kendali Bimbingan Seminar',
                    'rules' => [
                        'uploaded[kendali_bimbingan_semhas]',
                        'max_size[kendali_bimbingan_semhas,1024]',
                        'ext_in[kendali_bimbingan_semhas,pdf]',
                    ],
                ],
                'form_pendaftaran_dosbing' => [
                    'label' => 'Form Pendaftaran Dosbing',
                    'rules' => [
                        'uploaded[form_pendaftaran_dosbing]',
                        'max_size[form_pendaftaran_dosbing,1024]',
                        'ext_in[form_pendaftaran_dosbing,pdf]',
                    ],
                ],
            ];

            if (!$this->validateData([], $rules)) {
                $data = ['errors' => $this->validator->getErrors(), 'title' => 'Seminar Hasil'];
                return view('dashboard/seminar-hasil/index', $data);
            }

            // Store the files
            $buktiKehadiran = $this->request->getFile('bukti_kehadiran');
            $kendaliBimbingan = $this->request->getFile('kendali_bimbingan_semhas');
            $formPendaftaranDosbing = $this->request->getFile('form_pendaftaran_dosbing');

            // declare folder for the files
            $folderFile = 'uploads/seminar-hasil/';
            $folderFileBuktiKehadiran = $folderFile . 'bukti-kehadiran/';
            $folderFileKendaliBimbingan = $folderFile . 'kendali-bimbingan/';
            $folderFileFormPendaftaranDosbing = $folderFile . 'form-pendaftaran-dosbing/';

            // Move the files
            $buktiKehadiran->move($folderFileBuktiKehadiran);
            $kendaliBimbingan->move($folderFileKendaliBimbingan);
            $formPendaftaranDosbing->move($folderFileFormPendaftaranDosbing);

            // Save to database
            $seminarHasilModel = new SeminarHasil();
            $saveSeminar = $seminarHasilModel->insert([
                'user_id'           => session()->user['id'],
                'bukti_kehadiran'   => base_url($folderFileBuktiKehadiran) . $buktiKehadiran->getName(),
                'kendali_bimbingan' => base_url($folderFileKendaliBimbingan) . $kendaliBimbingan->getName(),
                'form_pendaftaran'  => base_url($folderFileFormPendaftaranDosbing) . $formPendaftaranDosbing->getName(),
            ]);

            if ($saveSeminar) {
                return redirect()->back()->with('success', 'Pendaftaran seminar hasil berhasil');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mendaftar seminar hasil');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function listPengajuan()
    {
        $seminarHasilModel = new SeminarHasil();
        $data['seminarHasil'] = $seminarHasilModel->getSeminarHasilWithUsers();
        $data['title'] = 'List Pengajuan Seminar Hasil';

        return view('dashboard/seminar-hasil/list-pengajuan', $data);
    }
}
