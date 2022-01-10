<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
  protected $table = 'profil_sekolah';
  protected $primaryKey = 'kode_profil_sekolah';
  protected $allowedFields = ['nama_sekolah', 'alamat', 'telepon', 'email_sekolah', 'visi', 'misi', 'logo', 'kode_admin'];
  
  protected $useTimestamps = true;
  protected $createdFields = 'created_at';
  protected $updatedFields = 'updated_at';

  public function getDetailProfilSekolah(){
    $db = \Config\Database::connect();

    $builder = $db->table('profil_sekolah');
    $builder->select('profil_sekolah.*, admin.kode_admin, admin.nama_admin as nama');
    $builder->join('admin', 'profil_sekolah.kode_admin = admin.kode_admin');
    $builder->where('kode_profil_sekolah', 'SKL');
    $query = $builder->get();

    return $query->getRowArray();
  }

  public function updateProfilSekolah($kode_profil_sekolah, $data){
    $db = \Config\Database::connect();

    $builder = $db->table('profil_sekolah');
    $builder->where('kode_profil_sekolah', $kode_profil_sekolah);
    $builder->update($data);
  }
}