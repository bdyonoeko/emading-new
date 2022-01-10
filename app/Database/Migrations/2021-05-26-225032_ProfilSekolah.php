<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfilSekolah extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'kode_profil_sekolah' => [
				'type' => 'char',
				'constraint' => '3',
				'default' => 'SKL',
			],
			'nama_sekolah' => [
				'type' => 'varchar',
				'constraint' => '40'
			],
			'alamat' => [
				'type' => 'varchar',
				'constraint' => '80'
			],
			'telepon' => [
				'type' => 'varchar',
				'constraint' => '20'
			],
			'email_sekolah' => [
				'type' => 'varchar',
				'constraint' => '35'
			],
			'visi' => [
				'type' => 'text',
			],
			'misi' => [
				'type' => 'text',
			],
			'logo' => [
				'type' => 'varchar',
				'constraint' => '40',
				'default' => 'logo.png'
			],
			'kode_admin' => [
				'type' => 'char',
				'constraint' => 5
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

		$this->forge->addPrimaryKey('kode_profil_sekolah');
		$this->forge->addForeignKey('kode_admin', 'admin', 'kode_admin');
		$this->forge->createTable('profil_sekolah', true);
	}

	public function down()
	{
		$this->forge->dropTable('profil_sekolah');
	}
}
