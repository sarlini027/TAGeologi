<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SeminarKemajuan;
use CodeIgniter\HTTP\ResponseInterface;

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
                        'max_size[draft_proposal,1024]',
                        'ext_in[draft_proposal,pdf]'
                    ]
                ],
                'lembar_seminar' => [
                    'label' => 'Lembar Pendaftaran Seminar',
                    'rules' => [
                        'uploaded[lembar_seminar]',
                        'max_size[lembar_seminar,1024]',
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

    public function listPengajuan()
    {
        $seminarKemajuanModel = new SeminarKemajuan();
        $data['seminarKemajuan'] = $seminarKemajuanModel->getSeminarKemajuanWithUsers();
        $data['title'] = 'List Pengajuan Seminar Kemajuan';

        return view('dashboard/seminar-kemajuan/list-pengajuan', $data);
    }
}
