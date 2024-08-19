<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailIndikatorPenilaianTable extends Migration
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
            'id_indikator' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'bobot' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_indikator', 'indikator_penilaian', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_indikator_penilaian');
    }

    public function down()
    {
        $this->forge->dropTable('detail_indikator_penilaian');
    }
}
