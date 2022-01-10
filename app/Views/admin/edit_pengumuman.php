<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="pengumuman">
    <div class="container pt-5">

      <div class="row justify-content-center">
        <div class="col-md-11">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/sekolah/pengumuman'); ?>">Pengumuman</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Pengumuman</li>
            </ol>
          </nav>

          <div class="container bg-white shadow p-5 rounded">

            <div class="row text-center mb-3">
              <h3><?= $detail_pengumuman['judul_pengumuman']; ?></h3>
            </div>

            <div class="row">
              <div class="col-md">
                <form action="<?= base_url('/sekolah/saveEditPengumuman/'. $detail_pengumuman['id_pengumuman']); ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="gambar_lama" value="<?= $detail_pengumuman['gambar_pengumuman']; ?>">
                  <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" name="judul" id="judul" value="<?= (old('judul')) ? old('judul') : $detail_pengumuman['judul_pengumuman']; ?>" placeholder="Masukkan judul">
                    <div class="invalid-feedback" id="judul">
                      <?= $validation->getError('judul'); ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="isi" class="form-label">Isi</label>
                    <textarea class="form-control <?= ($validation->hasError('isi')) ? 'is-invalid' : ''; ?>" id="isi" name="isi"><?= (old('isi')) ? old('isi') : $detail_pengumuman['isi_pengumuman']; ?></textarea>
                    <div class="invalid-feedback" id="isi">
                      <?= $validation->getError('isi'); ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <div class="row justify-content-between">
                      <div class="col-sm-4 mb-2">
                        <img class="img-thumbnail img-preview my-image-preview" src="<?= base_url('/img/pengumuman/'. $detail_pengumuman['gambar_pengumuman']); ?>" alt="<?= $detail_pengumuman['judul_pengumuman']; ?>">
                        <label for="gambar" class="custom-file-label text-muted fontku-2"><?= $detail_pengumuman['gambar_pengumuman']; ?></label>
                      </div>
                      <div class="col-sm-8">
                        <input type="file" class="form-control gambar-edit <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar" id="gambar" onchange="previewImg()">
                        <div class="invalid-feedback" id="gambar">
                          <?= $validation->getError('gambar'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Update</button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
      
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,192L40,208C80,224,160,256,240,245.3C320,235,400,181,480,160C560,139,640,149,720,133.3C800,117,880,75,960,64C1040,53,1120,75,1200,112C1280,149,1360,203,1400,229.3L1440,256L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>