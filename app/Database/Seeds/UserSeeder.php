<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new User();

        $userModel->insertBatch([
            [
                'nama_lengkap'  => 'Super Admin',
                'username'      => 'admin',
                'password'      => password_hash('admin', PASSWORD_DEFAULT),
                'role'          => 'admin',
            ],
            [
                'nama_lengkap'  => 'Andre',
                'username'      => '11223344',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'          => 'mahasiswa',
            ],
            [
                'nama_lengkap'  => 'Budi',
                'username'      => '22334455',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'          => 'mahasiswa',
            ],
            [
                'nama_lengkap'  => 'Cici',
                'username'      => '33445566',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'          => 'mahasiswa',
            ],
        ]);
    }
}
