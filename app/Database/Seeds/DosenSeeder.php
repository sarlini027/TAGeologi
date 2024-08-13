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
                'username'      => 'siswanto',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'          => 'dosen'
            ],
            [
                'nama_lengkap'  => 'Rahmat Hidayat, S.T., M.T.',
                'username'      => 'rahmat',
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'         => 'dosen'
            ]
        ]);
    }
}
