<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
  protected $table = 'admin';
  protected $primaryKey = 'kode_admin';
  protected $allowedFields = ['kode_admin', 'nama_admin', 'email_admin', 'password_admin', 'status_admin'];

  protected $useTimestamps = true;
  protected $createdFields = 'created_at';
  protected $updatedFields = 'updated_at';

  public function getAdmin(){
    return $this->findAll();
  }

  public function getDetailAdmin($kode_admin){
    $db = \Config\Database::connect();

    $builder = $db->table('admin');
    $builder->select('*');
    $builder->where('kode_admin', $kode_admin);
    $query = $builder->get();

    return $query->getRowArray();
  }

  public function getDataAdmin($email){
    $db = \Config\Database::connect();

    $builder = $db->table('admin');
    $builder->select('*');
    $builder->where('email_admin', $email);
    $query = $builder->get();

    return $query->getRowArray();
  }

  public function ubahPassword($kode_admin, $data){
    $db = \Config\Database::connect();

    $builder = $db->table('admin');
    $builder->where('kode_admin', $kode_admin);
    $builder->update($data);
  }
}