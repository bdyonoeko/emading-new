<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PelaporanKomentar extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pelaporan_komentar' => [
				'type' => 'int',
				'constraint' => 4,
				'auto_increment' => true
			],
			'isi_laporan_komentar' => [
				'type' => 'text',
			],
			'id_komentar' => [
				'type' => 'int',
				'constraint' => 4
			],
			'kode_user' => [
				'type' => 'char',
				'constraint' => 6
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
		$this->forge->addPrimaryKey('id_pelaporan_komentar');
		$this->forge->addForeignKey('id_komentar', 'komentar', 'id_komentar', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('kode_user', 'user', 'kode_user', 'CASCADE', 'CASCADE');
		$this->forge->createTable('pelaporan_komentar', true);
	}

	public function down()
	{
		$this->forge->dropTable('pelaporan_komentar');
	}
}
