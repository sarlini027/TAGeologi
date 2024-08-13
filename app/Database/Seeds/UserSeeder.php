<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new User();

        $userModel->insert([
            'nama_lengkap'  => 'Super Admin',
            'username'      => 'admin',
            'password'      => password_hash('admin', PASSWORD_DEFAULT),
            'role'          => 'admin',
        ]);
    }
}
