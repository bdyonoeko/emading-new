<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section class="detail-karya-tulis">
    <div class="container pb-5 pt-5">
      <div class="row justify-content-center">
        <div class="col-md-7">

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
              <li class="breadcrumb-item"><a href="javascript:history.back()"><i class="bi bi-arrow-left"></i> Kembali</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail Pelaporan Komentar</li>
            </ol>
          </nav>

          <div class="container justify-content-center shadow bg-white p-3">

              <div class="col-md p-2">
                <!-- komentar -->
                  <div class="mb-3 p-2">
                    <div class="row">
                      <div class="col-3">
                        <img src="<?= base_url('/img/user/profil/'.$detail_pelaporan['foto']); ?>" alt="<?= $detail_pelaporan['nama']; ?>" class="my-mini-image rounded-circle p-2 shadow-sm">
                      </div>
                      <div class="col-7">
                        <div class="card-body">
                          <h5 class="card-title"><?= $detail_pelaporan['nama']; ?></h5>
                          <p class="card-text"><?= $detail_pelaporan['isi_komentar']; ?></p>
                          <p class="card-text"><small class="text-muted"><?= date('j F Y', strtotime($detail_pelaporan['updated_at'])); ?></small></p>
                        </div>
                      </div>
                      <div class="col-1">

                        <ul class="fontku-4 navbar-nav">
                          <li class="nav-item dropdown">
                            <a class="text-biru fw-bold nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bi bi-three-dots"></i>
                            </a>
                            <!-- laporkan -->
                            <ul class="dropdown-menu fontku-4" aria-labelledby="navbarDropdown">
                              <div class="row text-center justify-content-center">
                                
                                <li><a class="text-biru dropdown-item" href="<?= base_url('/user/detailUser/'.$detail_pelaporan['kode_terlapor']); ?>">Detail User</a></li>
                                <li><a class="text-biru dropdown-item" href="<?= base_url('/karyaTulis/detailKaryaTulis/'.$detail_pelaporan['id_karya_tulis']); ?>">Detail Karya</a></li>
                                <li>
                                  <form class="text-biru dropdown-item" action="<?= base_url('/komentar/deleteKomentar'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id_komentar" value="<?= $detail_pelaporan['id_komentar']; ?>">
                                    <input type="hidden" name="id_karya_tulis" value="<?= $detail_pelaporan['id_karya_tulis']; ?>">
                                    <button type="submit" class="btn btn-white btn-sm text-biru" onclick="return confirm('Hapus komentar ini?')">
                                      Delete
                                    </button>
                                  </form>
                                </li>
                                
                              </div>
                            </ul>
                          </li>
                        </ul>

                      </div>
                    </div>
                  </div>

              </div>
              
            </div>
          </div>

        </div>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,160L34.3,176C68.6,192,137,224,206,229.3C274.3,235,343,213,411,186.7C480,160,549,128,617,112C685.7,96,754,96,823,128C891.4,160,960,224,1029,245.3C1097.1,267,1166,245,1234,234.7C1302.9,224,1371,224,1406,224L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>