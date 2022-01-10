<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="pengumuman">
    <div class="container pt-5 pb-5">

      <div class="row justify-content-center">
        <div class="col-md-11">

          <div class="row justify-content-center text-center px-3">
            <?php if(session()->getFlashdata('pesan')): ?>
              <div class="alert alert-success alert-success fade show" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
          </div>

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javascript:history.back()"><i class="bi bi-arrow-left"></i> Kembali</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail User</li>
            </ol>
          </nav>

          <div class="container bg-white shadow rounded p-3">
            <div class="row text-center mb-3">
              <h3 class="mt-3"><?= $detail_user['nama_user']; ?></h3>
            </div>

            <div class="row justify-content-between px-5 pb-3">
              <div class="col-md-4">
                <div class="row">
                  <img src="<?= base_url('/img/user/kartu_pelajar/'.$detail_user['kartu_pelajar']); ?>" alt="<?= $detail_user['nama_user']; ?>" class="my-image-kartu-pelajar shadow p-2">
                </div>
                <div class="row text-center mt-2">
                  <p class="card-text">Kartu Pelajar</p>
                </div>
              </div>

              <div class="col-md-7 card-text p-3">
                <form action="<?= base_url('/user/saveEditUser'); ?>" method="post">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="kode_user" value="<?= $detail_user['kode_user']; ?>">

                  <div class="row">
                    <div class="col-4">Email</div>
                    <div class="col-2">:</div>
                    <div class="col-6"><?= $detail_user['email_user']; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-4">Jenis Kelamin</div>
                    <div class="col-2">:</div>
                    <div class="col-6"><?= $detail_user['jenis_kelamin']; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-4">Bio</div>
                    <div class="col-2">:</div>
                    <div class="col-6"><?= $detail_user['bio']; ?></div>
                  </div>
                  <div class="row my-2">
                    <div class="col-4">
                      <label for="status" class="form-label">Status</label>
                    </div>
                    <div class="col-2">:</div>
                    <div class="col-6">
                      <select class="form-select form-control-sm" aria-label="Default select example" name="status" id="status">
                        <option value="<?= (old('status')) ? old('status') : $detail_user['status']; ?>"><?= (old('status')) ? old('status') : $detail_user['status']; ?></option>
                        <option value="Aktif">Aktif</option>
                        <option value="Banned">Banned</option>
                        <option value="Alumni">Alumni</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">Password</div>
                    <div class="col-2">:</div>
                    <div class="col-6">
                      <a href="<?= base_url('auth/ubahPasswordUserOlehAdmin/'. $detail_user['kode_user']); ?>" class="btn btn-sm btn-secondary">
                        Ubah Password
                      </a>
                    </div>
                  </div>
                  <div class="row mt-2 mb-3">
                    <div class="col-4">Foto</div>
                    <div class="col-2">:</div>
                    <div class="col-6">
                      <img src="<?= base_url('/img/user/profil/'. $detail_user['foto']); ?>" alt="<?= $detail_user['nama_user']; ?>" class="border shadow my-image-preview p-1 rounded-circle">
                    </div>
                  </div>
                  
                  <button type="submit" class="btn btn-sm btn-primary">Update</button>

                </form>
              </div>
          </div>
          </div>

        </div>
      </div>
      
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,288L34.3,282.7C68.6,277,137,267,206,234.7C274.3,203,343,149,411,122.7C480,96,549,96,617,117.3C685.7,139,754,181,823,186.7C891.4,192,960,160,1029,160C1097.1,160,1166,192,1234,218.7C1302.9,245,1371,267,1406,277.3L1440,288L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>