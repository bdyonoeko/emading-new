<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfilSekolahSeeder extends Seeder
{
  public function run()
  {
    $data = [
      'kode_profil_sekolah' => 'SKL',
      'nama_sekolah'    => 'SMAN 1 PEJUANG',
      'alamat'    => 'Jl. Kosambi Klari, Duren, Kec. Klari, Kabupaten Karawang, Jawa Barat 41371',
      'telepon' => '+62 123 4567 8910',
      'kode_admin'    => 'ADM01',
    ];

    // Using Query Builder
    $this->db->table('admin')->insert($data);
  }
}