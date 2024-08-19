<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenilaianSeeder extends Seeder
{
    public function run()
    {
        // Create Indikator Penilaian
        $indikator = [
            [
                'id'        => 1,
                'indikator' => 'Latar Belakang dan Tujuan',
                'tipe'      => 'seminar_kemajuan'
            ],
            [
                'id'        => 2,
                'indikator' => 'Tinjauan Pustaka',
                'tipe'      => 'seminar_kemajuan'
            ],
            [
                'id'        => 3,
                'indikator' => 'Metode Penelitian',
                'tipe'      => 'seminar_kemajuan'
            ],
        ];

        
        $detailIndikator = [
            [
                'id_indikator'  => 1,
                'keterangan'    => 'Latar belakang dijelaskan dengan sangat baik dan berhasil menunjukkan urgensi penelitian di kawasan tersebut',
                'bobot'         => 3,
            ],
            [
                'id_indikator'  => 1,
                'keterangan'    => 'Latar belakang dan urgensi penelitian dijelaskan dengan cukup baik',
                'bobot'         => 2,
            ],
            [
                'id_indikator'  => 1,
                'keterangan'    => 'Tujuan penelitian dapat terukur dengan ruang lingkup yang baik',
                'bobot'         => 1,
            ],
        ];

        $this->db->table('indikator_penilaian')->insertBatch($indikator);
        $this->db->table('detail_indikator_penilaian')->insertBatch($detailIndikator);
    }
}
