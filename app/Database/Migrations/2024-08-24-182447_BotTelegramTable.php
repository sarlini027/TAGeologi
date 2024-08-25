<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BotTelegramTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'token'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'chat_id'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'group_id'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
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
        $this->forge->createTable('bot_telegram');
    }

    public function down()
    {
        $this->forge->dropTable('bot_telegram');
    }
}
