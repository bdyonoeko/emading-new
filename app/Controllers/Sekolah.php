<?php

namespace App\Controllers;

use App\Models\PengumumanModel;
use App\Models\SekolahModel;
use App\Models\UserModel;
use App\Models\AdminModel;

class Sekolah extends BaseController
{
  public function __construct()
  {
    $this->PengumumanModel = new PengumumanModel();
    $this->SekolahModel = new SekolahModel();
    $this->UserModel = new UserModel();
    $this->AdminModel = new AdminModel();
  }

  public function index()
  {
    // cek role yang login
      if (session()->get('kode_user')) {
        $kode_user = session()->get('kode_user');
        $detail_user = $this->UserModel->getDetailUser($kode_user);
        $akun_user = '';

        $detail_admin = '';
        $akun_admin = '';
      } else {
        $kode_admin = session()->get('kode_admin');
        $detail_admin = $this->AdminModel->getDetailAdmin($kode_admin);
        $akun_admin = '';

        $detail_user = '';
        $akun_user = '';
      }
    // end cek role

    $data = [
      'title' => 'Profil Sekolah',
      'home' => '',
      'sekolah' => 'active',
        'pengumuman' => '',
        'profil_sekolah' => 'active',
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
    ];
    
    return view('admin/profil_sekolah', $data);
  }
  
  public function editProfilSekolah()
  {
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Profil Sekolah",
			'home' => '',
			'sekolah' => 'active',
        'pengumuman' => '',
        'profil_sekolah' => 'active',
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
      'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
      'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
		];

