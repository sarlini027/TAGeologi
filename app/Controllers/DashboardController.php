<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SeminarHasil;
use App\Models\SeminarKemajuan;
use App\Models\SidangAkhir;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $seminarKemajuanModel = new SeminarKemajuan();
        $data['jmlSeminarKemajuanAcc'] = $seminarKemajuanModel->where('status_validasi', 1)->countAllResults();
        $data['jmlSeminarKemajuanPending'] = $seminarKemajuanModel->where('status_validasi', 0)->countAllResults();

        $seminarHasilModel = new SeminarHasil();
        $data['jmlSeminarHasilAcc'] = $seminarHasilModel->where('status_validasi', 1)->countAllResults();
        $data['jmlSeminarHasilPending'] = $seminarHasilModel->where('status_validasi', 0)->countAllResults();

        $sidangAkhirModel = new SidangAkhir();
        $data['jmlSidangAkhirAcc'] = $sidangAkhirModel->where('status_validasi', 1)->countAllResults();
        $data['jmlSidangAkhirPending'] = $sidangAkhirModel->where('status_validasi', 0)->countAllResults();

        return view('dashboard/index', $data);
    }
}
