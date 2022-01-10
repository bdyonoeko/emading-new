<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admins extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'kode_admin' => [
				'type' => 'char',
				'constraint' => 5
			],
			'nama_admin' => [
				'type' => 'varchar',
				'constraint' => 30,
			],
			'email_admin' => [
				'type' => 'varchar',
				'constraint' => 35,
				'unique' => true
			],
			'password_admin' => [
				'type' => 'varchar',
				'constraint' => 100
			],
			'status_admin' => [
				'type' => 'enum',
				'constraint' => ["Master", "Branch"],
				'default' => 'Branch'
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

		$this->forge->addPrimaryKey('kode_admin');
		$this->forge->createTable('admin', true);
	}

	public function down()
	{
		$this->forge->dropTable('admin');
	}
}
