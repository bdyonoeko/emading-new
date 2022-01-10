<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
  protected $table = 'komentar';
  protected $primaryKey = 'id_komentar';
  protected $allowedFields = ['id_komentar','isi_komentar', 'kode_user', 'id_karya_tulis'];
  
  protected $useTimestamps = true;
  protected $createdFields = 'created_at';
  protected $updatedFields = 'updated_at';

  public function getDaftarKomentarDalamKaryaTulis($id_karya_tulis){
    $db = \Config\Database::connect();

    $builder = $db->table('komentar');
    $builder->select('komentar.*, user.kode_user, user.nama_user as nama, user.foto');
    $builder->join('user', 'komentar.kode_user = user.kode_user');
    $builder->where('id_karya_tulis', $id_karya_tulis);
    $builder->orderBy('komentar.created_at', 'DESC');
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function deleteKomentar($id_komentar){
    $db = \Config\Database::connect();

    $builder = $db->table('komentar');
    $builder->where('id_komentar', $id_komentar);
    $builder->delete();
  }

  public function getDetailKomentar($id_komentar){
    $db = \Config\Database::connect();

    $builder = $db->table('komentar');
    $builder->select('komentar.*, user.kode_user, user.nama_user as nama, user.foto');
    $builder->join('user', 'komentar.kode_user = user.kode_user');
    $builder->where('id_komentar', $id_komentar);
    $query = $builder->get();

    return $query->getRowArray();
  }
}