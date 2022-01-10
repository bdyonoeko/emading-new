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
              <h3 class="mt-3">Karya Tulis Rekomendasi</h3>
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
                  <?php foreach($daftar_karya_tulis_rekomendasi as $a): ?>
                    <tr>
                      <th scope="row"><?= $no++; ?></th>
                      <td>
                        <img src="<?= base_url('img/karya/'.$a["gambar_karya"]); ?>" alt="<?= $a['nama']; ?>" class="my-mini-image">
                      </td>
                      <td><?= $a['judul_karya']; ?></td>
                      <td><?= $a['nama']; ?></td>
                      <td><?= date('j F Y', strtotime($a['updated_at'])); ?></td>
                      <td>
                        <form action="<?= base_url('karyaTulis/saveEditRekomendasi'); ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="id_karya_tulis" value="<?= $a['id_karya_tulis']; ?>">
                          <input type="hidden" name="direkomendasikan" value="false">
                          <input type="hidden" name="halaman" value="KaryaTulisTerkonfirmasi">
                          <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Batalkan rekomendasi karya tulis ini?')">
                            <i class="bi bi-x-lg text-danger" title="Batalkan Rekomendasi"></i>
                          </button>
                        </form>
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,32L34.3,48C68.6,64,137,96,206,96C274.3,96,343,64,411,64C480,64,549,96,617,106.7C685.7,117,754,107,823,106.7C891.4,107,960,117,1029,122.7C1097.1,128,1166,128,1234,128C1302.9,128,1371,128,1406,128L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>