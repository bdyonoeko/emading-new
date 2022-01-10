<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <!-- hero section -->
  <section id="hero">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-6">
          <div class="container">
            <div class="row mx-auto">
              <div class="col-md-9">
                <p class="slogan">Siapapun yang terhibur dengan <br> buku-buku, kebahagiaan tak akan sirna dari dirinya.</p>
                <p class="slogan-quotes">- Ali bin Abi Thalib -</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <img class="container-fluid" src="<?= base_url('img/logo/hero.jpg'); ?>" alt="">
        </div>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
  </section>
  <!-- end hero section -->

  <!-- pengumuman -->
  <section id="pengumuman" class="bg-kuning">
    <div class="container">
      <div class="row text-center mb-4">
        <h3 class="fw-bold">Pengumuman</h3>
      </div>
      <div class="row justify-content-center">

        <?php if($daftar_pengumuman == null): ?>
          <div class="container p-2">
            <div class="alert alert-light shadow border text-center" role="alert">
              Belum ada pengumuman yang dibuat
            </div>
          </div>
        <?php else: ?>
          <?php foreach($daftar_pengumuman as $a): ?>
            <!-- card pengumuman -->
            <div class="col-md-4 mb-3">
              <div class="card shadow">
                <img src="<?= base_url('img/pengumuman/'. $a['gambar_pengumuman']); ?>" class="card-img-top p-2 my-image" alt="<?= $a['judul_pengumuman']; ?>">
                <div class="card-body">
                  <h5 class="card-title">
                    <?= $a['judul_pengumuman']; ?>
                  </h5>
                  <p class="card-text">
                    <?= strip_tags(ucfirst(strtolower(substr($a['isi_pengumuman'], 0, 200)))); ?>.... 
                    <a href="<?= base_url('/sekolah/detailPengumuman/'.$a['id_pengumuman']); ?>">Baca <i class="bi bi-arrow-right"></i></a>
                  </p>
                </div>
                <div class="card-footer">
                  <div class="row justify-content-beetween py-auto">
                    <div class="col">
                      <p class="card-text">
                        <small class="text-muted">
                          <?= date('j F Y', strtotime($a['updated_at'])); ?>
                        </small>
                      </p>
                    </div>
                    <div class="col">
                      <p class="card-text text-end">
                        <?= $a['nama']; ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card pengumuman -->
          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,160L48,160C96,160,192,160,288,154.7C384,149,480,139,576,117.3C672,96,768,64,864,90.7C960,117,1056,203,1152,213.3C1248,224,1344,160,1392,128L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
  </section>
  <!-- end pengumuman -->

  <!-- penulis -->
  <section id="penulis">
    <div class="container">
      <div class="row text-center mb-4">
        <h3 class="fw-bold">Penulis Teraktif</h3>
      </div>
      <div class="row justify-content-center">

        <!-- card penulis -->
        <?php if($daftar_karya_rekomendasi == null): ?>
          <div class="containter p-2">
            <div class="alert alert-warning shadow border text-center" role="alert">
              Belum ada penulis yang berkarya
            </div>
          </div>
        <?php else: ?>
          <?php $no = 1; ?>
          <?php foreach($daftar_penulis_teraktif as $a): ?>
            <div class="col-md-4 mb-3">
              <div class="row justify-content-center">
                <div class="col-8">
                  <div class="row justify-content-center mb-3">
                    <img class="my-image shadow rounded-circle p-2 img-thumbnail img-fluid" src="<?= base_url('/img/user/profil/'.$a['foto']); ?>" alt="<?= $a['nama']; ?>">
                  </div>
                  <div class="row text-center">
                    <h4><?= $no++; ?></h4>
                  </div>
                  <div class="row text-center">
                    <p class="fontku-1">
                      <a href="<?= base_url('/user/profileAuthor/'.$a['kode_user']); ?>" class="text-biru text-decoration-none">
                        <?= $a['nama']; ?>
                      </a>
                    </p>
                    <small>
                      <p class="text-muted">Total Karya : <?= $a['total_karya']; ?></p>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
        <!-- end card penulis -->

      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,256L48,250.7C96,245,192,235,288,192C384,149,480,75,576,58.7C672,43,768,85,864,101.3C960,117,1056,107,1152,117.3C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
  </section>
  <!-- end penulis -->

  <!-- rekomendasi -->
  <section id="rekomendasi" class="bg-kuning">
    <div class="container">
      <div class="row text-center mb-4">
        <h3 class="fw-bold">Rekomendasi Admin</h3>
      </div>
      <div class="row justify-content-center mb-5">
        
        <!-- card rekomendasi -->
        <?php if($daftar_karya_rekomendasi == null): ?>
          <div class="containter p-2">
            <div class="alert alert-light border shadow text-center" role="alert">
              Belum ada karya yang direkomendasikan admin
            </div>
          </div>
        <?php else: ?>
          <?php foreach($daftar_karya_rekomendasi as $a): ?>
            <!-- card karya -->
            <div class="col-md-4 mb-3">
              <div class="card shadow">
                <img src="<?= base_url('img/karya/'. $a['gambar_karya']); ?>" class="card-img-top p-2 my-image" alt="<?= $a['judul_karya']; ?>">
                <div class="card-body">
                  <h5 class="card-title">
                    <?= $a['judul_karya']; ?>
                  </h5>
                  <p class="card-text">
                    <?= strip_tags(ucfirst(strtolower(substr($a['isi_karya'], 0, 200)))); ?>.... 
                    <a href="<?= base_url('/karyaTulis/detailKaryaTulis/'.$a['id_karya_tulis']); ?>">Baca <i class="bi bi-arrow-right"></i></a>
                  </p>
                </div>
                <div class="card-footer">
                  <div class="row justify-content-beetween py-auto">
                    <div class="col">
                      <p class="card-text">
                        <small class="text-muted">
                          <?= date('j F Y', strtotime($a['updated_at'])); ?>
                        </small>
                      </p>
                    </div>
                    <div class="col">
                      <p class="card-text text-end">
                        <?= $a['nama_user']; ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card karya -->
          <?php endforeach; ?>
        <?php endif; ?>
        <!-- end card rekomendasi --> 

      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,160L48,149.3C96,139,192,117,288,122.7C384,128,480,160,576,149.3C672,139,768,85,864,58.7C960,32,1056,32,1152,37.3C1248,43,1344,53,1392,58.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
  </section>
  <!-- end rekomendasi -->

<?= $this->endSection(); ?>