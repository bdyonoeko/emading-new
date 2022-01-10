<?php

namespace App\Controllers;

use App\Models\KaryaTulisModel;
use App\Models\PengumumanModel;
use App\Models\SekolahModel;
use App\Models\UserModel;

class Home extends BaseController
{
	public function __construct()
	{
		$this->PengumumanModel = new PengumumanModel();
		$this->SekolahModel = new SekolahModel();
		$this->KaryaTulisModel = new KaryaTulisModel();
		$this->UserModel = new UserModel();
	}

	public function index()
	{
		$kode_user = session()->get('kode_user');

		if (session()->get('kode_admin')) {
			return redirect()->to('/admin');
		}

		$data = [
			'title' => "Home",
			'home' => 'active',
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
			'daftar_pengumuman' => $this->PengumumanModel->getPengumumanLimit3(),
			'daftar_karya_rekomendasi' => $this->KaryaTulisModel->getDaftarKaryaRekomendasiLimit3(),
			'daftar_penulis_teraktif' => $this->UserModel->getPenulisTeraktifLimit3(),
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
		];

		return view('user/home',$data);
	}

	public function karya_tulis()
	{
		$kode_user = session()->get('kode_user');

		$data = [
			'title' => "Karya Tulis",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'karya_tulis' => 'active',
			'daftar' => '',
			'login' => '',
			'akun_user' => '',
				'my_profile' => '',
				'ubah_password' => '',

			'detail_user' => $this->UserModel->getDetailUser($kode_user),
			'daftar_karya_tulis_terkonfirmasi' => $this->KaryaTulisModel->getDaftarKaryaTerkonfirmasi(),
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
		];

		return view('user/karya_tulis',$data);
	}

	public function pengumuman()
	{
		$kode_user = session()->get('kode_user');

		$data = [
			'title' => "Pengumuman",
			'home' => '',
			'sekolah' => 'active',
				'pengumuman' => 'active',
				'profil_sekolah' => '',
			'karya_tulis' => '',
			'daftar' => '',
			'login' => '',
			'akun_user' => '',
				'my_profile' => '',
				'ubah_password' => '',

			'detail_user' => $this->UserModel->getDetailUser($kode_user),
			'daftar_pengumuman' => $this->PengumumanModel->getPengumuman(),
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
		];

		return view('user/pengumuman',$data);
	}

	public function profilSekolah()
	{
		$kode_user = session()->get('kode_user');

		$data = [
			'title' => "Profil Sekolah",
			'home' => '',
			'sekolah' => 'active',
				'pengumuman' => '',
				'profil_sekolah' => 'active',
			'karya_tulis' => '',
			'daftar' => '',
			'login' => '',
			'akun_user' => '',
				'my_profile' => '',
				'ubah_password' => '',

			'detail_user' => $this->UserModel->getDetailUser($kode_user),
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
		];

		return view('user/profil_sekolah',$data);
	}

	public function search(){
		$request = \Config\Services::request();

		$kode_user = session()->get('kode_user');
		$kategori = $request->getVar('kategori');

		if ($kategori == "User") {
			$keyword = $request->getVar('keyword');

			if ($keyword == null) {
				return redirect()->to('/home/karya_tulis');
			}

			$data_search = $this->UserModel->getSearch($keyword);
		} else {
			$keyword = $request->getVar('keyword');

			if ($keyword == null) {
				return redirect()->to('/home/karya_tulis');
			}
			$data_search = $this->KaryaTulisModel->getSearch($keyword);
		}

		$data = [
			'title' => "Karya Tulis",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'karya_tulis' => 'active',
			'daftar' => '',
			'login' => '',
			'akun_user' => '',
				'my_profile' => '',
				'ubah_password' => '',

			'detail_user' => $this->UserModel->getDetailUser($kode_user),
			'data_search' => $data_search,
			'kategori' => $kategori,
			'keyword' => $keyword,
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
		];

		return view('user/pencarian',$data);
	}
}
