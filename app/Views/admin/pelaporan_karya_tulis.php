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
              <h3 class="mt-3">Pelaporan Karya Tulis</h3>
            </div>

            <div class="row mb-3 table-responsive px-4">
              <table class="table table-hover" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pelapor</th>
                    <th scope="col">Isi Laporan</th>
                    <th scope="col">Tanggal Laporan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach($daftar_pelaporan_karya_tulis as $a): ?>
                    <tr>
                      <th scope="row"><?= $no++; ?></th>
                      <td><?= $a['nama']; ?></td>
                      <td><?= $a['isi_laporan']; ?></td>
                      <td><?= date('j F Y', strtotime($a['created_at'])); ?></td>
                      <td>
                        <div>
                          <a href="<?= base_url('karyaTulis/detailKaryaTulis/'. $a['id_karya_tulis']); ?>" class="btn btn-white btn-sm">
                            <i class="bi bi-eye-fill text-secondary" title="Detail"></i>
                          </a>
                        </div>
                        <form action="<?= base_url('karyaTulis/deletePelaporanKaryaTulis'); ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="id_laporan" value="<?= $a['id_laporan']; ?>">
                          <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Hapus laporan ini?')">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,288L34.3,277.3C68.6,267,137,245,206,240C274.3,235,343,245,411,224C480,203,549,149,617,138.7C685.7,128,754,160,823,170.7C891.4,181,960,171,1029,154.7C1097.1,139,1166,117,1234,128C1302.9,139,1371,181,1406,202.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>