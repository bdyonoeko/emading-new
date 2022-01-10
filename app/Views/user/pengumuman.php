<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="my-background">
    <div class="container mb-5">

      <div class="row justify-content-center">

        <!-- Pagination -->
          <?php 
            $koneksi = mysqli_connect("localhost","root","","emading");

            $batas = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
            $previous = $halaman - 1;
            $next = $halaman + 1;

            $data = $daftar_pengumuman;
            $jumlah_data = count($data);
            $total_halaman = ceil($jumlah_data / $batas);

            $pengumuman = mysqli_query($koneksi, "
              select pengumuman.*, admin.kode_admin, admin.nama_admin as nama from pengumuman
              join admin on admin.kode_admin = pengumuman.kode_admin
              order by pengumuman.updated_at desc
              limit $halaman_awal, $batas
            ");
            $nomor = $halaman_awal + 1;
          ?>
        <!-- Pagination -->
      
        <?php if($pengumuman == null): ?>
          <div class="containter my-5 p-2">
            <div class="alert alert-light shadow border text-center" role="alert">
              Belum ada pengumuman yang dibuat
            </div>
          </div>
        <?php else: ?>
          <?php foreach($pengumuman as $a): ?>
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

          <!-- nav Pagination -->
            <nav class="mb-5 mt-3">
              <ul class="pagination justify-content-center">
                
                <!-- previous -->
                <?php if($halaman == 1): ?>
                  <li class="page-item disabled">
                    <a href="#" class="page-link">First</a>
                  </li>
                  <li class="page-item disabled">
                    <a href="#" class="page-link">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php else: ?>
                  <li class="page-item">
                    <a href="?halaman=1" class="page-link">First</a>
                  </li>
                  <li class="page-item">
                    <?php $link_prev = ($halaman > 1) ? $halaman - 1 : 1 ?>
                    <a href="?halaman=<?= $link_prev; ?>" class="page-link" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif; ?>

                <!-- page -->
                <?php 
                  $jumlah_number = 1;
                  $start_number = ($halaman > $jumlah_number) ? $halaman - $jumlah_number : 1;
                  $end_number = ($halaman < ($total_halaman - $jumlah_number)) ? $halaman + $jumlah_number : $total_halaman;
                  
                  for($i = $start_number; $i <= $end_number; $i++) :
                    $link_active = ($halaman == $i) ? 'active' : '';
                ?>
                  <li class="page-item <?= $link_active ?>">
                    <a href="?halaman=<?= $i ?>" class="page-link"><?= $i; ?></a>
                  </li>  
                <?php endfor; ?>

                <!-- next -->
                <?php if($halaman == $total_halaman): ?>
                  <li class="page-item disabled">
                    <a href="#" class="page-link">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                  <li class="page-item disabled">
                    <a href="#" class="page-link">Last</a>
                  </li>
                <?php else: ?>
                  <?php $link_next = ($halaman < $total_halaman) ? $halaman + 1 : $total_halaman ?>
                  <li class="page-item">
                    <a href="?halaman=<?= $link_next; ?>" class="page-link" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                  <li class="page-item">
                    <a href="?halaman=<?= $total_halaman; ?>" class="page-link">Last</a>
                  </li>
                <?php endif; ?>

              </ul>
            </nav>
          <!-- nav Pagination -->

        <?php endif; ?>

      </div>

    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,128L48,149.3C96,171,192,213,288,218.7C384,224,480,192,576,192C672,192,768,224,864,218.7C960,213,1056,171,1152,165.3C1248,160,1344,192,1392,208L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>