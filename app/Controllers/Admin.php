<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\PengumumanModel;
use App\Models\KaryaTulisModel;
use App\Models\PelaporanModel;
use App\Models\PelaporanKomentarModel;

class Admin extends BaseController
{
	protected $AdminModel;

	public function __construct()
	{
		$this->UserModel = new UserModel();
		$this->KaryaTulisModel = new KaryaTulisModel();
		$this->AdminModel = new AdminModel();
		$this->PengumumanModel = new PengumumanModel();
		$this->PelaporanModel = new PelaporanModel();
		$this->PelaporanKomentarModel = new PelaporanKomentarModel();
	}

  public function index()
  {
		$kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Home",
			'home' => 'active',
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
			'daftar_user' => $this->UserModel->getDaftarUser('Non-aktif', 5),
			'total_user' => $this->UserModel->getDaftarUser('Non-aktif'),
			'daftar_karya' => $this->KaryaTulisModel->getDaftarKaryaTulis(false, 5),
			'total_karya' => $this->KaryaTulisModel->getDaftarKaryaTulis(false),
			'daftar_pelaporan' => $this->PelaporanModel->getDaftarPelaporan(),
			'daftar_pelaporan_komentar' => $this->PelaporanKomentarModel->getDaftarPelaporanKomentar(),
		];

		return view('admin/index',$data);
  }

	public function admin()
  {
		$kode_admin = session()->get('kode_admin');

		$data = [
			'title' => "Admin",
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
			'admin' => 'active',
			'akun_admin' => '',
				'ubah_password' => '',

			'validation' => \Config\Services::validation(),
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
			'daftar_admin' => $this->AdminModel->getAdmin(),
		];

		return view('admin/admin',$data);
  }

	public function save(){
		$request = \Config\Services::request();

		// validasi
			$validation = $this->validate([
				'nama' => [
					'rules' => 'required|max_length[100]',
					'errors' => [
						'required' => 'Nama tidak boleh kosong',
						'max_length' => 'Nama terlalu panjang'
					]
				],
				'email' => [
					'rules' => 'required|valid_email|is_unique[admin.email_admin]|max_length[100]',
					'errors' => [
						'required' => 'Email tidak boleh kosong',
						'valid_email' => 'Email tidak valid',
						'is_unique' => 'Email telah terdaftar',
						'max_length' => 'Email terlalu panjang'
					]
				],
				'password' => [
					'rules' => 'required|min_length[5]',
					'errors' => [
						'required' => 'Password tidak boleh kosong',
						'min_length' => 'Password terlalu pendek',
					]
				],
				'password2' => [
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'Konfirmasi password tidak boleh kosong',
						'matches' => 'Password tidak sama'
					]
				],
			]);

			if (!$validation) {
				return redirect()->to('/admin/admin')->withInput();
			}
		// end validasi
		else {
			// pengkodean otomatis
				$koneksi = mysqli_connect('localhost', 'root', '', 'emading');
				$query = mysqli_query($koneksi, 'SELECT max(kode_admin) as kode_terbesar FROM admin');
				$data_admin = mysqli_fetch_array($query);
				$kode_admin = $data_admin['kode_terbesar'];
				$urutan = (int) substr($kode_admin, 3, 2);
				$urutan++;
				$huruf = "ADM";
				$kode_admin = $huruf.sprintf('%02s', $urutan);
			// end pengkodean otomatis
	
			// save data
				$this->AdminModel->insert([
					'kode_admin' => $kode_admin,
					'nama_admin' => $request->getVar('nama'),
					'email_admin' => $request->getVar('email'),
					'status_admin' => $request->getVar('status'),
					'password_admin' => password_hash($request->getVar('password'), PASSWORD_BCRYPT),
				]);
			// end save data

			session()->setFlashdata('pesan', 'Admin berhasil ditambahkan');

			return redirect()->to('/admin/admin');
		}
	}

	public function delete(){
		$request = \Config\Services::request();

		$kode_admin = $request->getVar('kode_admin');
		$this->PengumumanModel->getUbahAdminPengumuman($kode_admin);

		$this->AdminModel->delete($kode_admin);

		session()->setFlashdata('pesan', 'Data berhasil dihapus');
		return redirect()->to('/admin/admin');
	}

	public function edit($data_admin)
  {
		$kode_admin = session()->get('kode_admin');

		$data = [
			'title' => "Admin",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'pelaporan' => '',
				'pelaporan_karya_tulis' => '',
        'pelaporan_komentar' => '',
			'user' => '',
				'user_terkonfirmasi' => '',
				'user_belum_dikonfirmasi' => '',
				'user_banned' => '',
				'user_alumni' => '',
			'karya_tulis' => '',
				'karya_tulis_terkonfirmasi' => '',
        'karya_tulis_belum_dikonfirmasi' => '',
				'karya_tulis_rekomendasi' => '',
			'admin' => 'active',
			'akun_admin' => '',
				'ubah_password' => '',

			'validation' => \Config\Services::validation(),
			'daftar_admin' => $this->AdminModel->getAdmin(),
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
			'data_admin' => $this->AdminModel->getDetailAdmin($data_admin),
		];

		return view('admin/detail_admin',$data);
  }

	public function editSave($kode_admin){
		$request = \Config\Services::request();
		
		// cek email
			$emailLama = $this->AdminModel->getDetailAdmin($kode_admin);

			if ($emailLama['email_admin'] == $request->getVar('email')) {
				$rule_email = 'required|valid_email|max_length[100]';
			} else {
				$rule_email = 'required|is_unique[admin.email]|valid_email|max_length[100]';
			}
		// end cek email

		// validasi
			$validation = $this->validate([
				'nama' => [
					'rules' => 'required|max_length[100]',
					'errors' => [
						'required' => 'Nama tidak boleh kosong',
						'max_length' => 'Nama terlalu panjang'
					]
				],
				'email' => [
					'rules' => $rule_email,
					'errors' => [
						'required' => 'Email tidak boleh kosong',
						'valid_email' => 'Email tidak valid',
						'is_unique' => 'Email telah terdaftar',
						'max_length' => 'Email terlalu panjang'
					]
				],
			]);

			if (!$validation) {
				return redirect()->to('/admin/edit/'. $kode_admin)->withInput();
			}
		// end validasi
		else {
		// save data
			$this->AdminModel->save([
				'kode_admin' => $kode_admin,
				'nama_admin' => $request->getVar('nama'),
				'email_admin' => $request->getVar('email'),
				'status_admin' => $request->getVar('status')
			]);
		// end save data

			session()->setFlashdata('pesan', 'Data berhasil diupdate');

			return redirect()->to('/admin/admin');		
		}
	}
}