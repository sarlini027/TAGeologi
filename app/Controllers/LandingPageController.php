<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LandingPageController extends BaseController
{
    public function index()
    {
        return view('landing_page');
    }
}
