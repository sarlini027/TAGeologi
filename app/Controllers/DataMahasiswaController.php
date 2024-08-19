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
}
