<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
<section class="">

  <div class="container p-4">
  
    <!-- pesan -->
    <div class="row justify-content-center text-center px-3">
      <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-success fade show" role="alert">
          <?= session()->getFlashdata('pesan'); ?>
          <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php elseif(session()->getFlashdata('pesan_danger')): ?>
        <div class="alert alert-danger alert-success fade show" role="alert">
          <?= session()->getFlashdata('pesan_danger'); ?>
          <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>

    <div class="row justify-content-between py-3">

      <div class="mb-3 col-md-3">
        <div class="container notifku border-primary shadow rounded p-1">
          <div class="card-body text-primary">
            <h5 class="card-title">Total User Belum Dikonfirmasi</h5>
            <p class="card-text" style="font-size: 50px;"><?= count($total_user); ?></p>
            <a class="text-decoration-none" href="<?= base_url('/user/UserBaru'); ?>">
              <p class="card-text">Detail >>></p>
            </a>
          </div>
        </div>
      </div>
      <div class="mb-3 col-md-3">
        <div class="container notifku border-primary shadow rounded p-1">
          <div class="card-body text-warning">
            <h5 class="card-title">Total Karya Belum Dikonfirmasi</h5>
            <p class="card-text" style="font-size: 50px;"><?= count($total_karya); ?></p>
            <a class="text-decoration-none" href="<?= base_url('/karyaTulis/KaryaTulisBelumDikonfirmasi'); ?>">
              <p class="card-text">Detail >>></p>
            </a>
          </div>
        </div>
      </div>
      <div class="mb-3 col-md-3">
        <div class="container notifku border-primary shadow rounded p-1">
          <div class="card-body text-info">
            <h5 class="card-title">Total Pelaporan Karya Tulis</h5>
            <p class="card-text" style="font-size: 50px;"><?= count($daftar_pelaporan); ?></p>
            <a class="text-decoration-none" href="<?= base_url('/karyaTulis/pelaporanKaryaTulis'); ?>">
              <p class="card-text mt-auto">Detail >>></p>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="container notifku border-primary shadow rounded p-1">
          <div class="card-body text-success">
            <h5 class="card-title">Total Pelaporan Komentar</h5>
            <p class="card-text" style="font-size: 50px;"><?= count($daftar_pelaporan_komentar); ?></p>
            <a class="text-decoration-none" href="<?= base_url('/komentar/pelaporanKomentar'); ?>">
              <p class="card-text">Detail >>></p>
            </a>
          </div>
        </div>
      </div>

    </div>

    <div class="row justify-content-between">
      <div class="col-md-6 mb-3">
        <div class="p-3 shadow">
          <div class="row">

            <h3 class="text-danger text-center">User Terbaru</h3>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Konfirmasi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach($daftar_user as $a): ?>
                    <tr>
                      <th scope="row"><?= $no++; ?></th>
                      <td><a href="<?= base_url('/user/detailUser/'.$a['kode_user']); ?>" class="text-decoration-none"><?= $a['nama_user']; ?></a></td>
                      <td>
                        <div class="row">
                          <div class="col-2">
                            <form action="<?= base_url('user/saveEditUser'); ?>" method="post">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="kode_user" value="<?= $a['kode_user']; ?>">
                              <input type="hidden" name="status" value="Aktif">
                              <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Konfirmasi user ini?')">
                                <i class="bi bi-check-lg text-success" title="Konfirmasi"></i>
                              </button>
                            </form>
                          </div>
                          <div class="col-2">
                            <form action="<?= base_url('user/deleteUser'); ?>" method="post">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="kode_user" value="<?= $a['kode_user']; ?>">
                              <input type="hidden" name="halaman" value="userBaru">
                              <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Hapus user ini?')">
                                <i class="bi bi-trash-fill text-danger" title="Delete"></i>
                              </button>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              
              <?php if($daftar_user == null): ?>
                <tr>
                  <td>
                    <div class="alert alert-warning text-center" role="alert">
                      Tidak ada user yang belum dikonfirmasi
                    </div>
                  </td>
                </tr>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="p-3 shadow">
          <div class="row">
            <h3 class="text-secondary text-center">Karya Tulis Terbaru</h3>
            <div class="table-responsive">
              <table class="table table-hover datatables">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Konfirmasi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach($daftar_karya as $a): ?>
                    <tr>
                      <th scope="row"><?= $no++; ?></th>
                      <td>
                        <a href="<?= base_url('/karyaTulis/detailKaryaTulis/'.$a['id_karya_tulis']); ?>" class="text-decoration-none">
                          <?= $a['judul_karya']; ?>
                        </a>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-2">
                            <form action="<?= base_url('karyaTulis/saveEditKaryaTulis'); ?>" method="post">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="id_karya_tulis" value="<?= $a['id_karya_tulis']; ?>">
                              <input type="hidden" name="nama" value="<?= $detail_admin['nama_admin']; ?>">
                              <input type="hidden" name="halaman" value="KaryaTulisTerkonfirmasi">
                              <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Konfirmasi karya tulis ini?')">
                                <i class="bi bi-check-lg text-success" title="Konfirmasi"></i>
                              </button>
                            </form>     
                          </div>

                          <div class="col-2">
                            <form action="<?= base_url('karyaTulis/deleteKaryaTulis'); ?>" method="post">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="id_karya_tulis" value="<?= $a['id_karya_tulis']; ?>">
                              <input type="hidden" name="halaman" value="KaryaTulisBelumDikonfirmasi">
                              <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Hapus karya tulis ini?')">
                                <i class="bi bi-trash-fill text-danger" title="Delete"></i>
                              </button>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

              
              <?php if($daftar_karya == null): ?>
                <tr>
                  <td>
                    <div class="alert alert-warning text-center" role="alert">
                      Tidak ada karya yang belum dikonfirmasi
                    </div>
                  </td>
                </tr>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,170.7C384,149,480,107,576,90.7C672,75,768,85,864,117.3C960,149,1056,203,1152,224C1248,245,1344,235,1392,229.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>
<?= $this->endSection(); ?>