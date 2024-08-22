<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class SeminarHasilTable extends Migration
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
            'bukti_kehadiran' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kendali_bimbingan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'form_pendaftaran' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'status_validasi' => [
                'type' => 'BOOLEAN',
                'default' => 0
            ],
            'id_dosen_penguji_1' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true
            ],
            'id_dosen_penguji_2' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true
            ],
            'id_dosen_pembimbing_1' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true
            ],
            'id_dosen_pembimbing_2' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true
            ],
            'tgl_mulai' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'ruang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default'   => new RawSql('CURRENT_TIMESTAMP'),
                'null'      => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default'   => new RawSql('CURRENT_TIMESTAMP'),
                'null'      => true
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

        $this->forge->createTable('seminar_hasil', true);
    }

    public function down()
    {
        $this->forge->dropTable('seminar_hasil', true);
    }
}
