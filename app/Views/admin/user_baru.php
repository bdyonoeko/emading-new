<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="pengumuman">
    <div class="container pt-5 pb-5">

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
              <h3 class="mt-3">Daftar User Baru</h3>
            </div>

            <div class="row mb-3 table-responsive px-4">
              <table class="table table-hover" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Bergabung</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach($daftar_user_belum_dikonfirmasi as $a): ?>
                    <tr>
                      <th scope="row"><?= $no++; ?></th>
                      <td>
                        <img src="<?= base_url('img/user/profil/'.$a["foto"]); ?>" alt="<?= $a['nama_user']; ?>" class="my-mini-image">
                      </td>
                      <td><?= $a['nama_user']; ?></td>
                      <td><?= $a['status']; ?></td>
                      <td><?= date('j F Y', strtotime($a['created_at'])); ?></td>
                      <td>
                        <form action="<?= base_url('user/saveEditUser'); ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="kode_user" value="<?= $a['kode_user']; ?>">
                          <input type="hidden" name="status" value="Aktif">
                          <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Konfirmasi user ini?')">
                            <i class="bi bi-check-lg text-success" title="Konfirmasi"></i>
                          </button>
                        </form>
                        <div>
                          <a href="<?= base_url('user/detailUser/'. $a['kode_user']); ?>" class="btn btn-white btn-sm">
                            <i class="bi bi-eye-fill text-secondary" title="Detail"></i>
                          </a>
                        </div>
                        <form action="<?= base_url('user/deleteUser'); ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="kode_user" value="<?= $a['kode_user']; ?>">
                          <input type="hidden" name="halaman" value="userBaru">
                          <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Hapus user ini?')">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,256L34.3,234.7C68.6,213,137,171,206,176C274.3,181,343,235,411,218.7C480,203,549,117,617,112C685.7,107,754,181,823,192C891.4,203,960,149,1029,128C1097.1,107,1166,117,1234,122.7C1302.9,128,1371,128,1406,128L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>