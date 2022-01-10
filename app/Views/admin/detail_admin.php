<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
<section class="daftar-admin">
  <div class="container pt-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/admin/admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Admin</li>
      </ol>
    </nav>

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
            <h3>Ubah Admin</h3>
          </div>
          <div class="row">
            <div class="col-md-12">
              <form action="<?= base_url('/admin/editSave/'.$data_admin['kode_admin']); ?>" method="post">
              <?= csrf_field(); ?>
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" placeholder="Masukkan Nama" value="<?= (old('nama')) ? old('nama') : $data_admin['nama_admin'] ?>">
                  <div class="invalid-feedback" id="nama">
                    <?= $validation->getError('nama'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Alamat Email</label>
                  <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Masukkan Email" value="<?= (old('email')) ? old('email') : $data_admin['email_admin'] ?>">
                  <div class="invalid-feedback" id="email">
                    <?= $validation->getError('email'); ?>
                  </div>
                </div>
                <?php if($data_admin['kode_admin'] != "ADM01"): ?>
                  <div class="mb-3">
                    <label for="status" class="form-label">Status Admin</label>
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                      <option value="<?= (old('status')) ? old('status') : $data_admin['status_admin'] ?>" selected><?= (old('status')) ? old('status') : $data_admin['status_admin'] ?></option>
                      <option value="Branch">Branch</option>
                      <option value="Master">Master</option>
                    </select>
                  </div>
                <?php endif; ?>
                <button class="btn btn-primary" type="submit">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,160L34.3,176C68.6,192,137,224,206,197.3C274.3,171,343,85,411,85.3C480,85,549,171,617,208C685.7,245,754,235,823,218.7C891.4,203,960,181,1029,192C1097.1,203,1166,245,1234,224C1302.9,203,1371,117,1406,74.7L1440,32L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
</section>

<?= $this->endSection(); ?>