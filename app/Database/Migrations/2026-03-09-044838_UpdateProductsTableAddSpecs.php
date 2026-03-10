<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateProductsTableAddSpecs extends Migration
{
    public function up()
    {
        $fields = [
            'spesifikasi' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'deskripsi'
            ],
        ];
        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products', 'spesifikasi');
    }
}
