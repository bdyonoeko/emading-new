<?php

namespace App\Controllers;

use App\Models\KaryaTulisModel;
use App\Models\SekolahModel;
use App\Models\UserModel;
use App\Models\AdminModel;

class User extends BaseController
{
  public function __construct()
  {
    $this->UserModel = new UserModel();
    $this->SekolahModel = new SekolahModel();
    $this->KaryaTulisModel = new KaryaTulisModel();
    $this->AdminModel = new AdminModel();
  }

  public function index()
  {
    $kode_user = session()->get('kode_user');

    $data = [
      'title' => 'My Profile',
      'home' => '',
      'sekolah' => '',
        'pengumuman' => '',
        'profil_sekolah' => '',
      'karya_tulis' => '',
      'akun_user' => 'active',
        'my_profile' => 'active',
          'karya_terkonfirmasi' => 'active fw-bold',
          'karya_terkirim' => '',
          'ubah_password' => '',

      'detail_user' => $this->UserModel->getDetailUser($kode_user),
      'daftar_karya_user' => $this->KaryaTulisModel->getDaftarKaryaUser($kode_user),
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
    ];

    return view('user/my_profile', $data);
  }

  public function karyaTerkirim()
  {
    $kode_user = session()->get('kode_user');

    $data = [
      'title' => 'My Profile',
      'home' => '',
      'sekolah' => '',
        'pengumuman' => '',
        'profil_sekolah' => '',
      'karya_tulis' => '',
      'akun_user' => 'active',
        'my_profile' => 'active',
          'karya_terkonfirmasi' => '',
          'karya_terkirim' => 'active fw-bold',
          'ubah_password' => '',

      'detail_user' => $this->UserModel->getDetailUser($kode_user),
      'daftar_karya_user_terkirim' => $this->KaryaTulisModel->getDaftarKaryaUserTerkirim($kode_user),
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
    ];

    return view('user/karya_terkirim', $data);
  }

  public function editProfile()
  {
    $kode_user = session()->get('kode_user');

    $data = [
      'title' => 'My Profile',
      'home' => '',
      'sekolah' => '',
        'pengumuman' => '',
        'profil_sekolah' => '',
      'karya_tulis' => '',
      'akun_user' => 'active',
        'my_profile' => 'active',
        'ubah_password' => '',

      'detail_user' => $this->UserModel->getDetailUser($kode_user),
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),

      'validation' => \Config\Services::validation(),
    ];

