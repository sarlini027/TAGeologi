<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index(): string
    {
        return view('Admin/home');
    }
}
