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
              <li class="breadcrumb-item"><a href="<?= base_url('/karyaTulis/detailKaryaTulis/'.$detail_karya_tulis['id_karya_tulis']) ?>"><i class="bi bi-arrow-left"></i> Kembali</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ruang Komentar</li>
            </ol>
          </nav>

          <div class="container shadow p-3 bg-putih mb-5">
            <!-- header komentar -->
            <div class="row px-4 pt-4 pb-2 justify-content-between">

              <div class="col-md-2 text-center">
                <div class="row justify-content-center">
                  <img src="<?= base_url('img/user/profil/'. $detail_karya_tulis['foto']); ?>" alt="<?= $detail_karya_tulis['nama']; ?>" class="rounded-circle my-image-author shadow-sm p-1">
                  <ul class="fontku-4 navbar-nav">
                    <li class="nav-item dropdown">
                      <a class="text-biru fw-bold nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $detail_karya_tulis['nama']; ?>
                      </a>
                      <ul class="dropdown-menu fontku-4" aria-labelledby="navbarDropdown">
                        <div class="row text-center justify-content-center">
                          
                          <!-- user dan author orang yang sama -->
                          <?php if(session()->get('kode_user') == $detail_karya_tulis['kode_user']): ?>
                            <li><a class="text-biru dropdown-item" href="<?= base_url('/user'); ?>">My Profile</a></li>
                            <li>
                              <a href="<?= base_url('/karyaTulis/editKaryaTulis/'. $detail_karya_tulis['id_karya_tulis']); ?>" class="text-biru dropdown-item">
                                Edit
                              </a>
                            </li>
                            <li>
                              <form class="text-biru dropdown-item" action="<?= base_url('/karyaTulis/deleteKaryaTulis'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_karya_tulis" value="<?= $detail_karya_tulis['id_karya_tulis']; ?>">
                                <button type="submit" class="btn btn-white btn-sm text-biru" onclick="return confirm('Hapus karya ini?')">
                                  Delete
                                </button>
                              </form>
                            </li>
                          
                          <!-- user dan author orang yang berbeda -->
                          <?php elseif(session()->get('kode_user') != $detail_karya_tulis['kode_user']): ?>
                            <li><a class="text-biru dropdown-item" href="<?= base_url('/user/profileAuthor/'.$detail_karya_tulis['kode_user']); ?>">Profile Author</a></li>
                            <li>
                              <button type="button" class="btn btn-white btn-sm text-biru" data-bs-toggle="modal" data-bs-target="#laporkan">
                                Laporkan
                              </button>
                            </li>
                          
                          <!-- tidak login dan admin -->
                          <?php else: ?>
                            <li><a class="text-biru dropdown-item" href="<?= base_url('/user/profileAuthor/'.$detail_karya_tulis['kode_user']); ?>">Profile Author</a></li>
                          <?php endif; ?>

                        </div>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="col-md-10 text-center my-auto">
                <h1>
                  <?= $detail_karya_tulis['judul_karya']; ?>
                </h1>
              </div>
            </div>
            
            <!-- isi komentar -->
            <div class="row karya mb-3 justify-content-between p-3">
              <div class="col-md-4 p-2">
                  
                <div class="border shadow-sm p-2">
                  <div class="row">
                    <h4>Buat Komentar</h4>
                  </div>
                  <!-- form komentar -->
                  <div class="row">
                    <form action="<?= base_url('/komentar/saveKomentar'); ?>" method="post">
                      <?= csrf_field(); ?>
                      <div class="mb-3">
                        <textarea class="form-control <?= ($validation->hasError('isi_komentar')) ? 'is-invalid' : ''; ?>" id="isi_komentar" name="isi_komentar" rows="3"></textarea>
                        <div class="invalid-feedback" id="isi_komentar">
                          <?= $validation->getError('isi_komentar'); ?>
                        </div>
                      </div>
                      <input type="hidden" name="id_karya_tulis" value="<?= $detail_karya_tulis['id_karya_tulis']; ?>">
                      <button type="submit" class="btn btn-sm btn-primary">Posting</button>
                    </form>
                  </div>
                </div>

              </div>

              <div class="col-md-7 p-2">
                <!-- komentar -->
                <?php foreach($daftar_komentar_dalam_karya_tulis as $a): ?>
                  <div class="mb-3 p-2 border shadow-sm">
                    <div class="row justify-content-center">
                      <div class="col-3 p-3">
                        <img src="<?= base_url('/img/user/profil/'.$a['foto']); ?>" alt="<?= $a['nama']; ?>" class="my-mini-image rounded-circle p-2 shadow-sm">
                      </div>
                      <div class="col-7 py-auto">
                        <div class="card-body">
                          <h5 class="card-title"><?= $a['nama']; ?></h5>
                          <p class="card-text"><?= $a['isi_komentar']; ?></p>
                          <p class="card-text"><small class="text-muted"><?= date('j F Y', strtotime($a['updated_at'])); ?></small></p>
                        </div>
                      </div>
                      <div class="col-2">

                        <ul class="fontku-4 navbar-nav">
                          <li class="nav-item dropdown">
                            <a class="text-biru fw-bold nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bi bi-three-dots"></i>
                            </a>
                            <!-- laporkan -->
                            <ul class="dropdown-menu fontku-4" aria-labelledby="navbarDropdown">
                              <div class="row text-center justify-content-center">
                                
                                <!-- user dan author orang yang sama -->
                                <?php if(session()->get('kode_user') == $a['kode_user']): ?>
                                  <li><a class="text-biru dropdown-item" href="<?= base_url('/user'); ?>">My Profile</a></li>
                                  <li>
                                    <form class="text-biru dropdown-item" action="<?= base_url('/komentar/deleteKomentar'); ?>" method="post">
                                      <?= csrf_field(); ?>
                                      <input type="hidden" name="id_komentar" value="<?= $a['id_komentar']; ?>">
                                      <input type="hidden" name="id_karya_tulis" value="<?= $a['id_karya_tulis']; ?>">
                                      <button type="submit" class="btn btn-white btn-sm text-biru" onclick="return confirm('Hapus komentar ini?')">
                                        Delete
                                      </button>
                                    </form>
                                  </li>
                                
                                <!-- user dan author orang yang berbeda -->
                                <?php elseif(session()->get('kode_user') != $a['kode_user']): ?>
                                  <li><a class="text-biru dropdown-item" href="<?= base_url('/user/profileAuthor/'.$a['kode_user']); ?>">Profile User</a></li>
                                  <li>
                                    <a class="text-biru dropdown-item" href="<?= base_url('/komentar/laporkanKomentar/'.$a['id_komentar']); ?>">Laporkan</a>
                                  </li>

                                <!-- admin -->
                                <?php elseif(session()->get('kode_admin')): ?>
                                  <li><a class="text-biru dropdown-item" href="<?= base_url('/user/detailUser/'.$detail_karya_tulis['kode_user']); ?>">Detail User</a></li>
                                  <li>
                                   <form class="text-biru dropdown-item" action="<?= base_url('/komentar/deleteKomentar'); ?>" method="post">
                                      <?= csrf_field(); ?>
                                      <input type="hidden" name="id_komentar" value="<?= $a['id_komentar']; ?>">
                                      <input type="hidden" name="id_karya_tulis" value="<?= $a['id_karya_tulis']; ?>">
                                      <button type="submit" class="btn btn-white btn-sm text-biru" onclick="return confirm('Hapus komentar ini?')">
                                        Delete
                                      </button>
                                    </form>
                                  </li>
                                
                                <!-- tidak login dan admin -->
                                <?php else: ?>
                                  <li><a class="text-biru dropdown-item" href="<?= base_url('/user/detail_user/'.$detail_karya_tulis['kode_user']); ?>">Profile Author</a></li>
                                <?php endif; ?>

                              </div>
                            </ul>
                          </li>
                        </ul>

                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

              </div>
              
            </div>
          </div>

        </div>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,32L40,26.7C80,21,160,11,240,32C320,53,400,107,480,128C560,149,640,139,720,160C800,181,880,235,960,261.3C1040,288,1120,288,1200,277.3C1280,267,1360,245,1400,234.7L1440,224L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="laporkan" tabindex="-1" aria-labelledby="laporkanLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="laporkanLabel">Laporkan Karya Tulis</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="<?= base_url('/karyaTulis/savePelaporan'); ?>" method="post">
          <div class="modal-body">
            <?= csrf_field(); ?>
            <div class="mb-3">
              <textarea class="form-control <?= ($validation->hasError('isi_laporan')) ? 'is-invalid' : ''; ?>" id="isi_laporan" name="isi_laporan" rows="3"></textarea>
              <div class="invalid-feedback" id="isi_laporan">
                <?= $validation->getError('isi_laporan'); ?>
              </div>
            </div>
          </div>
          <input type="hidden" name="id_karya_tulis" value="<?= $detail_karya_tulis['id_karya_tulis']; ?>">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
        </form>

      </div>
    </div>
  </div>
<?= $this->endSection(); ?>