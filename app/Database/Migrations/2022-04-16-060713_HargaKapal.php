<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HargaKapal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hk_id'         => [
                'type'          => 'INT',
                'constraint'    => 111,
                'unsigned'      => true,
                'auto_increment' =>  true,
            ],
            'hk_kode'       => [
                'type'          => 'INT',
                'constraint'    => 111
            ],
            'hk_tujuan'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'hk_day'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ],
            'hk_end'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ],
            'hk_perjam'       => [
                'type'          => 'DECIMAL',
                'constraint'    => 65, 2
            ]
        ]);
        $this->forge->addKey('hk_id', true);
        $this->forge->createTable('harga_kapal');
    }

    public function down()
    {
        $this->forge->dropTable('harga_kapal');
    }
}
