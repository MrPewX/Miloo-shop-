<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIconToCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('categories', [
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'nama_kategori'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('categories', 'icon');
    }
}
