<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
<section class="daftar-admin">
  <div class="container pt-5 pb-5">

    <!-- pesan -->
    <div class="row justify-content-center text-center px-3">
      <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-success fade show" role="alert">
          <?= session()->getFlashdata('pesan'); ?>
          <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>

    <div class="row justify-content-between">

      <div class="col-md-8 mb-3">
        <div class="container bg-white shadow rounded p-3">
          <div class="row text-center mb-3">
            <h3 class="mt-3">Daftar Admin</h3>
          </div>
          <div class="row mb-3 table-responsive px-4">
            <table class="table table-hover" id="dataTable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Admin</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Status Admin</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach($daftar_admin as $a): ?>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $a['nama_admin']; ?></td>
                    <td><?= $a['email_admin']; ?></td>
                    <td><?= $a['status_admin']; ?></td>
                    <td>
                      <?php if($a['kode_admin'] == "ADM01"): ?>
                        <?php if(session()->get('kode_admin') == "ADM01"): ?>
                          <form action="<?= base_url('admin/edit/'.$a['kode_admin']); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="EDIT">
                            <button type="submit" class="btn btn-white btn-sm">
                              <i class="bi bi-pencil-square text-info" title="Edit"></i>
                            </button>
                          </form>
                        <?php endif; ?>
                      <?php else: ?>
                        <form action="<?= base_url('admin/edit/'.$a['kode_admin']); ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="_method" value="EDIT">
                          <button type="submit" class="btn btn-white btn-sm">
                            <i class="bi bi-pencil-square text-info" title="Edit"></i>
                          </button>
                        </form>
                      <?php endif; ?>
                      <?php if($a['kode_admin'] != "ADM01"): ?>
                        <form action="<?= base_url('admin/delete'); ?>" method="post">
                          <?= csrf_field(); ?>
                          <input type="hidden" name="kode_admin" value="<?= $a['kode_admin']; ?>">
                          <button type="submit" class="btn btn-white btn-sm" onclick="return confirm('Hapus data ini?')">
                            <i class="bi bi-trash-fill text-danger" title="Delete"></i>
                          </button>
                        </form>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4 pb-5">
        <div class="container bg-white shadow p-5 rounded">

          <div class="row text-center mb-3">
            <h3>Tambah Admin</h3>
          </div>
          <div class="row">
            <div class="col-md-12">
              <form action="<?= base_url('/admin/save'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" placeholder="Masukkan Nama" value="<?= old('nama'); ?>">
                  <div class="invalid-feedback" id="nama">
                    <?= $validation->getError('nama'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Alamat Email</label>
                  <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Masukkan Email" value="<?= old('email'); ?>">
                  <div class="invalid-feedback" id="email">
                    <?= $validation->getError('email'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="status" class="form-label">Status Admin</label>
                  <select class="form-select" aria-label="Default select example" name="status" id="status">
                    <option value="Branch">Branch</option>
                    <option value="Master">Master</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Masukkan Password">
                  <div class="invalid-feedback" id="password">
                    <?= $validation->getError('password'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="password2" class="form-label">Ulangi Password</label>
                  <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" name="password2" id="password2" placeholder="Konfirmasi Password">
                  <div class="invalid-feedback" id="password2">
                    <?= $validation->getError('password2'); ?>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Daftarkan</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,64L34.3,96C68.6,128,137,192,206,197.3C274.3,203,343,149,411,149.3C480,149,549,203,617,208C685.7,213,754,171,823,133.3C891.4,96,960,64,1029,85.3C1097.1,107,1166,181,1234,202.7C1302.9,224,1371,192,1406,176L1440,160L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
</section>

<?= $this->endSection(); ?>