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
}
