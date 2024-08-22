<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TempPenilaianTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_indikator' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_detail_indikator' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_dosen' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_indikator', 'indikator_penilaian', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_detail_indikator', 'detail_indikator_penilaian', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_mahasiswa', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('temp_penilaian');
    }

    public function down()
    {
        $this->forge->dropTable('temp_penilaian');
    }
}
