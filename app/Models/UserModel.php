<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
  protected $table = "user";
  protected $primaryKey = 'kode_user';
  protected $allowedFields = ['kode_user', 'nama_user', 'email_user', 'password_user', 'jenis_kelamin', 'bio', 'foto', 'kartu_pelajar', 'status'];

  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';

  public function getDataUser($email){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->select('*');
    $builder->where('email_user', $email);
    $query = $builder->get();

    return $query->getRowArray();
  }

  public function getDetailUser($kode_user){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->select('*');
    $builder->where('kode_user', $kode_user);
    $query = $builder->get();

    return $query->getRowArray();
  }

  public function updateProfile($kode_user, $data){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->where('kode_user', $kode_user);
    $builder->update($data);
  }

  public function ubahPassword($kode_user, $data){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->where('kode_user', $kode_user);
    $builder->update($data);
  }

  public function getPenulisTeraktifLimit3(){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->select('karya_tulis.kode_user, user.kode_user, user.nama_user as nama, user.foto, count(karya_tulis.kode_user) as total_karya');
    $builder->join('karya_tulis', 'karya_tulis.kode_user = user.kode_user');
    $builder->where('karya_tulis.terkonfirmasi', true);
    $builder->groupBy('karya_tulis.kode_user');
    $builder->orderBy('total_karya', 'DESC');
    $builder->orderBy('nama_user');
    $builder->limit(3);
    $query = $builder->get();
    
    return $query->getResultArray();
  }

  public function getDaftarUser($status, $limit = null){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->select('*');
    $builder->where('status', $status);
    $builder->orderBy('updated_at', 'DESC');
    $builder->limit($limit);
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function saveUpdateUser($data){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->where('kode_user', $data['kode_user']);
    $builder->update($data);
  }

  public function getSearch($keyword){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->select('*');
    $builder->like('nama_user', $keyword);
    $builder->where('status !=', 'Non-aktif');
    $query = $builder->get();
    
    return $query->getResultArray();
  }
}

?>