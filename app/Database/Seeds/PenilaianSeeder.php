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
            [
                'id'        => 4,
                'indikator' => 'Metode Penelitian 2',
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
            [
                'id_indikator'  => 2,
                'keterangan'    => '50-80% referensi menggunakan  referensi 10 tahun terakhir namun semua referensi tercantum di daftar pustaka',
                'bobot'         => 2,
            ],
            [
                'id_indikator'  => 2,
                'keterangan'    => '80% referensi menggunakan referensi 10 tahun terakhir dan semua referensi tercantum di daftar pustaka',
                'bobot'         => 3,
            ],
            [
                'id_indikator'  => 3,
                'keterangan'    => 'Metode dijabarkan dengan cukup jelas dan cukup mudah difahami',
                'bobot'         => 3,
            ],
            [
                'id_indikator'  => 3,
                'keterangan'    => 'Metode dijabarkan dengan sangat jelas dan mudah difahami',
                'bobot'         => 5,
            ],
            [
                'id_indikator'  => 3,
                'keterangan'    => 'Metode tidak dijabarkan dengan baik',
                'bobot'         => 1,
            ],
            [
                'id_indikator'  => 4,
                'keterangan'    => 'Alur penelitian dijabarkan dengan sangat jelas dan mudah difahami',
                'bobot'         => 3,
            ],
            [
                'id_indikator'  => 4,
                'keterangan'    => 'Alur penelitian dijabarkan dengan cukup jelas dan cukup mudah difahami',
                'bobot'         => 2,
            ],
            [
                'id_indikator'  => 4,
                'keterangan'    => 'Alur penelitian tidak dijabarkan dengan baik',
                'bobot'         => 1,
            ],
        ];

        $this->db->table('indikator_penilaian')->insertBatch($indikator);
        $this->db->table('detail_indikator_penilaian')->insertBatch($detailIndikator);
    }
}
