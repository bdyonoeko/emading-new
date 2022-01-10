<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'kode_user' => [
				'type' => 'char',
				'constraint' => '6'
			],
			'nama_user' => [
				'type' => 'varchar',
				'constraint' => '30'
			],
			'email_user' => [
				'type' => 'varchar',
				'constraint' => '35',
				'unique' => true
			],
			'password_user' => [
				'type' => 'varchar',
				'constraint' => '100'
			],
			'jenis_kelamin' => [
				'type' => 'enum',
				'constraint' => ["Laki-laki", "Perempuan"],
			],
			'bio' => [
				'type' => 'text',
				'default' => 'Author belum mengisi bio'
			],
			'foto' => [
				'type' => 'varchar',
				'constraint' => '40',
				'default' => 'user.png'
			],
			'kartu_pelajar' => [
				'type' => 'varchar',
				'constraint' => '40'
			],
			'status' => [
				'type' => 'enum',
				'constraint' => ["Aktif", "Non-aktif", "Banned", "Alumni"],
				'default' => 'Non-aktif'
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
		$this->forge->addPrimaryKey('kode_user', true);
		$this->forge->createTable('user', true);
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
