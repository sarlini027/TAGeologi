<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class DataMahasiswaController extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $data['title'] = 'Data Mahasiswa';
        $data['listMahasiswa'] = $userModel->where('role', 'mahasiswa')->findAll();

        return view('dashboard/data_mahasiswa/index', $data);
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
        $tambahMahasiswa = $userModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role' => 'mahasiswa',
            'username' => $this->request->getPost('username'),
            'password' => password_hash('12345', PASSWORD_DEFAULT),
        ]);

        if ($tambahMahasiswa) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data mahasiswa');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data mahasiswa');
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
        $updateMahasiswa = $userModel->update($id, [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
        ]);

        if ($updateMahasiswa) {
            return redirect()->back()->with('success', 'Berhasil mengubah data mahasiswa');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah data mahasiswa');
        }
    }

    public function delete($id) {
        $userModel = new User();
        $deleteMahasiswa = $userModel->delete($id);

        if ($deleteMahasiswa) {
            return redirect()->back()->with('success', 'Berhasil menghapus data mahasiswa');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data mahasiswa');
        }
    }
}
