<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="karya-tulis" class="my-background-kuning">
    <div class="container pt-5">

      <div class="row justify-content-center">
        <div class="col-md-11">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/user'); ?>">My Profile</a></li>
              <li class="breadcrumb-item active" aria-current="page">Mulai Menulis</li>
            </ol>
          </nav>

          <div class="container bg-white shadow p-5 rounded">

            <div class="row text-center mb-3">
              <h3>Tambah Karya Tulis</h3>
            </div>

            <div class="row">
              <div class="col-md">
                <form action="<?= base_url('/karyatulis/saveKaryaTulis'); ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul'); ?>" placeholder="Masukkan Judul">
                    <div class="invalid-feedback" id="judul">
                      <?= $validation->getError('judul'); ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="isi" class="form-label">Isi</label>
                    <textarea class="form-control <?= ($validation->hasError('isi')) ? 'is-invalid' : ''; ?>" id="isi" name="isi"><?= old('isi'); ?></textarea>
                    <div class="invalid-feedback" id="isi">
                      <?= $validation->getError('isi'); ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="tag" class="form-label">Tag</label>
                    <input type="text" class="form-control <?= ($validation->hasError('tag')) ? 'is-invalid' : ''; ?>" id="tag" name="tag" value="<?= old('tag'); ?>" placeholder="Masukkan Tag">
                    <div class="invalid-feedback" id="tag">
                      <?= $validation->getError('tag'); ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar" id="gambar" value="<?= old('gambar'); ?>" onchange="previewImg()">
                    <div class="invalid-feedback" id="gambar">
                      <?= $validation->getError('gambar'); ?>
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Kirim Ke Admin</button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
      
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,192L30,197.3C60,203,120,213,180,208C240,203,300,181,360,154.7C420,128,480,96,540,96C600,96,660,128,720,138.7C780,149,840,139,900,144C960,149,1020,171,1080,192C1140,213,1200,235,1260,245.3C1320,256,1380,256,1410,256L1440,256L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>