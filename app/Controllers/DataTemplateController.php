<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemplateDokumen;
use CodeIgniter\HTTP\ResponseInterface;

class DataTemplateController extends BaseController
{
    public function index()
    {
        $dokumenModel = new TemplateDokumen();
        $data['title'] = 'Data Template';
        $data['listTemplate'] = $dokumenModel->findAll();

        return view('dashboard/data_template/index', $data);
    }
}
