<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
<section id="my-background">
  <div class="container mb-5">

    <!-- pesan -->
    <div class="row justify-content-center text-center px-3">
      <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-success fade show" role="alert">
          <?= session()->getFlashdata('pesan'); ?>
          <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>

    <div class="row justify-content-between">

      <div class="col-md-12 mb-3">
        <div class="container bg-white shadow rounded p-3">

          <div class="row text-center mb-4">
            <h1 class="mt-5"><?= $detail_profil_sekolah['nama_sekolah']; ?></h1>
          </div>
          
          <div class="container p-1">

            <div class="row justify-content-center">
              <img src="<?= base_url('img/logo/'.$detail_profil_sekolah['logo']); ?>" alt="logo sekolah" class="my-image-logo img-thumbnail">
            </div>

            <div class="row justify-content-center mt-4">
              <div class="col-md-8 card-text">

                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-5 fw-bold">Alamat Sekolah</div>
                    <div class="col-7"><?= $detail_profil_sekolah['alamat']; ?></div>
                  </div>
                  <div class="row justify-content-center mt-2">
                    <div class="col-5 fw-bold">Telepon</div>
                    <div class="col-7"><?= $detail_profil_sekolah['telepon']; ?></div>
                  </div>
                  <div class="row justify-content-center mt-2">
                    <div class="col-5 fw-bold">Email</div>
                    <div class="col-7"><?= $detail_profil_sekolah['email_sekolah']; ?></div>
                  </div>
                </div>

              </div>
            </div>

            <div class="row justify-content-center mt-5">
              <div class="col-md-8">
                <div class="container">
                  <div class="row text-center">
                    <h3 class="card-title">VISI</h3>
                  </div>
                  <div class="text-center">
                    <p class="card-text">
                      <?= $detail_profil_sekolah['visi']; ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-center mt-4">
              <div class="col-md-8">
                <div class="container">
                  <div class="row text-center">
                    <h3 class="card-title">MISI</h3>
                  </div>
                  <p class="card-text">
                    <?= $detail_profil_sekolah['misi']; ?>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="container">
              <div class="row justify-content-center mt-4 mb-5">
                <div class="col-md-8">
                  <p class="card-text"><b>Admin : <?= $detail_profil_sekolah['nama']; ?></b></p>
                </div>
                <div class="col-md-8 mt-1">
                  <p class="text-muted">
                    <small>
                      Update : <?= date('j F Y', strtotime($detail_profil_sekolah['updated_at'])) ?>
                    </small>
                  </p>
                </div>
              </div>
            </div>

          </div>
        
        </div>
      </div>

    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,128L34.3,117.3C68.6,107,137,85,206,74.7C274.3,64,343,64,411,85.3C480,107,549,149,617,170.7C685.7,192,754,192,823,170.7C891.4,149,960,107,1029,128C1097.1,149,1166,235,1234,266.7C1302.9,299,1371,277,1406,266.7L1440,256L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
</section>

<?= $this->endSection(); ?>