<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\SekolahModel;
use App\Models\UserModel;

class Auth extends BaseController
{
  protected $UserModel;

  public function __construct()
  {
    $this->UserModel = new UserModel();
    $this->SekolahModel = new SekolahModel();
    $this->AdminModel = new AdminModel();
  }

	public function index()
	{
		$data=[
			'title' => "Login",
			'home' => '',
			'sekolah' => '',
        'pengumuman' => '',
        'profil_sekolah' => '',
			'karya_tulis' => '',
			'daftar' => '',
			'login' => 'active',

      'user' => '',
        'daftar_user' => '',
    
      'validation' => \Config\Services::validation(),
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
		];

		return view('auth/login',$data);
	}

	public function login()
	{
		$request = \Config\Services::request();

    $email = $request->getVar('email');
    $password = $request->getVar('password');

    $dataUser = $this->UserModel->getDataUser($email);
    $dataAdmin = $this->AdminModel->getDataAdmin($email);

    if ($dataUser) {
      $rules_email = 'required|valid_email|is_not_unique[user.email_user]';
    } elseif ($dataAdmin) {
      $rules_email = 'required|valid_email|is_not_unique[admin.email_admin]';
    } else {
      $rules_email = 'required|valid_email|is_not_unique[user.email_user]';
    }

    // validasi
      $validation = $this->validate([
        'email' => [
          'rules' => $rules_email,
          'errors' => [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
            'is_not_unique' => 'Email tidak terdaftar',
          ]
        ],
        'password' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Password tidak boleh kosong'
          ]
        ],
      ]);
      
      if (!$validation) {
        return redirect()->to('/auth')->withInput();
      }
    // end validasi
    
    if ($dataUser) {
      // cek password
      if (password_verify($password, $dataUser['password_user'])) {
        // cek status
        if ($dataUser['status'] == "Aktif") {
          session()->set([
            'kode_user' => $dataUser['kode_user'],
            'logged_in' => true
          ]);
          return redirect()->to('/user');
        } 
        elseif ($dataUser['status'] == "Non-aktif") {
          session()->setFlashdata('pesan', 'Akun anda belum dikonfirmasi admin. Harap menunggu');
          return redirect()->to('/auth');
        } 
        elseif ($dataUser['status'] == "Banned") {
          session()->setFlashdata('pesan', 'Akun anda telah dibanned');  
          return redirect()->to('/auth');
        } 
        else {
          session()->setFlashdata('pesan', 'Anda sudah menjadi alumni');
          return redirect()->to('/auth');
        }
      } 
      else {
        session()->setFlashdata('pesan', 'Password salah');
        return redirect()->to('/auth')->withInput();
      } 
    }
    elseif ($dataAdmin) {
      // cek password
      if (password_verify($password, $dataAdmin['password_admin'])) {
        session()->set([
          'kode_admin' => $dataAdmin['kode_admin'],
          'status_admin' => $dataAdmin['status_admin'],
          'logged_in' => true
        ]);
        return redirect()->to('/admin');
      }
      else {
        session()->setFlashdata('pesan', 'Password salah');
        return redirect()->to('/auth')->withInput();
      }
    }
	}

  public function logout(){
    session()->destroy();

    session()->setFlashdata('sukses', 'Data anda telah ditampung. Harap menunggu konfirmasi admin');
    return redirect()->to('/auth');
  }

  public function registrasi(){
    $data=[
			'title' => "Daftar",
			'home' => '',
			'sekolah' => '',
			'pengumuman' => '',
			'profil_sekolah' => '',
			'karya_tulis' => '',
			'daftar' => 'active',
			'login' => '',
      'validation' => \Config\Services::validation(),
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
		];

		return view('auth/registrasi',$data);
  }

  public function saveRegistrasi(){
    $request = \Config\Services::request();

    // validasi
    $validation = $this->validate([
      'nama' => [
        'rules' => 'required|max_length[30]',
        'errors' => [
          'required' => 'Nama tidak boleh kosong',
          'max_length' => 'Nama terlalu panjang'
        ]
      ],
      'jenis_kelamin' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Jenis kelamin tidak boleh kosong'
        ]
      ],
      'email' => [
        'rules' => 'required|is_unique[user.email_user]|valid_email|max_length[35]',
        'errors' => [
          'required' => 'Email tidak boleh kosong',
          'is_unique' => 'Email telah terdaftar',
          'valid_email' => 'Email tidak valid',
          'max_length' => 'Email terlalu panjang'
        ]
      ],
      'kartu_pelajar' => [
        'rules' => 'uploaded[kartu_pelajar]|max_size[kartu_pelajar,2048]|is_image[kartu_pelajar]|mime_in[kartu_pelajar,image/jgp,image/jpeg,image/png]',
        'errors' => [
          'uploaded' => 'Gambar tidak boleh kosong',
          'max_size' => 'Gambar tidak boleh lebih dari 2 Mb',
          'is_image' => 'Upload gambar dengan ext .jpg/png/jpeg',
          'mime_in' => 'Upload gambar dengan ext .jpg/png/jpeg'
        ]
      ],
      'password' => [
        'rules' => 'required|min_length[5]',
        'errors' => [
          'required' => 'Password tidak boleh kosong',
          'min_length' => 'Password terlalu pendek'
        ]
      ],
      'password2' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'Konfirmasi password tidak boleh kosong',
          'matches' => 'Konfirmasi password tidak sama',
        ]
      ]
    ]);

    if (!$validation) {
      return redirect()->to('/auth/registrasi')->withInput();
    }
    // end validasi

    // konfigurasi gambar
      $fileKartuPelajar = $request->getFile('kartu_pelajar');

      $namaKartuPelajar = $fileKartuPelajar->getRandomName();
      $fileKartuPelajar->move('img/user/kartu_pelajar/', $namaKartuPelajar);
    // end konfigurasi gambar

    // pengkodean otomatis
      $koneksi = mysqli_connect('localhost', 'root', '', 'emading');
      $query = mysqli_query($koneksi, 'SELECT max(kode_user) as kode_terbesar FROM user');
      $data_user = mysqli_fetch_array($query);
      $kode_user = $data_user['kode_terbesar'];
      $urutan = (int) substr($kode_user, 3, 3);
      $urutan++;
      $huruf = "USR";
      $kode_user = $huruf.sprintf('%03s', $urutan);
    // end pengkodean otomatis

    // simpan user
      $data = [
        'kode_user' => $kode_user,
        'nama_user' => $request->getVar('nama'),
        'email_user' => $request->getVar('email'),
        'jenis_kelamin' => $request->getVar('jenis_kelamin'),
        'kartu_pelajar' => $namaKartuPelajar,
        'password_user' => password_hash($request->getVar('password'), PASSWORD_BCRYPT),
      ];
      
      $this->UserModel->insert($data);
    // end simpan user

    session()->setFlashdata('sukses', 'Data anda telah ditampung. Harap menunggu konfirmasi admin');
    return redirect()->to('/auth');
  }

  public function ubahPassword(){
    // cek role yang login
      if (session()->get('kode_user')) {
        $kode_user = session()->get('kode_user');
        $detail_user = $this->UserModel->getDetailUser($kode_user);
        $akun_user = 'active';

        $detail_admin = '';
        $akun_admin = '';
      } else {
        $kode_admin = session()->get('kode_admin');
        $detail_admin = $this->AdminModel->getDetailAdmin($kode_admin);
        $akun_admin = 'active';

        $detail_user = '';
        $akun_user = '';
      }
    // end cek role

    $data = [
      'title' => 'Ubah Password',
      'home' => '',
      'sekolah' => '',
        'pengumuman' => '',
        'profil_sekolah' => '',
      'karya_tulis' => '',
      'akun_user' => $akun_user,
        'my_profile' => '',
        'ubah_password' => 'active',

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
      'akun_admin' => $akun_admin,

      'detail_admin' => $detail_admin,
      'detail_user' => $detail_user,
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
      'validation' => \Config\Services::validation(),
    ];

    return view('auth/ubah_password', $data);
  }

  public function konfirmasiPassword(){
    $request = \Config\Services::request();

    // cek role yang login
      if (session()->get('kode_user')) {
        $kode_user = session()->get('kode_user');
        $detail_user = $this->UserModel->getDetailUser($kode_user);
      } else {
        $kode_admin = session()->get('kode_admin');
        $detail_admin = $this->AdminModel->getDetailAdmin($kode_admin);
        $detail_user = '';
      }
    // end cek role

    // validasi
      $validation = $this->validate([
        'password' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Password tidak boleh kosong',
          ]
        ]
      ]);

      if (!$validation) {
        return redirect()->to('/auth/ubahPassword')->withInput();
      }
    // end validasi

    // user
      $password = $request->getVar('password');

      if ($detail_user) {
        if (password_verify($password, $detail_user['password_user'])) {
          return redirect()->to('/auth/passwordBaru');
        } else {
          session()->setFlashdata('pesan', "Password salah");
          return redirect()->to('/auth/ubahPassword');
        }
      } 
    // admin
      else {
        if (password_verify($password, $detail_admin['password_admin'])) {
          return redirect()->to('/auth/passwordBaru');
        } else {
          session()->setFlashdata('pesan', "Password salah");
          return redirect()->to('/auth/ubahPassword');
        }
      }
    // end
  }

  public function passwordBaru(){
    // cek role yang login
      if (session()->get('kode_user')) {
        $kode_user = session()->get('kode_user');
        $detail_user = $this->UserModel->getDetailUser($kode_user);
        $akun_user = 'active';

        $detail_admin = '';
        $akun_admin = '';
      } else {
        $kode_admin = session()->get('kode_admin');
        $detail_admin = $this->AdminModel->getDetailAdmin($kode_admin);
        $akun_admin = 'active';

        $detail_user = '';
        $akun_user = '';
      }
    // end cek role

    $data = [
      'title' => 'Ubah Password',
      'home' => '',
      'sekolah' => '',
        'pengumuman' => '',
        'profil_sekolah' => '',
      'karya_tulis' => '',
      'akun_user' => $akun_user,
        'my_profile' => '',
        'ubah_password' => 'active',

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
      'akun_admin' => $akun_admin,

      'detail_admin' => $detail_admin,
      'detail_user' => $detail_user,
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
      'validation' => \Config\Services::validation(),
    ];

    return view('auth/password_baru', $data);
  }

  public function savePasswordBaru(){
    $request = \Config\Services::request();

    if (session()->get('kode_user')) {
      $kode_user = session()->get('kode_user');
    } else {
      $kode_admin = session()->get('kode_admin');
      $kode_user = '';
    }

    // validasi
      $validation = $this->validate([
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
            'matches' => 'Password tidak sama',
          ]
        ]
      ]);

      if (!$validation) {
        return redirect()->to('/auth/passwordBaru')->withInput();
      }
    // end validasi

    // simpan perubahan password
      if ($kode_user) {
        $data = [
          'password_user' => password_hash($request->getVar('password'), PASSWORD_BCRYPT),
        ];

        $this->UserModel->ubahPassword($kode_user, $data);
        
        session()->setFlashdata('pesan', 'Password anda telah diubah');
        return redirect()->to('/user');
      } else {
        $data = [
          'password_admin' => password_hash($request->getVar('password'), PASSWORD_BCRYPT),
        ];

        $this->AdminModel->ubahPassword($kode_admin, $data);

        session()->setFlashdata('pesan', 'Password anda telah diubah');
        return redirect()->to('/admin');
      }
    // end simpan perubahan password
  }

  public function ubahPasswordUserOlehAdmin($kode_user){
    $kode_admin = session()->get('kode_admin');

    $data = [
      'title' => 'Ubah Password User',
      'home' => '',
      'sekolah' => '',
        'pengumuman' => '',
        'profil_sekolah' => '',
      'karya_tulis' => '',
      'akun_user' => '',
        'my_profile' => '',
        'ubah_password' => 'active',

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
      
      'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
      'detail_user' => $this->UserModel->getDetailUser($kode_user),
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
      'validation' => \Config\Services::validation(),
    ];

    return view('auth/ubah_password_user_oleh_admin', $data);
  }

  public function saveUbahPasswordUserOlehAdmin(){
    $request = \Config\Services::request();

    // validasi
      $validation = $this->validate([
        'password' => [
          'rules' => 'required|min_length[5]',
          'errors' => [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password terlalu pendek',
          ]
        ],
      ]);

      if (!$validation) {
        return redirect()->to('/auth/ubahPasswordUserOlehAdmin')->withInput();
      }
    // end validasi

    // Simpan
      $kode_user = $request->getVar('kode_user');

      $data = [
        'kode_user' => $kode_user,
        'password_user' => password_hash($request->getVar('password'), PASSWORD_BCRYPT),
      ];

      $this->UserModel->saveUpdateUser($data);
      session()->setFlashdata('pesan', 'Password user ini telah diubah');
      return redirect()->to('/user/detailUser/'. $kode_user);
    // end simpan
  }
}

