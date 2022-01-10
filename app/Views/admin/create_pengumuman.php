<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="pengumuman">
    <div class="container pt-5 pb-5">

      <div class="row justify-content-center">
        <div class="col-md-11">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/sekolah/pengumuman'); ?>">Pengumuman</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Pengumuman</li>
            </ol>
          </nav>

          <div class="container bg-white shadow p-5 rounded">

            <div class="row text-center mb-3">
              <h3>Tambah Pengumuman</h3>
            </div>

            <div class="row">
              <div class="col-md">
                <form action="<?= base_url('/sekolah/savePengumuman'); ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" name="judul" id="judul" value="<?= old('judul'); ?>" placeholder="Masukkan judul">
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
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar" id="gambar" value="<?= old('gambar'); ?>" onchange="previewImg()">
                    <div class="invalid-feedback" id="gambar">
                      <?= $validation->getError('gambar'); ?>
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,256L34.3,240C68.6,224,137,192,206,160C274.3,128,343,96,411,90.7C480,85,549,107,617,112C685.7,117,754,107,823,85.3C891.4,64,960,32,1029,64C1097.1,96,1166,192,1234,208C1302.9,224,1371,160,1406,128L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>