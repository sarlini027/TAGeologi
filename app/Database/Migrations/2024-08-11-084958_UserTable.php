<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class UserTable extends Migration
{
    public function up()
    {
        // Membuat tabel users
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'nama_lengkap' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'username' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true
            ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'role'  => [
                'type'          => 'ENUM',
                'constraint'    => ['admin', 'dosen', 'mahasiswa'],
                'default'       => 'mahasiswa'
            ],
            'created_at'    => [
                'type'          => 'DATETIME',
                'null'          => true,
                'default'       => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at'    => [
                'type'          => 'DATETIME',
                'null'          => true
            ]
        ]);

        // Menambahkan primary key pada tabel users dengan field id
        $this->forge->addKey('id', true, true);

        // Menambahkan unique key pada tabel users dengan field username
        $this->forge->addUniqueKey(['username']);

        // Membuat tabel users
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
