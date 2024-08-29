<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BotTelegram;
use App\Models\SeminarKemajuan;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use Telegram\Bot\Api;

class SeminarKemajuanController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Seminar Kemajuan';

        return view('dashboard/seminar-kemajuan/index', $data);
    }

    public function store()
    {
        try {
            // Validation
            $rules = [
                'draft_proposal' => [
                    'label' => 'Draft Proposal',
                    'rules' => [
                        'uploaded[draft_proposal]',
                        'max_size[draft_proposal,10240]',
                        'ext_in[draft_proposal,pdf]'
                    ]
                ],
                'lembar_seminar' => [
                    'label' => 'Lembar Pendaftaran Seminar',
                    'rules' => [
                        'uploaded[lembar_seminar]',
                        'max_size[lembar_seminar,10240]',
                        'ext_in[lembar_seminar,pdf]',
                    ],
                ],
            ];

            if (!$this->validateData([], $rules)) {
                $data = ['errors' => $this->validator->getErrors(), 'title' => 'Seminar Kemajuan'];
                return view('dashboard/seminar-kemajuan/index', $data);
            }

            // Store the files
            $draftProposal = $this->request->getFile('draft_proposal');
            $lembarSeminar = $this->request->getFile('lembar_seminar');

            // declare the file name
            $folderFile = 'uploads/seminar-kemajuan/';
            $folderFileDraftProposal = $folderFile . 'draft-proposal/';
            $folderFileLembarSeminar = $folderFile . 'lembar-pendaftaran/';

            // Move the files
            $draftProposal->move($folderFileDraftProposal);
            $lembarSeminar->move($folderFileLembarSeminar);

            // Save to database
            $seminarKemajuanModel = new SeminarKemajuan();
            $saveSeminar = $seminarKemajuanModel->insert([
                'user_id' => session()->user['id'],
                'draft_proposal' => base_url($folderFileDraftProposal) . $draftProposal->getName(),
                'lembar_pendaftaran' => base_url($folderFileLembarSeminar) . $lembarSeminar->getName(),
            ]);

            if ($saveSeminar) {
                return redirect()->back()->with('success', 'Pendaftaran seminar kemajuan berhasil');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mendaftar seminar kemajuan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function validasi($id)
    {
        $rules = [
            'id_dosen_pembimbing_1' => 'required',
            // 'id_dosen_penguji_1'    => 'required',
            'tgl_mulai'             => 'required',
            'ruang'                 => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $dataUpdateSeminar = [
            'id_dosen_pembimbing_1' => $this->request->getPost('id_dosen_pembimbing_1'),
            // 'id_dosen_penguji_1'    => $this->request->getPost('id_dosen_penguji_1'),
            'status_validasi'       => true,
            'tgl_mulai'             => $this->request->getPost('tgl_mulai'),
            'ruang'                 => $this->request->getPost('ruang'),
        ];

        if($this->request->getPost('id_dosen_pembimbing_2')) {
            $dataUpdateSeminar['id_dosen_pembimbing_2'] = $this->request->getPost('id_dosen_pembimbing_2');
        }

        if($this->request->getPost('id_dosen_penguji_2')) {
            $dataUpdateSeminar['id_dosen_penguji_2'] = $this->request->getPost('id_dosen_penguji_2');
        }

        $seminarKemajuanModel = new SeminarKemajuan();
        $updateSeminar = $seminarKemajuanModel->update($id, $dataUpdateSeminar);

        if ($updateSeminar) {
            // Send notification to user that their seminar has been validated
            $this->sendNotificationTelegram($id);

            return redirect()->back()->with('success', 'Seminar kemajuan berhasil divalidasi');
        } else {
            return redirect()->back()->with('error', 'Gagal validasi seminar kemajuan');
        }
    }

    public function listPengajuan()
    {
        $seminarKemajuanModel = new SeminarKemajuan();
        $data['seminarKemajuan'] = $seminarKemajuanModel->getSeminarKemajuanWithUsers();
        $data['title'] = 'List Pengajuan Seminar Kemajuan';

        $userModel = new User();
        $data['listDosen'] = $userModel->getDosen();

        return view('dashboard/seminar-kemajuan/list-pengajuan', $data);
    }

    public function listRiwayatPengajuan()
    {
        $seminarKemajuanModel = new SeminarKemajuan();
        $data['seminarKemajuan'] = $seminarKemajuanModel->getRiwayatPengajuan();
        $data['title'] = 'List Riwayat Pengajuan Seminar Kemajuan';

        return view('dashboard/seminar-kemajuan/list-riwayat-pengajuan', $data);
    }

    protected function sendNotificationTelegram($id)
    {
        $seminarKemajuanModel = new SeminarKemajuan();
        $seminarKemajuan = $seminarKemajuanModel
            ->join('users', 'users.id = seminar_kemajuan.user_id')
            ->where('seminar_kemajuan.id', $id)
            ->first();

        $userModel = new User();
        $mahasiswa = $userModel->find($seminarKemajuan['user_id']);

        // buat message template ada nama mahasiswa, nim, dosen pembimbing, dosen penguji 1, dosen penguji 2, tanggal, ruang dan tipe seminar
        $message = "Pendaftaran seminar hasil mahasiswa dengan NIM " . $mahasiswa['username'] . " telah divalidasi. Berikut detailnya:\n\n";
        $message .= "Nama Mahasiswa: " . $mahasiswa['nama_lengkap'] . "\n";
        $message .= "NIM: " . $mahasiswa['username'] . "\n";

        // Setting dosen pembimbing dan dosen penguji
        $message .= $this->getDosenInfo($seminarKemajuan['id_dosen_pembimbing_1'], 'Dosen Pembimbing 1', $userModel);
        $message .= $this->getDosenInfo($seminarKemajuan['id_dosen_pembimbing_2'], 'Dosen Pembimbing 2', $userModel);
        $message .= $this->getDosenInfo($seminarKemajuan['id_dosen_penguji_1'], 'Dosen Penguji 1', $userModel);
        $message .= $this->getDosenInfo($seminarKemajuan['id_dosen_penguji_2'], 'Dosen Penguji 2', $userModel);

        $message .= "Tanggal: " . $seminarKemajuan['tgl_mulai'] . "\n";
        $message .= "Ruang: " . $seminarKemajuan['ruang'] . "\n";
        $message .= "Tipe Seminar: Seminar Kemajuan";

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
}
