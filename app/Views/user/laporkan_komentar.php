<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section class="detail-karya-tulis my-background-kuning">
    <div class="container pt-5 mb-5">
      <div class="row justify-content-center">
        <div class="col-md-11">

          <?php if (session()->getFlashdata('pesan')) : ?>
          <div class="row justify-content-center text-center">
            <div class="alert alert-success alert-success fade show" role="alert">
              <?= session()->getFlashdata('pesan'); ?>
              <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
          <?php endif; ?>

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/komentar/ruangKomentar/'. $detail_komentar['id_karya_tulis']); ?>">Ruang Komentar</a></li>
              <li class="breadcrumb-item active" aria-current="page">Laporkan Komentar</li>
            </ol>
          </nav>

          <div class="container shadow p-3 mb-5 bg-putih">
            <!-- isi komentar -->
            <div class="row karya mb-3 justify-content-between p-3">
              <div class="col-md-4 p-2">
                  
                <div class="border border-info bg-white shadow-sm p-2">
                  <div class="row">
                    <h4>Laporkan Komentar</h4>
                  </div>
                  <!-- form laporan -->
                  <div class="row">
                    <form action="<?= base_url('/komentar/savePelaporan'); ?>" method="post">
                      <?= csrf_field(); ?>
                      <div class="mb-3">
                        <textarea class="form-control <?= ($validation->hasError('isi_laporan')) ? 'is-invalid' : ''; ?>" id="isi_laporan" name="isi_laporan" rows="3"></textarea>
                        <div class="invalid-feedback" id="isi_laporan">
                          <?= $validation->getError('isi_laporan'); ?>
                        </div>
                      </div>
                      <input type="hidden" name="id_komentar" value="<?= $detail_komentar['id_komentar']; ?>">
                      <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                    </form>
                  </div>
                </div>

              </div>

              <div class="col-md-7 p-2">
                <!-- komentar -->
                  <div class="mb-3 p-2 border bg-white shadow-sm">
                    <div class="row justify-content-between">
                      <div class="col-3 p-3">
                        <img src="<?= base_url('/img/user/profil/'.$detail_komentar['foto']); ?>" alt="<?= $detail_komentar['nama']; ?>" class="my-mini-image rounded-circle p-2 shadow-sm">
                      </div>
                      <div class="col-9 px-3">
                        <div class="card-body">
                          <h5 class="card-title"><?= $detail_komentar['nama']; ?></h5>
                          <p class="card-text"><?= $detail_komentar['isi_komentar']; ?></p>
                          <p class="card-text"><small class="text-muted"><?= date('j F Y', strtotime($detail_komentar['updated_at'])); ?></small></p>
                        </div>
                      </div>
                    </div>
                  </div>

              </div>
              
            </div>
          </div>

        </div>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,224L30,218.7C60,213,120,203,180,176C240,149,300,107,360,101.3C420,96,480,128,540,128C600,128,660,96,720,106.7C780,117,840,171,900,197.3C960,224,1020,224,1080,197.3C1140,171,1200,117,1260,85.3C1320,53,1380,43,1410,37.3L1440,32L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>