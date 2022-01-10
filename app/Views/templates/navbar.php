<!-- user Login -->
<?php if(session()->get('kode_user')): ?>
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top bg-putih">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('home/'); ?>">
        <img class="logo" src="<?= base_url('/img/logo/emading.png'); ?>" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?= $home; ?>" aria-current="page" href="<?= base_url('home/'); ?>">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?= $sekolah; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Sekolah
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?= $pengumuman; ?>" href="<?= base_url('home/pengumuman'); ?>">Pengumuman</a></li>
              <li><a class="dropdown-item <?= $profil_sekolah; ?>" href="<?= base_url('home/profilSekolah'); ?>">Profil Sekolah</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $karya_tulis; ?>" href="<?= base_url('home/karya_tulis'); ?>">Karya Tulis</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?= $akun_user; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $detail_user['nama_user']; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?= $my_profile; ?>" href="<?= base_url('/user'); ?>">My Profile</a></li>
              <li><a class="dropdown-item <?= $ubah_password; ?>" href="<?= base_url('/auth/ubahPassword'); ?>">Ubah Password</a></li>
              <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<!-- end user login -->

<!-- admin Login -->
<?php elseif(session()->get('kode_admin') != null): ?>
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top bg-putih">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('/admin'); ?>">
        <img class="logo" src="<?= base_url('/img/logo/emading.png'); ?>" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?= $home; ?>" aria-current="page" href="<?= base_url('/admin'); ?>">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?= $sekolah; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Sekolah
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?= $pengumuman; ?>" href="<?= base_url('/sekolah/pengumuman'); ?>">Pengumuman</a></li>
              <li><a class="dropdown-item <?= $profil_sekolah; ?>" href="<?= base_url('/sekolah'); ?>">Profil Sekolah</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?= $user; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              User
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?= $user_belum_dikonfirmasi; ?>" href="<?= base_url('/user/userBaru'); ?>">Baru</a></li>
              <li><a class="dropdown-item <?= $user_terkonfirmasi; ?>" href="<?= base_url('/user/userAktif'); ?>">Aktif</a></li>
              <li><a class="dropdown-item <?= $user_banned; ?>" href="<?= base_url('/user/userBanned'); ?>">Banned</a></li>
              <li><a class="dropdown-item <?= $user_alumni; ?>" href="<?= base_url('/user/userAlumni'); ?>">Alumni</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?= $karya_tulis; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Karya Tulis
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?= $karya_tulis_belum_dikonfirmasi; ?>" href="<?= base_url('/karyaTulis/karyaTulisBelumDikonfirmasi'); ?>">Belum Di konfirmasi</a><li>
              <li><a class="dropdown-item <?= $karya_tulis_terkonfirmasi; ?>" href="<?= base_url('/karyaTulis/karyaTulisTerkonfirmasi'); ?>">Terkonfirmasi</a></li>
              <li><a class="dropdown-item <?= $karya_tulis_rekomendasi; ?>" href="<?= base_url('/karyaTulis/karyaTulisRekomendasi'); ?>">Rekomendasi</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?= $pelaporan; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pelaporan
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?= $pelaporan_karya_tulis; ?>" href="<?= base_url('/karyaTulis/PelaporanKaryaTulis'); ?>">Karya Tulis</a></li>
              <li><a class="dropdown-item <?= $pelaporan_komentar; ?>" href="<?= base_url('/komentar/PelaporanKomentar'); ?>">Komentar</a></li>
            </ul>
          </li>
          <?php if($detail_admin['status_admin'] == "Master"): ?>
            <li class="nav-item">
              <a class="nav-link <?= $admin; ?>" aria-current="page" href="<?= base_url('/admin/admin'); ?>">Admin</a>
            </li>
          <?php endif; ?>
          <?php if(session()->get('kode_admin')): ?>
            <li class="nav-item dropdown">
              <a class="nav-link <?= $akun_admin; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $detail_admin['nama_admin']; ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item <?= $ubah_password; ?>" href="<?= base_url('/auth/ubahPassword') ?>">Ubah Password</a></li>
                <li><a class="dropdown-item" href="<?= base_url('/auth/logout'); ?>">Logout</a></li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
<!-- end admin login -->

<!-- tidak Login -->
<?php else: ?>
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top bg-putih">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('home/'); ?>">
        <img class="logo" src="<?= base_url('/img/logo/emading.png'); ?>" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?= $home; ?>" aria-current="page" href="<?= base_url('home/'); ?>">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?= $sekolah; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Sekolah
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?= $pengumuman; ?>" href="<?= base_url('home/pengumuman'); ?>">Pengumuman</a></li>
              <li><a class="dropdown-item <?= $profil_sekolah; ?>" href="<?= base_url('home/profilSekolah'); ?>">Profil Sekolah</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $karya_tulis; ?>" href="<?= base_url('home/karya_tulis'); ?>">Karya Tulis</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $daftar; ?>" href="<?= base_url('auth/registrasi'); ?>">Daftar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $login; ?>" href="<?= base_url('auth'); ?>">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<?php endif; ?>