<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenilaianTable extends Migration
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
            'id_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_dosen' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_detail_indikator' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_mahasiswa', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_detail_indikator', 'detail_indikator_penilaian', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penilaian');
    }

    public function down()
    {
        $this->forge->dropTable('penilaian');
    }
}
