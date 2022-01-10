<?php

namespace App\Controllers;

use App\Models\KaryaTulisModel;
use App\Models\KomentarModel;
use App\Models\PelaporanKomentarModel;
use App\Models\PelaporanModel;
use App\Models\SekolahModel;
use App\Models\UserModel;
use App\Models\AdminModel;


class Komentar extends BaseController
{
  public function __construct()
  {
    $this->KaryaTulisModel = new KaryaTulisModel();
    $this->KaryaTulisModel = new KaryaTulisModel();
    $this->AdminModel = new AdminModel();
    $this->UserModel = new UserModel();
    $this->SekolahModel = new SekolahModel();
    $this->PelaporanModel = new PelaporanModel();
    $this->KomentarModel = new KomentarModel();
    $this->PelaporanKomentarModel = new PelaporanKomentarModel();
  }

  public function ruangKomentar($id_karya_tulis)
  {
    $kode_user = session()->get('kode_user');

		$data = [
			'title' => "Ruang Komentar",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'karya_tulis' => '',
			'daftar' => '',
			'login' => '',
			'akun_user' => '',
				'my_profile' => '',
				'ubah_password' => '',

			'detail_user' => $this->UserModel->getDetailUser($kode_user),
      'detail_karya_tulis' => $this->KaryaTulisModel->getDetailKaryaTulis($id_karya_tulis),
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
			'daftar_komentar_dalam_karya_tulis' => $this->KomentarModel->getDaftarKomentarDalamKaryaTulis($id_karya_tulis),

      'validation' => \Config\Services::validation(),
		];

		return view('user/ruang_komentar', $data);
  }

  public function saveKomentar(){
    $request = \Config\Services::request();

    $id_karya_tulis = $request->getVar('id_karya_tulis');

    $validation = $this->validate([
      'isi_komentar' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi Komentar tidak boleh kosong'
        ]
      ]
    ]);

    if (!$validation) {
      return redirect()->to('/komentar/ruangKomentar/'. $id_karya_tulis)->withInput();
    }

    $data = [
      'isi_komentar' => $request->getVar('isi_komentar'),
      'kode_user' => session()->get('kode_user'),
      'id_karya_tulis' => $id_karya_tulis,
    ];

    $this->KomentarModel->insert($data);
    session()->setFlashdata('pesan', 'Komentar anda telah diposting');
    return redirect()->to('/komentar/ruangKomentar/'. $id_karya_tulis);
  }

  public function deleteKomentar(){
		$request = \Config\Services::request();

		$id_komentar = $request->getVar('id_komentar');
		$id_karya_tulis = $request->getVar('id_karya_tulis');

		$this->KomentarModel->deleteKomentar($id_komentar);

    if (session()->get('kode_admin')) {
      session()->setFlashdata('pesan', 'Komentar dan pelaporan komentar berhasil dihapus');
      return redirect()->to('/komentar/pelaporanKomentar/'.$id_karya_tulis);
    }
    session()->setFlashdata('pesan', 'Komentar berhasil dihapus');
		return redirect()->to('/komentar/ruangKomentar/'.$id_karya_tulis);
	}

  public function savePelaporan(){
    $request = \Config\Services::request();

    $id_komentar = $request->getVar('id_komentar');

    $detail_komentar = $this->KomentarModel->getDetailKomentar($id_komentar);
    $id_karya_tulis = $detail_komentar['id_karya_tulis'];

    $validation = $this->validate([
      'isi_laporan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi laporan tidak boleh kosong'
        ]
      ]
    ]);

    if (!$validation) {
      return redirect()->to('/komentar/laporkanKomentar/'. $id_komentar)->withInput();
    }

    $data = [
      'isi_laporan_komentar' => $request->getVar('isi_laporan'),
      'kode_user' => session()->get('kode_user'),
      'id_komentar' => $id_komentar,
    ];

    $this->PelaporanKomentarModel->insert($data);
    session()->setFlashdata('pesan', 'Laporan telah dikirim');
    return redirect()->to('/komentar/ruangKomentar/'. $id_karya_tulis);
  }

  public function pelaporanKomentar(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Pelaporan",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => '',
        'user_terkonfirmasi' => '',
        'user_belum_dikonfirmasi' => '',
        'user_banned' => '',
        'user_alumni' => '',
			'karya_tulis' => '',
        'karya_tulis_terkonfirmasi' => '',
        'karya_tulis_belum_dikonfirmasi' => '',
        'karya_tulis_rekomendasi' => '',
			'pelaporan' => 'active',
        'pelaporan_karya_tulis' => '',
        'pelaporan_komentar' => 'active',
			'admin' => '',
			'akun_admin' => '',
				'ubah_password' => '',
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
      'daftar_pelaporan_komentar' => $this->PelaporanKomentarModel->getDaftarPelaporanKomentar()
		];

		return view('admin/pelaporan_komentar',$data);
  }

  public function detailPelaporanKomentar($id_pelaporan_komentar){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Detail Pelaporan Komentar",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => '',
        'user_terkonfirmasi' => '',
        'user_belum_dikonfirmasi' => '',
        'user_banned' => '',
        'user_alumni' => '',
			'karya_tulis' => '',
        'karya_tulis_terkonfirmasi' => '',
        'karya_tulis_belum_dikonfirmasi' => '',
        'karya_tulis_rekomendasi' => '',
			'pelaporan' => '',
        'pelaporan_karya_tulis' => '',
        'pelaporan_komentar' => '',
			'admin' => '',
			'akun_admin' => '',
				'ubah_password' => '',
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
			'detail_pelaporan' => $this->PelaporanKomentarModel->getDetailPelaporanKomentar($id_pelaporan_komentar),
		];

		return view('admin/detail_pelaporan_komentar',$data);
  }

  public function deletePelaporanKomentar(){
    $request = \Config\Services::request();

    $id_pelaporan_komentar = $request->getVar('id_pelaporan_komentar');

    $this->PelaporanKomentarModel->delete($id_pelaporan_komentar);

    session()->setFlashdata('pesan', 'Laporan berhasil dihapus');
    return redirect()->to('/komentar/pelaporanKomentar');
  }

  public function laporkanKomentar($id_komentar)
  {
    $kode_user = session()->get('kode_user');

		$data = [
			'title' => "Ruang Komentar",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'karya_tulis' => '',
			'daftar' => '',
			'login' => '',
			'akun_user' => '',
				'my_profile' => '',
				'ubah_password' => '',

			'detail_user' => $this->UserModel->getDetailUser($kode_user),
      'detail_komentar' => $this->KomentarModel->getDetailKomentar($id_komentar),
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),

      'validation' => \Config\Services::validation(),
		];

		return view('user/laporkan_komentar', $data);
  }
}