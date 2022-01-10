<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
  public function run()
  {
    $data = [
      'kode_admin' => 'ADM01',
      'nama_admin'    => 'Admin Master',
      'email_admin' => 'AdminMaster@gmail.com',
      'password_admin' => '$2y$10$oazTyBhWYfZvxckOmASrkOVRCS2/oAhTCVvRgqXJB9Tk5IXegFKFS',
      'status_admin' => 'Master',
    ];

    // Using Query Builder
    $this->db->table('admin')->insert($data);
  }
}