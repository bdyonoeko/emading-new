<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="my-background">
    <div class="container">
    
      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="row text-center p-3">
            <?php if (session()->getFlashdata('pesan')) : ?>
              <div class="alert alert-success alert-danger fade show" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php elseif (session()->getFlashdata('sukses')): ?>
              <div class="alert alert-success alert-success fade show" role="alert">
                <?= session()->getFlashdata('sukses'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
          </div>

          <div class="container bg-white shadow p-5 rounded">
          
            <div class="row text-center mb-4">
              <h3>Login</h3>
            </div>

            <div class="row">
              <form action="<?= base_url('/auth/login'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= old('email'); ?>" placeholder="Masukkan Email" autofocus>
                  <div class="invalid-feedback" id="email">
                    <?= $validation->getError('email'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Masukkan password">
                  <div class="invalid-feedback" id="password">
                    <?= $validation->getError('password'); ?>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Masuk</button>
              </form>
            </div>
          
          </div>

        </div>
      </div>

    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,224L48,224C96,224,192,224,288,213.3C384,203,480,181,576,181.3C672,181,768,203,864,213.3C960,224,1056,224,1152,229.3C1248,235,1344,245,1392,250.7L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>