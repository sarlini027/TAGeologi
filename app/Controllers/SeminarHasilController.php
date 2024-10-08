<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BotTelegram;
use App\Models\SeminarHasil;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use Telegram\Bot\Api;

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
                        'max_size[bukti_kehadiran,10240]',
                        'ext_in[bukti_kehadiran,pdf]'
                    ]
                ],
                'kendali_bimbingan_semhas' => [
                    'label' => 'Kendali Bimbingan Seminar',
                    'rules' => [
                        'uploaded[kendali_bimbingan_semhas]',
                        'max_size[kendali_bimbingan_semhas,10240]',
                        'ext_in[kendali_bimbingan_semhas,pdf]',
                    ],
                ],
                // 'form_pendaftaran_dosbing' => [
                //     'label' => 'Form Pendaftaran Dosbing',
                //     'rules' => [
                //         'uploaded[form_pendaftaran_dosbing]',
                //         'max_size[form_pendaftaran_dosbing,1024]',
                //         'ext_in[form_pendaftaran_dosbing,pdf]',
                //     ],
                // ],
            ];

            if (!$this->validateData([], $rules)) {
                $data = ['errors' => $this->validator->getErrors(), 'title' => 'Seminar Hasil'];
                return view('dashboard/seminar-hasil/index', $data);
            }

            // Store the files
            $buktiKehadiran = $this->request->getFile('bukti_kehadiran');
            $kendaliBimbingan = $this->request->getFile('kendali_bimbingan_semhas');
            // $formPendaftaranDosbing = $this->request->getFile('form_pendaftaran_dosbing');

            // declare folder for the files
            $folderFile = 'uploads/seminar-hasil/';
            $folderFileBuktiKehadiran = $folderFile . 'bukti-kehadiran/';
            $folderFileKendaliBimbingan = $folderFile . 'kendali-bimbingan/';
            // $folderFileFormPendaftaranDosbing = $folderFile . 'form-pendaftaran-dosbing/';

            // Move the files
            $buktiKehadiran->move($folderFileBuktiKehadiran);
            $kendaliBimbingan->move($folderFileKendaliBimbingan);
            // $formPendaftaranDosbing->move($folderFileFormPendaftaranDosbing);

            // Save to database
            $seminarHasilModel = new SeminarHasil();
            $saveSeminar = $seminarHasilModel->insert([
                'user_id'           => session()->user['id'],
                'bukti_kehadiran'   => base_url($folderFileBuktiKehadiran) . $buktiKehadiran->getName(),
                'kendali_bimbingan' => base_url($folderFileKendaliBimbingan) . $kendaliBimbingan->getName(),
                // 'form_pendaftaran'  => base_url($folderFileFormPendaftaranDosbing) . $formPendaftaranDosbing->getName(),
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

        if ($this->request->getPost('id_dosen_pembimbing_2')) {
            $dataUpdateSeminar['id_dosen_pembimbing_2'] = $this->request->getPost('id_dosen_pembimbing_2');
        }

        $seminarHasilModel = new SeminarHasil();
        $updateSeminar = $seminarHasilModel->update($id, $dataUpdateSeminar);

        if ($updateSeminar) {
            // Send notification to user that their seminar has been validated
            $this->sendNotificationTelegram($id);
            $this->sendNotificationEmail($id);

            return redirect()->back()->with('success', 'Seminar hasil berhasil divalidasi');
        } else {
            return redirect()->back()->with('error', 'Gagal validasi seminar hasil');
        }
    }

    public function listPengajuan()
    {
        $seminarHasilModel = new SeminarHasil();
        $data['seminarHasil'] = $seminarHasilModel->getSeminarHasilWithUsers();
        $data['title'] = 'List Pengajuan Seminar Hasil';

        $userModel = new User();
        $data['listDosen'] = $userModel->getDosen();

        return view('dashboard/seminar-hasil/list-pengajuan', $data);
    }

    public function listRiwayatPengajuan()
    {
        $seminarHasilModel = new SeminarHasil();
        $data['seminarHasil'] = $seminarHasilModel->getRiwayatPengajuan();
        $data['title'] = 'List Riwayat Pengajuan Seminar Hasil';

        return view('dashboard/seminar-hasil/list-riwayat-pengajuan', $data);
    }

    protected function sendNotificationTelegram($id)
    {
        $seminarHasilModel = new SeminarHasil();
        $seminarHasil = $seminarHasilModel
            ->join('users', 'users.id = seminar_hasil.user_id')
            ->where('seminar_hasil.id', $id)
            ->first();

        $userModel = new User();
        $mahasiswa = $userModel->find($seminarHasil['user_id']);

        // buat message template ada nama mahasiswa, nim, dosen pembimbing, dosen penguji 1, dosen penguji 2, tanggal, ruang dan tipe seminar
        $message = "Pendaftaran seminar hasil mahasiswa dengan NIM " . $mahasiswa['username'] . " telah divalidasi. Berikut detailnya:\n\n";
        $message .= "Nama Mahasiswa: " . $mahasiswa['nama_lengkap'] . "\n";
        $message .= "NIM: " . $mahasiswa['username'] . "\n";

        // Setting dosen pembimbing dan dosen penguji
        $message .= $this->getDosenInfo($seminarHasil['id_dosen_pembimbing_1'], 'Dosen Pembimbing 1', $userModel);
        $message .= $this->getDosenInfo($seminarHasil['id_dosen_pembimbing_2'], 'Dosen Pembimbing 2', $userModel);
        $message .= $this->getDosenInfo($seminarHasil['id_dosen_penguji_1'], 'Dosen Penguji 1', $userModel);
        $message .= $this->getDosenInfo($seminarHasil['id_dosen_penguji_2'], 'Dosen Penguji 2', $userModel);

        $message .= "Tanggal: " . $seminarHasil['tgl_mulai'] . "\n";
        $message .= "Ruang: " . $seminarHasil['ruang'] . "\n";
        $message .= "Tipe Seminar: Seminar Hasil";

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
        $seminarHasilModel = new SeminarHasil();
        $userModel = new User();

        // Fetch seminar details
        $seminarHasil = $seminarHasilModel
            ->join('users', 'users.id = seminar_hasil.user_id')
            ->where('seminar_hasil.id', $id)
            ->first();

        // Fetch user (student) details
        $mahasiswa = $userModel->find($seminarHasil['user_id']);

        // Create the email message in HTML format
        $message = "
        <p>Pendaftaran seminar hasil mahasiswa dengan NIM <strong>" . $mahasiswa['username'] . "</strong> telah divalidasi. Berikut detailnya:</p>
        <ul>
            <li><strong>Nama Mahasiswa:</strong> " . $mahasiswa['nama_lengkap'] . "</li>
            <li><strong>NIM:</strong> " . $mahasiswa['username'] . "</li>";

        // Append dosen (supervisor and examiner) details
        $message .= $this->getDosenInfoHtml($seminarHasil['id_dosen_pembimbing_1'], 'Dosen Pembimbing 1');
        $message .= $this->getDosenInfoHtml($seminarHasil['id_dosen_pembimbing_2'], 'Dosen Pembimbing 2');
        $message .= $this->getDosenInfoHtml($seminarHasil['id_dosen_penguji_1'], 'Dosen Penguji 1');
        $message .= $this->getDosenInfoHtml($seminarHasil['id_dosen_penguji_2'], 'Dosen Penguji 2');

        $message .= "
            <li><strong>Tanggal:</strong> " . $seminarHasil['tgl_mulai'] . "</li>
            <li><strong>Ruang:</strong> " . $seminarHasil['ruang'] . "</li>
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
