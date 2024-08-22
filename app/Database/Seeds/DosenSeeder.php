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
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'          => 'dosen'
            ],
            [
                'nama_lengkap'  => 'Rahmat Hidayat, S.T., M.T.',
                'username'      => '998',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'         => 'dosen'
            ],
            [
                'nama_lengkap'  => 'Andri Pranolo, S.T., M.T.',
                'username'      => '997',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'         => 'dosen'
            ],
            [
                'nama_lengkap'  => 'Dwi Haryanto, S.T., M.T.',
                'username'      => '996',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'         => 'dosen'
            ]
        ]);
    }
}
