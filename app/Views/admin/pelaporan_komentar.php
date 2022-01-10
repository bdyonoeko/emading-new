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
              <h3 class="mt-3">Pelaporan Komentar</h3>
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
                  <?php foreach($daftar_pelaporan_komentar as $a): ?>
                    <tr>
                      <th scope="row"><?= $no++; ?></th>
                      <td><?= $a['nama']; ?></td>
                      <td><?= $a['isi_laporan_komentar']; ?></td>
                      <td><?= date('j F Y', strtotime($a['created_at'])); ?></td>
                      <td>
                        <div>
                          <a href="<?= base_url('komentar/detailPelaporanKomentar/'. $a['id_pelaporan_komentar']); ?>" class="btn btn-white btn-sm">
                            <i class="bi bi-eye-fill text-secondary" title="Detail"></i>
                          </a>
                        </div>
                        <form action="<?= base_url('komentar/deletePelaporanKomentar'); ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="id_pelaporan_komentar" value="<?= $a['id_pelaporan_komentar']; ?>">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,256L26.7,240C53.3,224,107,192,160,165.3C213.3,139,267,117,320,138.7C373.3,160,427,224,480,229.3C533.3,235,587,181,640,160C693.3,139,747,149,800,160C853.3,171,907,181,960,181.3C1013.3,181,1067,171,1120,154.7C1173.3,139,1227,117,1280,101.3C1333.3,85,1387,75,1413,69.3L1440,64L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>