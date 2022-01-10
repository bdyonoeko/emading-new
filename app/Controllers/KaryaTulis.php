<?php

namespace App\Controllers;

use App\Models\KaryaTulisModel;
use App\Models\PelaporanModel;
use App\Models\SekolahModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\KomentarModel;

class KaryaTulis extends BaseController
{
  public function __construct()
  {
    $this->KaryaTulisModel = new KaryaTulisModel();
    $this->AdminModel = new AdminModel();
    $this->UserModel = new UserModel();
    $this->SekolahModel = new SekolahModel();
    $this->PelaporanModel = new PelaporanModel();
    $this->KomentarModel = new KomentarModel();
  }
  
  public function createKaryaTulis()
  {
    $kode_user = session()->get('kode_user');

		$data = [
			'title' => "Menulis",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'karya_tulis' => '',
			'daftar' => '',
			'login' => '',
			'akun_user' => 'active',
				'my_profile' => 'active',
				'ubah_password' => '',

			'detail_user' => $this->UserModel->getDetailUser($kode_user),
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),

      'validation' => \Config\Services::validation(),
		];

		return view('user/create_karya_tulis',$data);
  }

  public function saveKaryaTulis(){
    $request = \Config\Services::request();
    $kode_user = session()->get('kode_user');

    // validasi
      $validation = $this->validate([
        'judul' => [
          'rules' => 'required|max_length[100]',
          'errors' => [
            'required' => 'Judul tidak boleh kosong',
            'max_length' => 'Judul terlalu panjang',
          ]
        ],
        'isi' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Isi tidak boleh kosong',
          ]
        ],
        'tag' => [
          'rules' => 'max_length[30]',
          'errors' => [
            'max_length' => 'Tag terlalu panjang',
          ]
        ],
        'gambar' => [
          'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/png,image/jpeg]',
          'errors' => [
            'max_size' => 'Gambar tidak boleh lebih dari 2Mb',
            'is_image' => 'Upload gambar dengan ext .jpg/.png/.jpeg',
            'mime_in' => 'Upload gambar dengan ext .jpg/.png/.jpeg',
          ]
        ],
      ]);

      if (!$validation) {
        return redirect()->to('/karyaTulis/createKaryaTulis')->withInput();
      }
    // end validasi

    else {
      // konfigurasi gambar
        $fileGambar = $request->getFile('gambar');
    
        if ($fileGambar->getError() == 4) {
          $namaGambar = 'karya.png';
        } else {
          $namaGambar = $fileGambar->getRandomName();
          $fileGambar->move('img/karya/', $namaGambar);
        }
      // end konfigurasi gambar

      // save data
        $this->KaryaTulisModel->insert([
          'judul_karya' => $request->getVar('judul'),
          'isi_karya' => $request->getVar('isi'),
          'tag' => $request->getVar('tag'),
          'gambar_karya' => $namaGambar,
          'kode_user' => $kode_user,
          'kode_admin' => "ADM01",
          'direkomendasikan' => false,
          'terkonfirmasi' => false,
        ]);
      // end save data

      session()->setFlashdata('pesan', 'Karya tulis anda telah ditampung. Harap menunggu konfirmasi admin');
      return redirect()->to('/user');
    }
  }

  public function detailKaryaTulis($id_karya_tulis)
  {
    if (session()->get('kode_user')) {
      $kode_user = session()->get('kode_user');
      $kode_admin = '';
    } 
    elseif (session()->get('kode_admin')){
      $kode_admin = session()->get('kode_admin');
      $kode_user = '';
    }
    else {
      $kode_user = '';
      $kode_admin = '';
    }

		$data = [
			'title' => "Detail Karya Tulis",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'daftar' => '',
			'login' => '',
			'akun_user' => '',
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
			'akun_admin' => '',
				'ubah_password' => '',

			'detail_user' => $this->UserModel->getDetailUser($kode_user),
			'detail_karya_tulis' => $this->KaryaTulisModel->getDetailKaryaTulis($id_karya_tulis),
			'detail_profil_sekolah' => $this->SekolahModel->getDetailProfilSekolah(),
      'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
      'daftar_komentar_dalam_karya_tulis' => $this->KomentarModel->getDaftarKomentarDalamKaryaTulis($id_karya_tulis),
      'validation' => \Config\Services::validation(),
		];

    if ($this->KaryaTulisModel->getDetailKaryaTulis($id_karya_tulis) == null) {
      return redirect()->to('/home');
    }

		return view('user/detail_karya_tulis',$data);
  }

  public function deleteKaryaTulis(){
    $request = \Config\Services::request();

    $id_karya_tulis = $request->getVar('id_karya_tulis');
    
    $detail_karya_tulis = $this->KaryaTulisModel->getDetailKaryaTulis($id_karya_tulis);

    if ($detail_karya_tulis['gambar_karya'] != 'karya.png') {
      unlink('img/karya/'. $detail_karya_tulis['gambar_karya']);
    }

    $this->KaryaTulisModel->delete($id_karya_tulis);

    if (session()->get('kode_admin')) {
      $halaman = $request->getVar('halaman');

      session()->setFlashdata('pesan', 'Karya tulis berhasil dihapus');
      return redirect()->to('/karyaTulis/'.$halaman);
    }

    session()->setFlashdata('pesan', 'Karya tulis berhasil dihapus');
    return redirect()->to('/user');
  }

  public function editKaryaTulis($id_karya_tulis){
    $kode_user = session()->get('kode_user');

		$data = [
			'title' => "Karya Tulis",
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

      'validation' => \Config\Services::validation(),
		];

		return view('user/edit_karya_tulis',$data);
  }

  public function saveEditRekomendasi(){
    $request = \Config\Services::request();

    if (session()->get('kode_admin')) {
      $halaman = $request->getVar('halaman');

      if ($halaman == "KaryaTulisRekomendasi") {
        $data = [
          'id_karya_tulis' => $request->getVar('id_karya_tulis'),
          'kode_admin' => session()->get('kode_admin'),
          'terkonfirmasi' => true,
          'direkomendasikan' => true,
        ];
  
        $this->KaryaTulisModel->saveKonfirmasiKaryaTulis($data);

        session()->setFlashdata('pesan', 'Karya tulis berhasil direkomendasikan');
        return redirect()->to('/karyaTulis/'. $halaman);
      } else {
        $data = [
          'id_karya_tulis' => $request->getVar('id_karya_tulis'),
          'kode_admin' => session()->get('kode_admin'),
          'terkonfirmasi' => true,
          'direkomendasikan' => false,
        ];
  
        $this->KaryaTulisModel->saveKonfirmasiKaryaTulis($data);

        session()->setFlashdata('pesan', 'Karya tulis dihapus dari karya rekomendasi');
        return redirect()->to('/karyaTulis/'. $halaman);
      }
    }
  }

  public function saveEditKaryaTulis(){
    $request = \Config\Services::request();

    if (session()->get('kode_admin')) {
      $halaman = $request->getVar('halaman');

      $data = [
        'id_karya_tulis' => $request->getVar('id_karya_tulis'),
        'kode_admin' => session()->get('kode_admin'),
        'terkonfirmasi' => true,
      ];

      $this->KaryaTulisModel->saveKonfirmasiKaryaTulis($data);

      session()->setFlashdata('pesan', 'Karya tulis berhasil dikonfirmasi');
      return redirect()->to('/karyaTulis/'. $halaman);
    }

    $kode_user = session()->get('kode_user');
    $id_karya_tulis = $request->getVar('id_karya_tulis');

    // validasi
      $validation = $this->validate([
        'judul' => [
          'rules' => 'required|max_length[100]',
          'errors' => [
            'required' => 'Judul tidak boleh kosong',
            'max_length' => 'Judul terlalu panjang',
          ]
        ],
        'isi' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Isi tidak boleh kosong',
          ]
        ],
        'tag' => [
          'rules' => 'max_length[30]',
          'errors' => [
            'max_length' => 'Tag terlalu panjang',
          ]
        ],
        'gambar' => [
          'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/png,image/jpeg]',
          'errors' => [
            'max_size' => 'Gambar tidak boleh lebih dari 2Mb',
            'is_image' => 'Upload gambar dengan ext .jpg/.png/.jpeg',
            'mime_in' => 'Upload gambar dengan ext .jpg/.png/.jpeg',
          ]
        ],
      ]);

      if (!$validation) {
        return redirect()->to('/karyaTulis/editKaryaTulis/'. $id_karya_tulis)->withInput();
      }
    // end validasi

    else {
      // konfigurasi gambar
        $fileGambar = $request->getFile('gambar');
        $gambarLama = $request->getvar('gambar_lama');

        if ($fileGambar->getError() == 4) {
          $namaGambar = $gambarLama;
        } else {
          $namaGambar = $fileGambar->getRandomName();
          $fileGambar->move('img/karya/', $namaGambar);

          if ($gambarLama != 'karya.png') {
            unlink('img/karya/'. $gambarLama);
          }
        }
      // end konfigurasi gambar

      // save data
        $this->KaryaTulisModel->save([
          'id_karya_tulis' => $id_karya_tulis,
          'judul_karya' => $request->getVar('judul'),
          'isi_karya' => $request->getVar('isi'),
          'tag' => $request->getVar('tag'),
          'gambar_karya' => $namaGambar,
          'kode_user' => $kode_user,
          'direkomendasikan' => false,
          'terkonfirmasi' => false,
        ]);
      // end save data

      session()->setFlashdata('pesan', 'Perubahan karya tulis telah ditampung. Harap menunggu konfirmasi admin');
      return redirect()->to('/user');
    }
  }

  public function savePelaporan(){
    $request = \Config\Services::request();

    $id_karya_tulis = $request->getVar('id_karya_tulis');

    $validation = $this->validate([
      'isi_laporan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi laporan tidak boleh kosong'
        ]
      ]
    ]);

    if (!$validation) {
      return redirect()->to('/karyaTulis/detailKaryaTulis/'. $id_karya_tulis)->withInput();
    }

    $data = [
      'isi_laporan' => $request->getVar('isi_laporan'),
      'kode_user' => session()->get('kode_user'),
      'id_karya_tulis' => $id_karya_tulis,
    ];

    $this->PelaporanModel->insert($data);
    session()->setFlashdata('pesan', 'Laporan telah dikirim');
    return redirect()->to('/karyaTulis/detailKaryaTulis/'. $id_karya_tulis);
  }

  public function pelaporanKaryaTulis(){
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
        'pelaporan_karya_tulis' => 'active',
        'pelaporan_komentar' => '',
			'admin' => '',
			'akun_admin' => '',
				'ubah_password' => '',
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
      'daftar_pelaporan_karya_tulis' => $this->PelaporanModel->getDaftarPelaporan(),
		];

		return view('admin/pelaporan_karya_tulis',$data);
  }

  public function deletePelaporanKaryaTulis(){
    $request = \Config\Services::request();

    $id_laporan = $request->getVar('id_laporan');

    $this->PelaporanModel->delete($id_laporan);

    session()->setFlashdata('pesan', 'Laporan berhasil dihapus');
    return redirect()->to('/karyaTulis/pelaporanKaryaTulis');
  }

  public function karyaTulisBelumDikonfirmasi(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Karya Tulis",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => '',
        'user_terkonfirmasi' => '',
        'user_belum_dikonfirmasi' => '',
        'user_banned' => '',
        'user_alumni' => '',
			'karya_tulis' => 'active',
        'karya_tulis_terkonfirmasi' => '',
        'karya_tulis_belum_dikonfirmasi' => 'active',
        'karya_tulis_rekomendasi' => '',
			'pelaporan' => '',
        'pelaporan_karya_tulis' => '',
        'pelaporan_komentar' => '',
			'admin' => '',
			'akun_admin' => '',
				'ubah_password' => '',
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
			'daftar_karya_tulis_belum_dikonfirmasi' => $this->KaryaTulisModel->getDaftarKaryaTulis(false),
		];

		return view('admin/karya_tulis_belum_dikonfirmasi',$data);
  }

  public function karyaTulisTerkonfirmasi(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Karya Tulis",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => '',
        'user_terkonfirmasi' => '',
        'user_belum_dikonfirmasi' => '',
        'user_banned' => '',
        'user_alumni' => '',
			'karya_tulis' => 'active',
        'karya_tulis_terkonfirmasi' => 'active',
        'karya_tulis_belum_dikonfirmasi' => '',
        'karya_tulis_rekomendasi' => '',
			'pelaporan' => '',
        'pelaporan_karya_tulis' => '',
        'pelaporan_komentar' => '',
			'admin' => '',
			'akun_admin' => '',
				'ubah_password' => '',
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
			'daftar_karya_tulis_terkonfirmasi' => $this->KaryaTulisModel->getDaftarKaryaTulis(true),
		];

		return view('admin/karya_tulis_terkonfirmasi',$data);
  }

  public function karyaTulisRekomendasi(){
    $kode_admin = session()->get('kode_admin');

    $data = [
			'title' => "Karya Tulis",
			'home' => '',
			'sekolah' => '',
				'pengumuman' => '',
				'profil_sekolah' => '',
			'user' => '',
        'user_terkonfirmasi' => '',
        'user_belum_dikonfirmasi' => '',
        'user_banned' => '',
        'user_alumni' => '',
			'karya_tulis' => 'active',
        'karya_tulis_terkonfirmasi' => '',
        'karya_tulis_belum_dikonfirmasi' => '',
        'karya_tulis_rekomendasi' => 'active',
			'pelaporan' => '',
        'pelaporan_karya_tulis' => '',
        'pelaporan_komentar' => '',
			'admin' => '',
			'akun_admin' => '',
				'ubah_password' => '',
			'detail_admin' => $this->AdminModel->getDetailAdmin($kode_admin),
			'daftar_karya_tulis_rekomendasi' => $this->KaryaTulisModel->getDaftarKaryaTulisRekomendasi(true),
		];

		return view('admin/karya_tulis_rekomendasi',$data);
  }
}