<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BotTelegram;
use App\Models\SidangAkhir;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use Telegram\Bot\Api;

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
                        'max_size[kendali_bimbingan,10240]',
                        'ext_in[kendali_bimbingan,pdf]'
                    ]
                ],
                'form_pendaftaran_sidang' => [
                    'label' => 'Form Pendaftaran Sidang',
                    'rules' => [
                        'uploaded[form_pendaftaran_sidang]',
                        'max_size[form_pendaftaran_sidang,10240]',
                        'ext_in[form_pendaftaran_sidang,pdf]'
                    ]
                ],
                'form_bimbingan' => [
                    'label' => 'Form Bimbingan',
                    'rules' => [
                        'uploaded[form_bimbingan]',
                        'max_size[form_bimbingan,10240]',
                        'ext_in[form_bimbingan,pdf]'
                    ]
                ],
                'kehadiran_seminar' => [
                    'label' => 'Kehadiran Seminar',
                    'rules' => [
                        'uploaded[kehadiran_seminar]',
                        'max_size[kehadiran_seminar,10240]',
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
                        'max_size[transkrip_nilai,10240]',
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

    public function validasi($id)
    {
        $rules = [
            'id_dosen_pembimbing_1' => 'required',
            'id_dosen_penguji_1'    => 'required',
            'id_dosen_penguji_2'    => 'required',
            'tgl_mulai'             => 'required',
            'ruang'                 => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $dataUpdateSeminar = [
            'id_dosen_pembimbing_1' => $this->request->getPost('id_dosen_pembimbing_1'),
            'id_dosen_penguji_1'    => $this->request->getPost('id_dosen_penguji_1'),
            'id_dosen_penguji_2'    => $this->request->getPost('id_dosen_penguji_2'),
            'status_validasi'       => true,
            'tgl_mulai'             => $this->request->getPost('tgl_mulai'),
            'ruang'                 => $this->request->getPost('ruang'),
        ];

        if($this->request->getPost('id_dosen_pembimbing_2')) {
            $dataUpdateSeminar['id_dosen_pembimbing_2'] = $this->request->getPost('id_dosen_pembimbing_2');
        }

        $sidangAkhirModel = new SidangAkhir();
        $updateSeminar = $sidangAkhirModel->update($id, $dataUpdateSeminar);

        if ($updateSeminar) {
            // Send notification to user that their seminar has been validated
            $this->sendNotificationTelegram($id);
            $this->sendNotificationEmail($id);

            return redirect()->back()->with('success', 'Sidang akhir berhasil divalidasi');
        } else {
            return redirect()->back()->with('error', 'Gagal validasi sidang akhir');
        }
    }

    public function listPengajuan()
    {
        $sidangAkhirModel = new SidangAkhir();
        $data['sidangAkhir'] = $sidangAkhirModel->getSidangAkhirWithUsers();
        $data['title'] = 'List Pengajuan Sidang Akhir';

        $userModel = new User();
        $data['listDosen'] = $userModel->getDosen();

        return view('dashboard/sidang-akhir/list-pengajuan', $data);
    }

    public function listRiwayatPengajuan()
    {
        $sidangAkhirModel = new SidangAkhir();
        $data['sidangAkhir'] = $sidangAkhirModel->getRiwayatPengajuan();
        $data['title'] = 'List Riwayat Pengajuan Sidang Akhir';

        return view('dashboard/sidang-akhir/list-riwayat-pengajuan', $data);
    }

    protected function sendNotificationTelegram($id)
    {
        $sidangAkhirModel = new SidangAkhir();
        $sidangAkhir = $sidangAkhirModel
            ->join('users', 'users.id = sidang_akhir.user_id')
            ->where('sidang_akhir.id', $id)
            ->first();

        $userModel = new User();
        $mahasiswa = $userModel->find($sidangAkhir['user_id']);

        // buat message template ada nama mahasiswa, nim, dosen pembimbing, dosen penguji 1, dosen penguji 2, tanggal, ruang dan tipe seminar
        $message = "Pendaftaran seminar hasil mahasiswa dengan NIM " . $mahasiswa['username'] . " telah divalidasi. Berikut detailnya:\n\n";
        $message .= "Nama Mahasiswa: " . $mahasiswa['nama_lengkap'] . "\n";
        $message .= "NIM: " . $mahasiswa['username'] . "\n";

        // Setting dosen pembimbing dan dosen penguji
        $message .= $this->getDosenInfo($sidangAkhir['id_dosen_pembimbing_1'], 'Dosen Pembimbing 1', $userModel);
        $message .= $this->getDosenInfo($sidangAkhir['id_dosen_pembimbing_2'], 'Dosen Pembimbing 2', $userModel);
        $message .= $this->getDosenInfo($sidangAkhir['id_dosen_penguji_1'], 'Dosen Penguji 1', $userModel);
        $message .= $this->getDosenInfo($sidangAkhir['id_dosen_penguji_2'], 'Dosen Penguji 2', $userModel);

        $message .= "Tanggal: " . $sidangAkhir['tgl_mulai'] . "\n";
        $message .= "Ruang: " . $sidangAkhir['ruang'] . "\n";
        $message .= "Tipe Seminar: Sidang Akhir";

        $this->sendTelegram($message);
    }

    protected function sendTelegram($message)
    {
        $getFirstBotFromDB = (new BotTelegram())->first();
        if ($getFirstBotFromDB) {
            $telegram = new Api($getFirstBotFromDB['token']);

            $response = $telegram->sendMessage([
                'chat_id' => $getFirstBotFromDB['chat_id'],
                'text' => $message
            ]);

            $messageId = $response->getMessageId();
        }
    }

    // Function to get dosen information
    protected function getDosenInfo($id, $role, $userModel)
    {
        if ($id === null) {
            return "$role: - \n";
        } else {
            $dosen = $userModel->find($id);
            return "$role: " . $dosen['nama_lengkap'] . "\n";
        }
    }

    protected function sendNotificationEmail($id)
    {
        // Load the models
        $sidangAkhirModel = new SidangAkhir();
        $userModel = new User();

        // Fetch seminar details
        $sidangAkhir = $sidangAkhirModel
            ->join('users', 'users.id = sidang_akhir.user_id')
            ->where('sidang_akhir.id', $id)
            ->first();

        // Fetch user (student) details
        $mahasiswa = $userModel->find($sidangAkhir['user_id']);

        // Create the email message in HTML format
        $message = "
        <p>Pendaftaran sidang akhir mahasiswa dengan NIM <strong>" . $mahasiswa['username'] . "</strong> telah divalidasi. Berikut detailnya:</p>
        <ul>
            <li><strong>Nama Mahasiswa:</strong> " . $mahasiswa['nama_lengkap'] . "</li>
            <li><strong>NIM:</strong> " . $mahasiswa['username'] . "</li>";

        // Append dosen (supervisor and examiner) details
        $message .= $this->getDosenInfoHtml($sidangAkhir['id_dosen_pembimbing_1'], 'Dosen Pembimbing 1');
        $message .= $this->getDosenInfoHtml($sidangAkhir['id_dosen_pembimbing_2'], 'Dosen Pembimbing 2');
        $message .= $this->getDosenInfoHtml($sidangAkhir['id_dosen_penguji_1'], 'Dosen Penguji 1');
        $message .= $this->getDosenInfoHtml($sidangAkhir['id_dosen_penguji_2'], 'Dosen Penguji 2');

        $message .= "
            <li><strong>Tanggal:</strong> " . $sidangAkhir['tgl_mulai'] . "</li>
            <li><strong>Ruang:</strong> " . $sidangAkhir['ruang'] . "</li>
            <li><strong>Tipe Seminar:</strong> Sidang Akhir</li>
        </ul>";

        $this->sendEmail($mahasiswa['email'], $message);
    }

    /**
     * Helper function to get dosen (supervisor/examiner) information and format it in HTML.
     */
    protected function getDosenInfoHtml($dosenId, $role)
    {
        if ($dosenId == null) {
            return "<li><strong>{$role}:</strong> -</li>";
        }

        $dosen = (new User())->where('id', $dosenId)->first();
        if ($dosen) {
            $namaDosen = $dosen ? $dosen['nama_lengkap'] : '-';
            $usernameDosen = $dosen ? $dosen['username'] : '-';
            if ($dosen) {
                return "<li><strong>{$role}:</strong> " . $namaDosen . " (" . $usernameDosen . ")</li>";
            }
        }
        return "<li><strong>{$role}:</strong> Not Assigned</li>";
    }

    protected function sendEmail($emailMahasiswa, $message)
    {
        if ($emailMahasiswa !== null) {
            // Load the Email library
            $email = \Config\Services::email();

            // Set email preferences
            $email->setFrom('admin@tageologi.com', 'Admin TaGeologi');
            $email->setTo($emailMahasiswa);
            $email->setSubject('Notifikasi Seminar Hasil');
            $email->setMessage($message);

            // Send the email and check for errors
            $email->send();
        }
    }
}
