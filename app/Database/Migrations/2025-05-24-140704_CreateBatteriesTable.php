<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBatteriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'type' => ['type' => 'VARCHAR', 'constraint' => 50],
            'voltage' => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'capacity' => ['type' => 'INT', 'constraint' => 5],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('batteries');
    }

    public function down()
    {
        $this->forge->dropTable('batteries');
    }
}