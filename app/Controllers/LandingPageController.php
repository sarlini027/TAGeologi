<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemplateDokumen;
use CodeIgniter\HTTP\ResponseInterface;

class LandingPageController extends BaseController
{
    public function index()
    {
        $data['file_template'] = (new TemplateDokumen())->findAll();
        return view('landing_page', $data);
    }
}
