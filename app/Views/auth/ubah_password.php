<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <?php if(session()->get('kode_admin')): ?>
    <section>
  <?php else: ?>
    <section id="my-background">
  <?php endif; ?>

    <div class="container">
    
      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="row text-center p-3">
            <?php if (session()->getFlashdata('pesan')) : ?>
              <div class="alert alert-success alert-danger fade show" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
          </div>

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <?php if(session()->get('kode_user')): ?>
                <li class="breadcrumb-item"><a href="<?= base_url('/user'); ?>"><?= $detail_user['nama_user']; ?></a></li>
              <?php else: ?>
                <li class="breadcrumb-item"><a href="<?= base_url('/admin'); ?>"><?= $detail_admin['nama_admin']; ?></a></li>
              <?php endif; ?>
              <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
            </ol>
          </nav>

          <div class="container bg-white shadow p-5 rounded mb-5">
          
            <div class="row text-center mb-4">
              <h3>Konfirmasi Password</h3>
            </div>

            <div class="row">
              <form action="<?= base_url('/auth/konfirmasiPassword'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                  <label for="password" class="form-label">Password Lama</label>
                  <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Masukkan Password">
                  <div class="invalid-feedback" id="password">
                    <?= $validation->getError('password'); ?>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Kirim</button>
              </form>
            </div>
          
          </div>

        </div>
      </div>

    </div>
    <?php if(session()->get('kode_admin')): ?>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,128L40,122.7C80,117,160,107,240,112C320,117,400,139,480,154.7C560,171,640,181,720,160C800,139,880,85,960,74.7C1040,64,1120,96,1200,106.7C1280,117,1360,107,1400,101.3L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
    <?php else: ?>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,128L40,122.7C80,117,160,107,240,112C320,117,400,139,480,154.7C560,171,640,181,720,160C800,139,880,85,960,74.7C1040,64,1120,96,1200,106.7C1280,117,1360,107,1400,101.3L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
    <?php endif; ?>
  </section>
<?= $this->endSection(); ?>