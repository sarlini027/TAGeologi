<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class DataDosenController extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $data['title'] = 'Data Dosen';
        $data['listDosen'] = $userModel->where('role', 'dosen')->findAll();

        return view('dashboard/data_dosen/index', $data);
    }

    public function store() {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_lengkap' => 'required',
            'username' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new User();
        $tambahDosen = $userModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role' => 'dosen',
            'username' => $this->request->getPost('username'),
            'password' => password_hash('12345', PASSWORD_DEFAULT),
        ]);

        if ($tambahDosen) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data dosen');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data dosen');
        }
    }

    public function update($id) {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_lengkap' => 'required',
            'username' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new User();
        $updateDosen = $userModel->update($id, [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
        ]);

        if ($updateDosen) {
            return redirect()->back()->with('success', 'Berhasil mengubah data dosen');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah data dosen');
        }
    }

    public function delete($id) {
        $userModel = new User();
        $deleteDosen = $userModel->delete($id);

        if ($deleteDosen) {
            return redirect()->back()->with('success', 'Berhasil menghapus data dosen');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data dosen');
        }
    }
}
