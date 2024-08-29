<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $userMode = new User();

        $userMode->insertBatch([
            [
                'nama_lengkap'  => 'Siswanto, M.TI., Ph.D.',
                'username'      => '999',
                'email'         => 'siswanto@test.com',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'          => 'dosen'
            ],
            [
                'nama_lengkap'  => 'Rahmat Hidayat, S.T., M.T.',
                'username'      => '998',
                'email'         => 'rahmat@test.com',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'         => 'dosen'
            ],
            [
                'nama_lengkap'  => 'Andri Pranolo, S.T., M.T.',
                'username'      => '997',
                'email'         => 'andri@test.com',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'         => 'dosen'
            ],
            [
                'nama_lengkap'  => 'Dwi Haryanto, S.T., M.T.',
                'username'      => '996',
                'email'         => 'dwi@test.com',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'         => 'dosen'
            ]
        ]);
    }
}
