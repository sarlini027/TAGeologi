<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SidangAkhirTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint'        => 11,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'kendali_bimbingan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'form_pendaftaran' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'form_bimbingan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kehadiran_seminar' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'nilai_kompre' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'transkrip_nilai' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'status_validasi' => [
                'type' => 'BOOLEAN',
                'default' => 0
            ],
            'id_dosen_penguji_1' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_dosen_penguji_2' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_dosen_pembimbing_1' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_dosen_pembimbing_2' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addKey('user_id');
        $this->forge->addKey('id_dosen_penguji_1');
        $this->forge->addKey('id_dosen_penguji_2');
        $this->forge->addKey('id_dosen_pembimbing_1');
        $this->forge->addKey('id_dosen_pembimbing_2');

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen_penguji_1', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen_penguji_2', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen_pembimbing_1', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen_pembimbing_2', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('sidang_akhir', true);
    }

    public function down()
    {
        $this->forge->dropTable('sidang_akhir', true);
    }
}
