<?php

namespace App\Models;

use CodeIgniter\Model;

class PelaporanKomentarModel extends Model
{
  protected $table = 'pelaporan_komentar';
  protected $primaryKey = 'id_pelaporan_komentar';
  protected $allowedFields = ['isi_laporan_komentar', 'kode_user', 'id_komentar'];
  
  protected $useTimestamps = true;
  protected $createdFields = 'created_at';
  protected $updatedFields = 'updated_at';

  public function getDaftarPelaporanKomentar(){
    $db = \Config\Database::connect();

    $builder = $db->table('pelaporan_komentar');
    $builder->select('pelaporan_komentar.*, user.kode_user, user.nama_user as nama, user.foto');
    $builder->join('user', 'pelaporan_komentar.kode_user = user.kode_user');
    $builder->orderBy('created_at', 'DESC');
    $query = $builder->get();

    return $query->getResultArray();
  }

  public function getDetailPelaporanKomentar($id_pelaporan_komentar){
    $db = \Config\Database::connect();

    $builder = $db->table('pelaporan_komentar');
    $builder->select('pelaporan_komentar.*, komentar.id_komentar, komentar.kode_user as kode_terlapor, komentar.isi_komentar, komentar.id_karya_tulis as id_karya_tulis, user.nama_user as nama, user.foto');
    $builder->join('komentar', 'pelaporan_komentar.id_komentar = komentar.id_komentar');
    $builder->join('user', 'user.kode_user = komentar.kode_user');
    $builder->where('id_pelaporan_komentar', $id_pelaporan_komentar);
    $query = $builder->get();

    return $query->getRowArray();
  }

  // public function getKodePelaporTerlapor($id_pelaporan_komentar){
  //   $db = \Config\Database::connect();

  //   $query = $db->query ("
  //     SELECT pelaporan_komentar.id_pelaporan_komentar, pelaporan_komentar.kode_user as kode_pelapor, komentar.kode_user as kode_terlapor From pelaporan_komentar
  //     join komentar on komentar.id_komentar = pelaporan_komentar.id_komentar
  //     join user on komentar.kode_user = user.kode_user
  //     where pelaporan_komentar.id_pelaporan_komentar = $id_pelaporan_komentar 
  //   ");

  //   return $query->getRowArray();
  // }
}