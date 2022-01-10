<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengumuman extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pengumuman' => [
				'type' => 'int',
				'constraint' => '4',
				'auto_increment' => true
			],
			'judul_pengumuman' => [
				'type' => 'varchar',
				'constraint' => 200,
			],
			'gambar_pengumuman' => [
				'type' => 'varchar',
				'constraint' => 40,
				'default' => 'pengumuman.png'
			],
			'isi_pengumuman' => [
				'type' => 'text',
			],
			'kode_admin' => [
				'type' => 'char',
				'constraint' => 5,
			],
			'created_at' => [
				'type' => 'datetime',
				'null' => true,
			],
			'updated_at' => [
				'type' => 'datetime',
				'null' => true,
			],
		]);

		$this->forge->addPrimaryKey('id_pengumuman');
		$this->forge->addForeignKey('kode_admin', 'admin', 'kode_admin');
		$this->forge->createTable('pengumuman', true);
	}

	public function down()
	{
		$this->forge->dropTable('pengumuman');
	}
}
