<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $helpers = ['form'];

    public function login()
    {
        if(!$this->request->is('post')) {
            return view('auth/login');
        }

        $rules = [
            'username'  => 'required',
            'password'  => 'required'
        ];

        $data = $this->request->getPost(['username', 'password']);
        if (!$this->validateData($data, $rules)) {
            return view('auth/login');
        }

        $validData = $this->validator->getValidated();
        $userModel = new User();

        // cek username jika tidak ada maka kembalikan error
        $cekUser = $userModel->where('username', $validData['username'])->first();
        
        if($cekUser) {
            // jika ada lanjut cek password
            $verify_pass = password_verify($validData['password'], $cekUser['password']);

            if($verify_pass) {
                // jika password benar maka set session user
                session()->set('user', [
                    'id'            => $cekUser['id'],
                    'nama_lengkap'  => $cekUser['nama_lengkap'],
                    'username'      => $cekUser['username'],
                    'role'          => $cekUser['role']
                ]);
                return redirect()->to(base_url('/auth/login'))->with('success', 'Berhasil Masuk');
            } else {
                return redirect()->to(base_url('/auth/login'))->with('error', 'Kata sandi tidak sesuai');
            }
        } else {
            return redirect()->to(base_url('/auth/login'))->with('error', 'User tidak terdaftar');
        }
    }

    public function register()
    {

        if (!$this->request->is('post')) {
            return view('auth/register');
        }

        $rules = [
            'nama_lengkap' => 'required',
            'nim'          => 'required',
            'password'     => 'required'
        ];

        $data = $this->request->getPost(['nama_lengkap', 'nim', 'password']);

        if (!$this->validateData($data, $rules)) {
            return view('auth/register');
        }

        $validData = $this->validator->getValidated();

        $userModel = new User();
        
        // cek username jika sudah ada maka kembalikan error
        $cekUser = $userModel->where('username', $validData['nim'])->first();
        if($cekUser) {
            return redirect()->to(base_url('/auth/register'))->with('error', 'NIM sudah terdaftar');
        }
        
        // jika belum ada maka simpan data user
        $saveUser = $userModel->insert([
            'nama_lengkap'  => $validData['nama_lengkap'],
            'username'      => $validData['nim'],
            'password'      => password_hash($validData['password'], PASSWORD_BCRYPT),
            'role'          => 'mahasiswa'
        ]);

        if ($saveUser) {
            session()->set('user', [
                'nama_lengkap'  => $validData['nama_lengkap'],
                'username'      => $validData['nim'],
                'role'          => 'mahasiswa'
            ]);
            return redirect()->to(base_url('/dashboard'))->with('success', 'Berhasil Mendaftar');
        } else {
            return redirect()->to(base_url('/auth/login'))->with('error', 'Gagal Mendaftar!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/auth/login'))->with('success', 'Berhasil Keluar');
    }
}
