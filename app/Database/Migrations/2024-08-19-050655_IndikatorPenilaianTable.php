<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IndikatorPenilaianTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'indikator' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tipe' => [
                'type' => 'ENUM',
                'constraint' => ['seminar_kemajuan', 'seminar_hasil', 'sidang_akhir']
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('indikator_penilaian');
    }

    public function down()
    {
        $this->forge->dropTable('indikator_penilaian');
    }
}
