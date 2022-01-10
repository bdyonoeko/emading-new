<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section class="pt-5 mt-4">

    <div class="container pt-5">
    
      <div class="row justify-content-center">
        <div class="col-md-6">

          <nav aria-label="breadcrumb pt-3">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/user/detailUser/'. $detail_user['kode_user']); ?>"><?= $detail_user['nama_user']; ?></a></li>
              <li class="breadcrumb-item active" aria-current="page">Ubah Password User</li>
            </ol>
          </nav>

          <div class="container bg-white shadow p-5 rounded mb-5">
          
            <div class="row text-center mb-4">
              <h3>Password Baru</h3>
            </div>

            <div class="row">
              <form action="<?= base_url('/auth/saveUbahPasswordUserOlehAdmin'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                  <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Masukkan Password">
                  <div class="invalid-feedback" id="password">
                    <?= $validation->getError('password'); ?>
                  </div>
                </div>
                <input type="hidden" name="kode_user" value="<?= $detail_user['kode_user']; ?>">
                <button class="btn btn-primary" type="submit">Update</button>
              </form>
            </div>
          
          </div>

        </div>
      </div>

    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,128L34.3,144C68.6,160,137,192,206,186.7C274.3,181,343,139,411,133.3C480,128,549,160,617,149.3C685.7,139,754,85,823,90.7C891.4,96,960,160,1029,181.3C1097.1,203,1166,181,1234,192C1302.9,203,1371,245,1406,266.7L1440,288L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>