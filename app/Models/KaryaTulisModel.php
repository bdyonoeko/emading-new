<?php

namespace App\Models;
use CodeIgniter\Model;

class KaryaTulisModel extends Model{
  protected $table = "karya_tulis";
  protected $primaryKey = 'id_karya_tulis';
  protected $allowedFields = ['judul_karya', 'gambar_karya', 'isi_karya', 'tag','kode_user', 'kode_admin', 'direkomendasikan', 'terkonfirmasi'];

  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';

  public function getDaftarKaryaTerkonfirmasi(){
    $db = \Config\Database::connect();

    $builder = $db->table('karya_tulis');
    $builder->select('karya_tulis.*, user.kode_user, user.nama_user as nama');
    $builder->join('user', 'karya_tulis.kode_user = user.kode_user');
    $builder->orderBy('karya_tulis.updated_at', 'DESC');
    $builder->Where('terkonfirmasi', true);
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function getDaftarKaryaUserTerkirim($kode_user){
    $db = \Config\Database::connect();

    $builder = $db->table('karya_tulis');
    $builder->select('karya_tulis.*, user.kode_user, user.nama_user as nama');
    $builder->join('user', 'karya_tulis.kode_user = user.kode_user');
    $builder->Where('karya_tulis.kode_user', $kode_user);
    $builder->Where('terkonfirmasi', false);
    $builder->orderBy('karya_tulis.updated_at', 'DESC');
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function getDaftarKaryaUser($kode_user){
    $db = \Config\Database::connect();

    $builder = $db->table('karya_tulis');
    $builder->select('karya_tulis.*, user.kode_user, user.nama_user as nama');
    $builder->join('user', 'karya_tulis.kode_user = user.kode_user');
    $builder->orderBy('karya_tulis.updated_at', 'DESC');
    $builder->where('karya_tulis.kode_user', $kode_user);
    $builder->Where('terkonfirmasi', true);
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function getDetailKaryaTulis($id_karya_tulis)
  {
    $db = \Config\Database::connect();

    $builder = $db->table('karya_tulis');
    $builder->select('karya_tulis.*, user.kode_user, user.nama_user as nama, user.foto, admin.nama_admin as nama_admin');
    $builder->join('user', 'karya_tulis.kode_user = user.kode_user');
    $builder->join('admin', 'karya_tulis.kode_admin = admin.kode_admin');
    $builder->where('karya_tulis.id_karya_tulis', $id_karya_tulis);
    $query = $builder->get();

    return $query->getRowArray();
  }

  public function getDaftarKaryaRekomendasiLimit3(){
    $db = \Config\Database::connect();

    $builder = $db->table('karya_tulis');
    $builder->select('karya_tulis.*, user.kode_user, user.nama_user as nama_user');
    $builder->join('user', 'karya_tulis.kode_user = user.kode_user');
    $builder->Where('terkonfirmasi', true);
    $builder->Where('direkomendasikan', true);
    $builder->orderBy('karya_tulis.updated_at', 'RANDOM');
    $builder->limit(3);
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function getDaftarKaryaTulis($status, $limit = null){
    $db = \Config\Database::connect();

    $builder = $db->table('karya_tulis');
    $builder->select('karya_tulis.*, user.kode_user, user.nama_user as nama');
    $builder->join('user', 'karya_tulis.kode_user = user.kode_user');
    $builder->Where('terkonfirmasi', $status);
    $builder->orderBy('karya_tulis.updated_at', 'DESC');
    $builder->limit($limit);
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function getDaftarKaryaTulisRekomendasi(){
    $db = \Config\Database::connect();

    $builder = $db->table('karya_tulis');
    $builder->select('karya_tulis.*, user.kode_user, user.nama_user as nama');
    $builder->join('user', 'karya_tulis.kode_user = user.kode_user');
    $builder->Where('terkonfirmasi', true);
    $builder->Where('direkomendasikan', true);
    $builder->orderBy('karya_tulis.updated_at', 'DESC');
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function saveKonfirmasiKaryaTulis($data){
    $db = \Config\Database::connect();

    $builder = $db->table('karya_tulis');
    $builder->where('id_karya_tulis', $data['id_karya_tulis']);
    $builder->update($data);
  }

  public function getSearch($keyword){
    $db = \Config\Database::connect();

    // $builder = $db->table('karya_tulis');
    // $builder->select('karya_tulis.*, user.kode_user, user.nama_user as nama');
    // $builder->join('user', 'karya_tulis.kode_user = user.kode_user');
    // $builder->where('terkonfirmasi', true);
    // $builder->like('judul_karya', $keyword);
    // $builder->orLike('tag', $keyword);
    // $builder->orLike('nama_user', $keyword);
    // $query = $builder->get();

    $query = $db->query("
      select karya_tulis.*, user.kode_user, user.nama_user as nama from karya_tulis
      join user on karya_tulis.kode_user = user.kode_user
      where terkonfirmasi=true and 
      (
        judul_karya like '%$keyword%' or 
        tag like '%$keyword%' or 
        nama_user like '%$keyword%'
      )
      order by karya_tulis.updated_at desc
    ");

    return $query->getResultArray();
  }
}

?>