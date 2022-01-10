<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section class="my-background-kuning mt-3">
    <div class="container">
    
      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="row text-center p-3">
            <?php if (session()->getFlashdata('pesan')) : ?>
              <div class="alert alert-success alert-success fade show" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
          </div>

          <div class="container bg-white shadow p-5 rounded">
          
            <div class="row text-center mb-4">
              <h3>Registrasi</h3>
            </div>

            <div class="row">
              <form action="<?= base_url('/auth/saveRegistrasi'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" value="<?= old('nama'); ?>" placeholder="Masukkan Nama" autofocus>
                  <div class="invalid-feedback" id="nama">
                    <?= $validation->getError('nama'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= old('email'); ?>" placeholder="Masukkan Email">
                  <div class="invalid-feedback" id="email">
                    <?= $validation->getError('email'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select class="form-select" aria-label="Default select example" name="jenis_kelamin" id="jenis_kelamin">
                    <option value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : null; ?>"><?= (old('jenis_kelamin')) ? old('jenis_kelamin') : '- Pilih -'; ?></option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="kartu_pelajar" class="form-label">Kartu Pelajar</label>
                    <input type="file" class="form-control <?= ($validation->hasError('kartu_pelajar')) ? 'is-invalid' : ''; ?>" name="kartu_pelajar" id="kartu_pelajar" onchange="previewImg()">
                    <div class="invalid-feedback" id="kartu_pelajar">
                      <?= $validation->getError('kartu_pelajar'); ?>
                    </div>
                    <p class="text-muted mt-2 fontku-3">Guru/Staff TU masukkan foto diri</p>
                  </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Masukkan Password">
                  <div class="invalid-feedback" id="password">
                    <?= $validation->getError('password'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="password2" class="form-label">Konfirmasi Password</label>
                  <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" name="password2" id="password2" placeholder="Konfirmasi Password">
                  <div class="invalid-feedback" id="password2">
                    <?= $validation->getError('password2'); ?>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Daftar</button>
              </form>
            </div>
          
          </div>

        </div>
      </div>

    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,192L40,186.7C80,181,160,171,240,186.7C320,203,400,245,480,245.3C560,245,640,203,720,197.3C800,192,880,224,960,229.3C1040,235,1120,213,1200,202.7C1280,192,1360,192,1400,192L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>