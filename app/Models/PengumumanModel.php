<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
  protected $table = 'pengumuman';
  protected $primaryKey = 'id_pengumuman';
  protected $allowedFields = ['judul_pengumuman', 'gambar_pengumuman', 'isi_pengumuman', 'kode_admin'];
  
  protected $useTimestamps = true;
  protected $createdFields = 'created_at';
  protected $updatedFields = 'updated_at';

  
  public function getPengumuman(){
    $db = \Config\Database::connect();

    $builder = $db->table('pengumuman');
    $builder->select('pengumuman.*, admin.kode_admin, admin.nama_admin as nama');
    $builder->join('admin', 'admin.kode_admin = pengumuman.kode_admin');
    $builder->orderBy('pengumuman.updated_at', 'DESC');
    $query = $builder->get();
    
    return $query->getResultArray();
  }

  public function getPengumumanLimit3(){
    $db = \Config\Database::connect();

    $builder = $db->table('pengumuman');
    $builder->select('pengumuman.*, admin.kode_admin, admin.nama_admin as nama');
    $builder->join('admin', 'admin.kode_admin = pengumuman.kode_admin');
    $builder->orderBy('pengumuman.updated_at', 'DESC');
    $builder->limit(3);
    $query = $builder->get();
    
    return $query->getResultArray();
  }

  public function getUbahAdminPengumuman($kode_admin){
    $db = \Config\Database::connect();

    $data = [
      'kode_admin' => 'ADM01'
    ];

    $builder = $db->table('pengumuman');
    $builder->where('kode_admin', $kode_admin);
    $builder->update($data);
  }

  public function getDetailPengumuman($id_pengumuman){
    $db = \Config\Database::connect();

    $builder = $db->table('pengumuman');
    $builder->select('pengumuman.*, admin.kode_admin, admin.nama_admin as nama');
    $builder->join('admin', 'pengumuman.kode_admin = admin.kode_admin', 'inner');
    $builder->where('id_pengumuman', $id_pengumuman);
    $query = $builder->get();

    return $query->getRowArray();
  }
}