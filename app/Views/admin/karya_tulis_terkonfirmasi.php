<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="pengumuman">
    <div class="container pb-5 pt-5">

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

      <div class="row justify-content-center">
        <div class="col-md-11">

          <div class="container bg-white shadow rounded p-3">
            <div class="row text-center mb-3">
              <h3 class="mt-3">Karya Tulis Terkonfirmasi</h3>
            </div>

            <div class="row mb-3 table-responsive px-4">
              <table class="table table-hover" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Author</th>
                    <th scope="col">Tanggal Pembuatan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach($daftar_karya_tulis_terkonfirmasi as $a): ?>
                    <tr>
                      <th scope="row"><?= $no++; ?></th>
                      <td>
                        <img src="<?= base_url('img/karya/'.$a["gambar_karya"]); ?>" alt="<?= $a['nama']; ?>" class="my-mini-image">
                      </td>
                      <td><?= $a['judul_karya']; ?></td>
                      <td><?= $a['nama']; ?></td>
                      <td><?= date('j F Y', strtotime($a['updated_at'])); ?></td>
                      <td>
                        <?php if($a['direkomendasikan'] == true): ?>
                          <button type="disable" class="btn btn-white btn-sm">
                            <i class="bi bi-hand-thumbs-up-fill fontku-1 text-muted" title="Telah Direkomendasikan"></i>
                          </button>
                        <?php else: ?>
                          <form action="<?= base_url('karyaTulis/saveEditRekomendasi'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_karya_tulis" value="<?= $a['id_karya_tulis']; ?>">
                            <input type="hidden" name="direkomendasikan" value="true">
                            <input type="hidden" name="halaman" value="KaryaTulisRekomendasi">
                            <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Rekomendasikan karya tulis ini?')">
                              <i class="bi bi-hand-thumbs-up-fill fontku-1 text-warning" title="Rekomendasikan"></i>
                            </button>
                          </form>
                        <?php endif; ?>
                        <div>
                          <a href="<?= base_url('karyaTulis/detailKaryaTulis/'. $a['id_karya_tulis']); ?>" class="btn btn-white btn-sm">
                            <i class="bi bi-eye-fill text-secondary" title="Detail"></i>
                          </a>
                        </div>
                        <form action="<?= base_url('karyaTulis/deleteKaryaTulis'); ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="id_karya_tulis" value="<?= $a['id_karya_tulis']; ?>">
                          <input type="hidden" name="halaman" value="KaryaTulisTerkonfirmasi">
                          <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Hapus karya tulis ini?')">
                            <i class="bi bi-trash-fill text-danger" title="Delete"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
      
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,128L34.3,154.7C68.6,181,137,235,206,224C274.3,213,343,139,411,122.7C480,107,549,149,617,144C685.7,139,754,85,823,74.7C891.4,64,960,96,1029,133.3C1097.1,171,1166,213,1234,197.3C1302.9,181,1371,107,1406,69.3L1440,32L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>