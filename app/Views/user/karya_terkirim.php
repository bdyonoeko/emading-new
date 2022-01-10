<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section class="my-background-kuning">
    <div class="container pt-5 mb-5">

      <div class="row justify-content-center">
        <div class="col-md-11">

          <!-- pesan -->
          <div class="row justify-content-center text-center">
            <div class="col-md-11">
              <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-success fade show" role="alert">
                  <?= session()->getFlashdata('pesan'); ?>
                  <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="container">

            <div class="row justify-content-center pt-4 mb-4">
              <img class="my-image-logo shadow-lg rounded-circle p-2 bg-putih" src="<?= base_url('/img/user/profil/'. $detail_user['foto']); ?>" alt="<?= $detail_user['nama_user']; ?>">
            </div>

            <div class="row justify-content-center text-center mb-2">
              <div class="col-md-6">
                <h2 class="fw-bold">
                  <?= $detail_user['nama_user']; ?>
                </h2>
                <p class="card-text">
                  <?= $detail_user['bio']; ?>
                </p>
              </div>
            </div>

            <div class="text-center mb-5">
              <a href="<?= base_url('/user/editProfile/'.$detail_user['kode_user']); ?>" class="text-decoration-none card-text">
                Edit Profile <i class="bi bi-pencil-square text-secondary" title="Edit"></i>
              </a>
            </div>
            
            <div class="mb-3">
              <a href="<?= base_url('/karyatulis/createkaryatulis'); ?>" class="btn btn-secondary">
                Mulai Menulis <i class="bi bi-pencil" title="Edit"></i>
              </a>
            </div>

            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link fontku-4 text-muted <?= $karya_terkonfirmasi; ?>" aria-current="page" href="<?= base_url('/user'); ?>">Terkonfirmasi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fontku-4 text-muted <?= $karya_terkirim; ?>" href="#">Terkirim</a>
              </li>
            </ul>
            
            <!-- Pagination -->
              <?php 
                $koneksi = mysqli_connect("localhost","root","","emading");
                $kode_author = session()->get('kode_user');

                $batas = 5;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
                $previous = $halaman - 1;
                $next = $halaman + 1;

                $data = $daftar_karya_user_terkirim;
                $jumlah_data = count($data);
                $total_halaman = ceil($jumlah_data / $batas);

                $karya_user_terkirim = mysqli_query($koneksi, "
                  select karya_tulis.*, user.kode_user, user.nama_user as nama from karya_tulis
                  join user on karya_tulis.kode_user = user.kode_user
                  where terkonfirmasi=false
                  and karya_tulis.kode_user='".$kode_author."'
                  order by karya_tulis.updated_at desc
                  limit $halaman_awal, $batas
                ");
                $nomor = $halaman_awal + 1;
              ?>
            <!-- Pagination -->

            <?php if($data == null) : ?>
              <div class="row karya mb-3 bg-white shadow justify-content-center p-5">
                <div class="row text-center mb-4">
                  <h4 class="fw-bold">Karya Tulis Terkirim</h4>
                </div>
                <div class="alert alert-warning text-center" role="alert">
                  Belum ada karya tulis yang di kirim ke admin
                </div>
              </div>
            <?php else: ?>
              <div class="row karya mb-3 bg-white shadow justify-content-center p-3 pb-5">
                <div class="row text-center my-4">
                  <h3 class="fw-bold">Karya Tulis Terkirim</h3>
                </div>
                <?php foreach($karya_user_terkirim as $a): ?>
                  <div class="row border mb-3 py-3 shadow-sm justify-content-between">
                    <div class="col-md-4">
                      <img class="my-image-karya img-fluid pt-2 mb-2" src="<?= base_url('img/karya/'.$a['gambar_karya']); ?>" alt="<?= $a['judul_karya']; ?>">
                    </div>
                    <div class="col-md-8 mt-3">
                      <h5 class="card-title"><?= $a['judul_karya']; ?></h5>
                      <p class="card-text"><small class="text-muted"><?= date('j F Y', strtotime($a['updated_at'])) ?></small></p>
                      <p class="card-text">
                        <?= strip_tags(ucfirst(strtolower(substr($a['isi_karya'], 0, 200)))); ?>.... 
                        <a href="<?= base_url('/karyaTulis/detailKaryaTulis/'.$a['id_karya_tulis']); ?>">Baca <i class="bi bi-arrow-right"></i></a>
                      </p>
                      <div class="row">
                        <div class="col-6">
                          <p class="card-text fw-bold"><?= $a['nama']; ?></p>
                        </div>
                        <div class="col-6">
                          <p class="card-text fw-bold">Tag : <?= $a['tag']; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

                <!-- nav Pagination -->
                  <nav class="mt-3">
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
              </div>

            <?php endif; ?>

          </div>

        </div>
      </div>

    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,160L40,149.3C80,139,160,117,240,112C320,107,400,117,480,106.7C560,96,640,64,720,85.3C800,107,880,181,960,224C1040,267,1120,277,1200,266.7C1280,256,1360,224,1400,208L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>