    return view('admin/edit_profil_sekolah', $data);
  }

  public function saveEditProfilSekolah($kode_profil_sekolah){
    $request = \Config\Services::request();

    // validasi
      $validation = [
        'nama_sekolah' => [
          'rules' => 'required|max_length[255]',
          'errors' => [
            'required' => 'Nama sekolah tidak boleh kosong',
            'max_length' => 'Nama sekolah terlalu panjang'
          ]
        ],
        'alamat' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Alamat sekolah tidak boleh kosong',
          ]
        ],
        'telepon' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Telepon tidak boleh kosong'
          ]
        ],
        'email' => [
          'rules' => 'required|valid_email',
          'errors' => [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid'
          ]
        ],
        'visi' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Visi tidak boleh kosong',
          ]
        ],
        'misi' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Misi tidak boleh kosong',
          ]
        ],
        'logo' => [
          'rules' => 'max_size[logo,2048]|is_image[logo]|mime_in[logo,image/jpg,image/png,image/jpeg]',
          'errors' => [
            'max_size' => 'Logo tidak boleh lebih dari 2Mb',
            'is_image' => 'Upload logo dengan ext .jpg/.png./jpeg',
            'mime_in' => 'Upload logo dengan ext .jpg/.png./jpeg',
          ]
        ],
      ];

      if (!$validation) {
        return redirect()->to('/sekolah/editProfilSekolah')->withInput();
      }
    // end validasi
    else {
      // konfigurasi Logo
        $fileLogo = $request->getFile('logo');
        $logoLama = $request->getVar('logo_lama');

        if ($fileLogo->getError() == 4) {
          $namaLogo = $logoLama;
        } else {
          $namaLogo = $fileLogo->getRandomName();
          $fileLogo->move('img/logo', $namaLogo);

          if ($logoLama != 'logo.png') {
            unlink('img/logo/'.$logoLama);
          }
        }
      // end konfigurasi Logo

      // save data
        $data = [
          'nama_sekolah' => $request->getVar('nama_sekolah'),
          'alamat' => $request->getVar('alamat'),
          'telepon' => $request->getVar('telepon'),
          'email_sekolah' => $request->getVar('email'),
          'visi' => $request->getVar('visi'),
          'misi' => $request->getVar('misi'),
          'logo' => $namaLogo,
          'kode_admin' => session()->get('kode_admin'),
        ];
        $kode_profil_sekolah = $kode_profil_sekolah;
        
        $this->SekolahModel->updateProfilSekolah($kode_profil_sekolah, $data);
      // end save data

      session()->setFlashdata('pesan', 'Data berhasil diupdate');
      return redirect()->to('/sekolah');
    }
  }

  public function pengumuman(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Pengumuman",
			'home' => '',
			'sekolah' => 'active',
        'pengumuman' => 'active',
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

      'daftar_pengumuman' => $this->PengumumanModel->getPengumuman(),
      'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
		];

    return view('admin/pengumuman', $data);
  }

  public function createPengumuman(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Pengumuman",
			'home' => '',
			'sekolah' => 'active',
        'pengumuman' => 'active',
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
      'validation' => \Config\Services::validation(),
		];

    return view('admin/create_pengumuman', $data);
  }

  public function savePengumuman(){
    $request = \Config\Services::request();

    // validasi
      $validation = $this->validate([
        'judul' => [
          'rules' => 'required|max_length[100]',
          'errors' => [
            'required' => 'Judul tidak boleh kosong',
            'max_length' => 'Judul terlalu panjang',
          ]
        ],
        'gambar' => [
          'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar tidak boleh lebih dari 2Mb',
            'is_image' => 'Upload gambar dengan ext .jpg/.png/.jpeg',
            'mime_in' => 'Upload gambar dengan ext .jpg/.png/.jpeg',
          ]
        ],
        'isi' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Isi tidak boleh kosong',
          ]
        ],
      ]);

      if (!$validation) {
        return redirect()->to('/sekolah/createPengumuman')->withInput();
      }
    // end validasi
    else {
      // konfigurasi gambar
        $fileGambar = $request->getFile('gambar');
  
        if ($fileGambar->getError() == 4) {
          $namaGambar = 'pengumuman.png';
        } else {
          $namaGambar = $fileGambar->getRandomName();
          $fileGambar->move('img/pengumuman/', $namaGambar);
        }
      // end konfigurasi gambar
  
      // save data
        $this->PengumumanModel->insert([
          'judul_pengumuman' => $request->getVar('judul'),
          'isi_pengumuman' => $request->getVar('isi'),
          'gambar_pengumuman' => $namaGambar,
          'kode_admin' => session()->get('kode_admin'),
        ]);
      // end save data
  
      session()->setFlashdata('pesan', 'Pengumuman berhasil ditambahkan');
      return redirect()->to('/sekolah/pengumuman');
    }
  }

  public function editPengumuman($id_pengumuman){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Pengumuman",
			'home' => '',
			'sekolah' => 'active',
        'pengumuman' => 'active',
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
      'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
      'detail_pengumuman' => $this->PengumumanModel->getDetailPengumuman($id_pengumuman),
		];

    return view('admin/edit_pengumuman', $data);
  }

  public function saveEditPengumuman($id_pengumuman){
    $request = \Config\Services::request();

    // validasi
      $validation = $this->validate([
        'judul' => [
          'rules' => 'required|max_length[100]',
          'errors' => [
            'required' => 'Judul tidak boleh kosong',
            'max_length' => 'Judul terlalu panjang'
          ]
        ],
        'isi' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Isi tidak boleh kosong'
          ]
        ],
        'gambar' => [
          'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar tidak boleh lebih dari 2Mb',
            'is_image' => 'Upload gambar dengan ext .jpg/.png/.jpeg',
            'mime_in' => 'Upload gambar dengan ext .jpg/.png/.jpeg',
          ]
        ],
      ]);

      if (!$validation) {
        return redirect()->to('/pengumuman/editPengumuman/'.$id_pengumuman)->withInput();
      }
    // end validasi

    // konfigurasi gambar
      $fileGambar = $request->getFile('gambar');
      $gambarLama = $request->getvar('gambar_lama');

      if ($fileGambar->getError() == 4) {
        $namaGambar = $gambarLama;
      } else {
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('img/pengumuman/', $namaGambar);

        if ($gambarLama != 'pengumuman.png') {
          unlink('img/pengumuman/'. $gambarLama);
        }
      }
    // end konfigurasi gambar

    $this->PengumumanModel->save([
      'id_pengumuman' => $id_pengumuman,
      'judul_pengumuman' => $request->getVar('judul'),
      'isi_pengumuman' => $request->getVar('isi'),
      'gambar_pengumuman' => $namaGambar,
      'kode_admin' => session()->get('kode_admin'),
    ]);

    session()->setFlashdata('pesan', 'Data pengumuman berhasil diupdate');
    return redirect()->to('/sekolah/pengumuman');
  }

  public function detailPengumuman($id_pengumuman){
    // cek role yang login
      if (session()->get('kode_user')) {
        $kode_user = session()->get('kode_user');
        $detail_user = $this->UserModel->getDetailUser($kode_user);
        $akun_user = '';

        $detail_admin = '';
        $akun_admin = '';
      } elseif(session()->get('kode_admin')) {
        $kode_admin = session()->get('kode_admin');
        $detail_admin = $this->AdminModel->getDetailAdmin($kode_admin);
        $akun_admin = '';

        $detail_user = '';
        $akun_user = '';
      } else {
        $akun_user = '';
        $akun_admin = ''; 
        $detail_admin = '';
        $detail_user = '';
      }
    // end cek role

    $data = [
      'title' => 'Pengumuman',
      'home' => '',
      'sekolah' => 'active',
        'pengumuman' => 'active',
        'profil_sekolah' => '',
      'karya_tulis' => '',
      'daftar' => '',
      'login' => '',
      'karya_tulis' => '',
      'akun_user' => $akun_user,
        'my_profile' => '',
        'ubah_password' => '',

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
      'detail_pengumuman' => $this->PengumumanModel->getDetailPengumuman($id_pengumuman),
    ];

    return view('admin/detail_pengumuman', $data);
  }

  public function deletePengumuman(){
    $request = \Config\Services::request();

    $id_pengumuman = $request->getVar('id_pengumuman');
    
    $detail_pengumuman = $this->PengumumanModel->getDetailPengumuman($id_pengumuman);

    if ($detail_pengumuman['gambar_pengumuman'] != 'pengumuman.png') {
      unlink('img/pengumuman/'. $detail_pengumuman['gambar_pengumuman']);
    }

    $this->PengumumanModel->delete($id_pengumuman);

    session()->setFlashdata('pesan', 'Pengumuman berhasil dihapus');
    return redirect()->to('/sekolah/pengumuman');
  }
}