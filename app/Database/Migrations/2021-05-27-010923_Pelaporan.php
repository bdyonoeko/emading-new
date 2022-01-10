<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelaporan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_laporan' => [
				'type' => 'int',
				'constraint' => 4,
				'auto_increment' => true
			],
			'isi_laporan' => [
				'type' => 'text',
			],
			'kode_user' => [
				'type' => 'char',
				'constraint' => 6
			],
			'id_karya_tulis' => [
				'type' => 'int',
				'constraint' => 4
			],
			'created_at' => [
				'type' => 'datetime',
				'null' => true
			],
			'updated_at' => [
				'type' => 'datetime',
				'null' => true
			],
		]);
		$this->forge->addPrimaryKey('id_laporan');
		$this->forge->addForeignKey('id_karya_tulis', 'karya_tulis', 'id_karya_tulis', 'CASCADE', 'CASCADE');
		$this->forge->createTable('pelaporan', true);
	}

	public function down()
	{
		$this->forge->dropTable('pelaporan');
	}
}
