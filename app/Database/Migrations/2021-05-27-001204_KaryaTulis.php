<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KaryaTulis extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_karya_tulis' => [
				'type' => 'int',
				'constraint' => 4,
				'auto_increment' => true
			],
			'judul_karya' => [
				'type' => 'varchar',
				'constraint' => 100
			],
			'gambar_karya' => [
				'type' => 'varchar',
				'constraint' => 40,
				'default' => 'karya.png'
			],
			'isi_karya' => [
				'type' => 'text',
			],
			'tag' => [
				'type' => 'varchar',
				'constraint' => 30
			],
			'kode_user' => [
				'type' => 'char',
				'constraint' => 6
			],
			'kode_admin' => [
				'type' => 'char',
				'constraint' => 5
			],
			'direkomendasikan' => [
				'type' => 'boolean',
				'default' => false
			],
			'terkonfirmasi' => [
				'type' => 'boolean',
				'default' => false
			],
			'created_at' => [
				'type' => 'datetime',
				'null' => true
			],
			'updated_at' => [
				'type' => 'datetime',
				'null' => true
			]
		]);

		$this->forge->addPrimaryKey('id_karya_tulis');
		$this->forge->addForeignKey('kode_user', 'user', 'kode_user', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('kode_admin', 'admin', 'kode_admin');
		$this->forge->createTable('karya_tulis', true);
	}

	public function down()
	{
		$this->forge->dropTable('karya_tulis');
	}
}
