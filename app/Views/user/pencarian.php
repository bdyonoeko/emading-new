<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="my-background">
    <div class="container mb-5">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">

              <form action="<?= base_url('/home/search'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row justify-content-center">
                  <div class="col-md-4 mb-3">
                    <select class="form-select" aria-label="Default select example" name="kategori">
                      <option value="<?= $kategori; ?>"><?= $kategori; ?></option>
                      <option value="Karya">Karya</option>
                      <option value="User">User</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Search..." value="<?= $keyword; ?>">
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary mb-3">Cari</button>
                  </div>
                </div>
              </form>

          </div>
        </div>
      </div>

      <!-- Pagination -->
        <?php 
          $koneksi = mysqli_connect("localhost","root","","emading");

          $batas = 5;
          $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
          $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
          $previous = $halaman - 1;
          $next = $halaman + 1;

          $data = $data_search;
          $jumlah_data = count($data);
          $total_halaman = ceil($jumlah_data / $batas);

          if ($kategori == "Karya") {
            $search = mysqli_query($koneksi, "
              select karya_tulis.*, user.kode_user, user.nama_user as nama from karya_tulis
              join user on karya_tulis.kode_user = user.kode_user
              where terkonfirmasi=true and 
              (
                judul_karya like '%$keyword%' or 
                tag like '%$keyword%' or 
                nama_user like '%$keyword%'
              )
              order by karya_tulis.updated_at desc
              limit $halaman_awal, $batas
            ");
          } else {
            $nonaktif = "Non-aktif";

            $search = mysqli_query($koneksi, "
              select * from user
              where status !='".$nonaktif."' 
              and nama_user like '%$keyword%'
              order by nama_user
              limit $halaman_awal, $batas
            ");
          }

          $nomor = $halaman_awal + 1;
        ?>
      <!-- Pagination -->

      <?php if($data_search == null): ?>
        <div class="containter mt-5 p-2 my-5">
          <div class="alert alert-light border shadow text-center" role="alert">
            Tidak ditemukan data yang sesuai
          </div>
        </div>
      <?php else: ?>
        <?php if($kategori == "User"): ?>
          <?php foreach($search as $a): ?>

            <div class="row justify-content-center">
              <div class="col-md-3 mb-3 mt-5">
                <div class="row justify-content-center">
                  <div class="col-8">
                    <div class="row justify-content-center mb-3">
                      <img class="my-image-cari shadow rounded-circle p-2 img-thumbnail img-fluid" src="<?= base_url('/img/user/profil/'.$a['foto']); ?>" alt="<?= $a['nama_user']; ?>">
                    </div>
                    <div class="row justify-content-center text-center">
                      <p class="fontku-1">
                        <a href="<?= base_url('/user/profileAuthor/'.$a['kode_user']); ?>" class="text-biru text-decoration-none">
                          <?= $a['nama_user']; ?>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <?php endforeach; ?>

          <!-- nav Pagination -->
            <nav class="mb-5">
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
        <?php else: ?>
          <?php foreach($search as $a): ?>
            <div class="container shadow bg-putih mb-3">
              <div class="row karya mb-3">
                <div class="col-md-4">
                  <img class="my-image-karya img-fluid pt-2 mb-2" src="<?= base_url('img/karya/'.$a['gambar_karya']); ?>" alt="<?= $a['judul_karya']; ?>">
                </div>
                <div class="col-md-8 mt-3">
                  <h5 class="card-title"><?= $a['judul_karya']; ?></h5>
                  <p class="card-text">
                    <small class="text-muted">
                      <?= date('j F Y', strtotime($a['updated_at'])) ?>
                    </small>
                  </p>
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
            </div>
          <?php endforeach; ?>

          <!-- nav Pagination -->
            <nav class="mb-5">
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
      <?php endif; ?>

    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,192L40,186.7C80,181,160,171,240,186.7C320,203,400,245,480,250.7C560,256,640,224,720,202.7C800,181,880,171,960,165.3C1040,160,1120,160,1200,138.7C1280,117,1360,75,1400,53.3L1440,32L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>