<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <?php if(session()->get('kode_admin')): ?>
    <section class="detail-karya-tulis">
  <?php else: ?>
    <section class="detail-karya-tulis my-background-kuning">
  <?php endif; ?>
    <div class="container pt-5 pb-5">
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
              <?php if(session()->get('kode_admin')): ?>
                <li class="breadcrumb-item"><a href="javascript:history.back()"><i class="bi bi-arrow-left"></i> Kembali</a></li>
              <?php else: ?>
                <li class="breadcrumb-item"><a href="<?= base_url('/home/karya_tulis'); ?>">Karya Tulis</a></li>
              <?php endif; ?>
              <li class="breadcrumb-item active" aria-current="page">Baca Karya Tulis</li>
            </ol>
          </nav>

          <div class="container bg-putih shadow p-3">
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

                          <!-- user -->
                          <?php if(session()->get('kode_user')): ?>
                            <!-- user == author -->
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

                            <!-- user != author -->
                            <?php else: ?>
                              <li><a class="text-biru dropdown-item" href="<?= base_url('/user/profileAuthor/'.$detail_karya_tulis['kode_user']); ?>">Profile Author</a></li>
                              <li>
                                <button type="button" class="btn btn-white btn-sm text-biru" data-bs-toggle="modal" data-bs-target="#laporkan">
                                  Laporkan
                                </button>
                              </li>
                            <?php endif; ?>
                          <!-- admin -->
                          <?php elseif(session()->get('kode_admin')): ?>
                            <li><a class="text-biru dropdown-item" href="<?= base_url('/user/detailUser/'.$detail_karya_tulis['kode_user']); ?>">Detail User</a></li>
                            <li>
                              <form class="text-biru dropdown-item" action="<?= base_url('/karyaTulis/deleteKaryaTulis'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_karya_tulis" value="<?= $detail_karya_tulis['id_karya_tulis']; ?>">
                                <input type="hidden" name="halaman" value="KaryaTulisTerkonfirmasi">
                                <button type="submit" class="btn btn-white btn-sm text-biru" onclick="return confirm('Hapus karya ini?')">
                                  Delete
                                </button>
                              </form>
                            </li>

                          <!-- tidak login -->
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

            <div class="row karya mb-3 justify-content-center p-3">

                <div class="container">
  
                  <div class="row justify-content-center">
                    <div class="col-md-8">
                      <img src="<?= base_url('/img/karya/'. $detail_karya_tulis['gambar_karya']); ?>" alt="<?= $detail_karya_tulis['judul_karya']; ?>" class="my-image-karya-detail shadow img-thumbnail">
                    </div>
                  </div>
    
                  <div class="row justify-content-center p-4" style="overflow-x:auto;">
                    <p class="card-text"><?= $detail_karya_tulis['isi_karya']; ?></p>
                    <p class="card-text text-muted">Tanggal : <?= date('j F Y', strtotime($detail_karya_tulis['updated_at'])) ?></p>
                    <p class="card-text text-muted">Pengkonfirmasi : <?= $detail_karya_tulis['terkonfirmasi'] == false ? "Belum mendapat konfirmasi admin" : $detail_karya_tulis['nama_admin']; ?></p>
                  </div>
  
                </div>
                
                <?php if(session()->get('kode_user')): ?>
                  <div class="row text-center pt-3">
                    <p class="fontku-1">
                      <a href="<?= base_url('/komentar/ruangKomentar/'.$detail_karya_tulis['id_karya_tulis']); ?>" class="fontku-1 text-biru">Ruang Komentar (<?= count($daftar_komentar_dalam_karya_tulis); ?>)</a>
                    </p>
                  </div>
                <?php endif; ?>

            </div>
          </div>

        </div>
      </div>
    </div>
    <?php if(session()->get('kode_admin')): ?>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,192L34.3,213.3C68.6,235,137,277,206,272C274.3,267,343,213,411,186.7C480,160,549,160,617,133.3C685.7,107,754,53,823,64C891.4,75,960,149,1029,176C1097.1,203,1166,181,1234,154.7C1302.9,128,1371,96,1406,80L1440,64L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
    <?php else: ?>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,192L34.3,213.3C68.6,235,137,277,206,272C274.3,267,343,213,411,186.7C480,160,549,160,617,133.3C685.7,107,754,53,823,64C891.4,75,960,149,1029,176C1097.1,203,1166,181,1234,154.7C1302.9,128,1371,96,1406,80L1440,64L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
    <?php endif; ?>
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