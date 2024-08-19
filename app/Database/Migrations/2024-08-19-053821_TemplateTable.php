<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TemplateTable extends Migration
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
            'nama_template' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'file_template' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'ikon' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('template');
    }

    public function down()
    {
        $this->forge->dropTable('template');
    }
}
