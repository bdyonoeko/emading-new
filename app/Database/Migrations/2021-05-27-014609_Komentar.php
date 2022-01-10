<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Komentar extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_komentar' => [
				'type' => 'int',
				'constraint' => 4,
				'auto_increment' => true
			],
			'isi_komentar' => [
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
		
		$this->forge->addPrimaryKey('id_komentar');
		$this->forge->addForeignKey('kode_user', 'user', 'kode_user', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_karya_tulis', 'karya_tulis', 'id_karya_tulis', 'CASCADE', 'CASCADE');
		$this->forge->createTable('komentar');
	}

	public function down()
	{
		$this->forge->dropTable('komentar');
	}
}
