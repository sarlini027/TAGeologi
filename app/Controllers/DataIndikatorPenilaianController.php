<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailIndikatorPenilaian;
use App\Models\IndikatorPenilaian;
use CodeIgniter\HTTP\ResponseInterface;

class DataIndikatorPenilaianController extends BaseController
{
    public function index()
    {
        $indikatorPenilaianModel = new IndikatorPenilaian();
        $data['title'] = 'Indikaor Penilaian';
        $data['listIndikatorPenilaian'] = $indikatorPenilaianModel->findAll();

        return view('dashboard/data_indikator_penilaian/index', $data);
    }

    public function detail($id)
    {
        $detailIndikatorPenilaianModel = new DetailIndikatorPenilaian();
        $data['title'] = 'Detail Indikator Penilaian';
        $data['indikatorPenilaian'] = $detailIndikatorPenilaianModel->getDetailIndikatorPenilaian($id);

        return view('dashboard/data_indikator_penilaian/detail', $data);
    }
}
