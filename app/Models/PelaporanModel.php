<?php

namespace App\Models;

use CodeIgniter\Model;

class PelaporanModel extends Model
{
  protected $table = 'pelaporan';
  protected $primaryKey = 'id_laporan';
  protected $allowedFields = ['isi_laporan', 'kode_user', 'id_karya_tulis'];
  
  protected $useTimestamps = true;
  protected $createdFields = 'created_at';
  protected $updatedFields = 'updated_at';

  public function getDaftarPelaporan(){
    $db = \Config\Database::connect();

    $builder = $db->table('pelaporan');
    $builder->select('pelaporan.*, user.kode_user, user.nama_user as nama, user.foto');
    $builder->join('user', 'pelaporan.kode_user = user.kode_user');
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function getDetailPelaporan($id_pelaporan){
    $db = \Config\Database::connect();

    $builder = $db->table('pelaporan');
    $builder->select('pelaporan.*, user.kode_user, user.nama_user as nama, user.foto');
    $builder->join('user', 'pelaporan.kode_user = user.kode_user');
    $builder->where('id_pelaporan', $id_pelaporan);
    $query = $builder->get();

    return $query->getRowArray();
  }
}