    return view('user/edit_profile', $data);
  }

  public function saveEditProfile($kode_user){
    $request = \Config\Services::request();

    $emailLama = $request->getVar('email_lama');
    $emailBaru = $request->getVar('email');

    if ($emailBaru == $emailLama) {
      $rule_email = "required|valid_email|max_length[100]";
    } else {
      $rule_email = "required|valid_email|is_unique[user.email_user]|max_length[100]";
    }

    // validasi
      $validation = $this->validate([
        'nama' => [
          'rules' => 'required|max_length[100]',
          'errors' => [
            'required' => 'Nama tidak boleh kosong',
            'max_length' => 'Nama terlalu panjang',
          ]
        ],
        'email' => [
          'rules' => $rule_email,
          'errors' => [
            'required' => 'Email tidak boleh kosong',
            'max_length' => 'Email terlalu panjang',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email telah terdaftar',
          ]
        ],
        'bio' => [
          'rules' => 'required|max_length[150]',
          'errors' => [
            'required' => 'Bio tidak boleh kosong',
            'max_length' => 'Bio terlalu panjang',
          ]
        ],
        'foto' => [
          'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/png,image/jpeg]',
          'errors' => [
            'max_size' => 'Foto tidak boleh lebih dari 2Mb',
            'is_image' => 'Upload foto dengan ext .jpg/.png/.jpeg',
            'mime_in' => 'Upload foto dengan ext .jpg/.png/.jpeg',
          ]
        ],
      ]);

      if (!$validation) {
        return redirect()->to('/user/editProfile/'.$kode_user)->withInput();
      }
    // end validasi

    else {
      // konfigurasi foto
        $fotoLama = $request->getVar('foto_lama');
        $fileFoto = $request->getFile('foto');

        if ($fileFoto->getError() == 4) {
          $namaFoto = $fotoLama;
        } else {
          $namaFoto = $fileFoto->getRandomName();
          $fileFoto->move('img/user/profil/', $namaFoto);

          if ($fotoLama != 'user.png') {
            unlink('img/user/profil/'. $fotoLama);
          }
        }
      // end konfigurasi foto

      // save data
        $data = [
          'nama_user' => $request->getVar('nama'),
          'email_user' => $request->getVar('email'),
          'bio' => $request->getVar('bio'),
          'foto' => $namaFoto
        ];

        $this->UserModel->updateProfile($kode_user, $data);
      // end save data

      session()->setFlashdata('pesan', 'Data profile berhasil diupdate');
      return redirect()->to('/user');
    }
  }

  public function profileAuthor($kode_author)
  {
    
    if (session()->get('kode_user')) {
      $kode_user = session()->get('kode_user');  
      $detail_user = $this->UserModel->getDetailUser($kode_user);
      $detail_admin = '';
    } else {
      $kode_admin = session()->get('kode_admin');  
      $detail_admin = $this->AdminModel->getDetailAdmin($kode_admin);
      $detail_user = '';
    }

    $data = [
      'title' => 'Profile Author',
      'home' => '',
      'sekolah' => '',
        'pengumuman' => '',
        'profil_sekolah' => '',
      'karya_tulis' => '',
      'akun_user' => '',
        'my_profile' => '',
          'karya_author' => 'active fw-bold',
          'data_author' => '',
        'ubah_password' => '',
      'daftar' => '',
      'login' => '',

      'detail_user' => $detail_user,
      'detail_author' => $this->UserModel->getDetailUser($kode_author),
      'detail_admin' => $detail_admin,
      'kode_author' => $kode_author,
      'daftar_karya_user' => $this->KaryaTulisModel->getDaftarKaryaUser($kode_author),
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
    ];

    return view('user/profile_author', $data);
  }

  public function userAktif(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Daftar User",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => 'active',
        'user_terkonfirmasi' => 'active',
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
			'validation' => \Config\Services::validation(),
			'daftar_user_aktif' => $this->UserModel->getDaftarUser('Aktif'),
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
		];

		return view('admin/user_aktif',$data);
  }

  public function userBaru(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Daftar User",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => 'active',
        'user_terkonfirmasi' => '',
        'user_belum_dikonfirmasi' => 'active',
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
			'validation' => \Config\Services::validation(),
			'daftar_user_belum_dikonfirmasi' => $this->UserModel->getDaftarUser('Non-aktif'),
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
		];

		return view('admin/user_baru',$data);
  }

  public function userBanned(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Daftar User",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => 'active',
        'user_terkonfirmasi' => '',
        'user_belum_dikonfirmasi' => '',
        'user_banned' => 'active',
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
			'validation' => \Config\Services::validation(),
			'daftar_user_banned' => $this->UserModel->getDaftarUser('Banned'),
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
		];

		return view('admin/user_banned',$data);
  }

  public function userAlumni(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Daftar User",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => 'active',
        'user_terkonfirmasi' => '',
        'user_belum_dikonfirmasi' => '',
        'user_banned' => '',
        'user_alumni' => 'active',
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
			'validation' => \Config\Services::validation(),
			'daftar_user_alumni' => $this->UserModel->getDaftarUser('Alumni'),
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
		];

		return view('admin/user_alumni',$data);
  }

  public function deleteUser(){
    $request = \Config\Services::request();

    $kode_user = $request->getVar('kode_user');
    $halaman = $request->getVar('halaman');
    
    $detail_user = $this->UserModel->getDetailUser($kode_user);

    if ($detail_user['foto'] != 'user.png') {
      unlink('img/user/profil/'. $detail_user['foto']);
    }

    $this->UserModel->delete($kode_user);

    session()->setFlashdata('pesan', 'User berhasil dihapus');
    return redirect()->to('/user/'. $halaman);
  }

  public function detailUser($kode_user)
  {
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Detail User",
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
			'validation' => \Config\Services::validation(),
			'detail_user' => $this->UserModel->getDetailUser($kode_user),
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
		];

    return view('admin/detail_user', $data);
  }

  public function saveEditUser(){
    $request = \Config\Services::request();

    $status = $request->getVar('status');

    $data = [
      'kode_user' => $request->getVar('kode_user'),
      'status' => $status,
    ];

    $this->UserModel->saveUpdateUser($data);

    if ($status == "Aktif") {
      session()->setFlashdata('pesan', 'User berhasil dikonfirmasi');
      return redirect()->to('/user/userAktif');
    } 
    elseif ($status == "Banned") {
      session()->setFlashdata('pesan', 'User berhasil dibanned');
      return redirect()->to('/user/userBanned');
    }
    elseif ($status == "Alumni") {
      session()->setFlashdata('pesan', 'User menjadi alumni');
      return redirect()->to('/user/userAlumni');
    } 
    else{
      session()->setFlashdata('pesan', 'Status user tidak diubah');
      return redirect()->to('/user/userBaru');
    }
  }
}