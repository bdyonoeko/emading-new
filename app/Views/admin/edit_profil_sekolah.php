<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
<section class="profil-sekolah">
  <div class="container pt-5 pb-5">

    <div class="row justify-content-center">

      <div class="col-md-10 pb-5">
        <div class="container bg-white shadow p-5 rounded">

          <div class="row text-center mb-3">
            <h3>Edit Profil Sekolah</h3>
          </div>
          <div class="row">
            <div class="col-md-12">
              <form action="<?= base_url('/sekolah/saveEditProfilSekolah/'.$detail_profil_sekolah['kode_profil_sekolah']); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="mb-3">
                  <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                  <input type="text" class="form-control <?= ($validation->hasError('nama_sekolah')) ? 'is-invalid' : ''; ?>" name="nama_sekolah" id="nama_sekolah" placeholder="Masukkan Nama Sekolah" value="<?= (old('nama_sekolah')) ? old('nama_sekolah') : $detail_profil_sekolah['nama_sekolah']; ?>">
                  <div class="invalid-feedback" id="nama_sekolah">
                    <?= $validation->getError('nama_sekolah'); ?>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat Sekolah</label>
                  <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" placeholder="Masukkan Nama Sekolah" value="<?= (old('alamat')) ? old('alamat') : $detail_profil_sekolah['alamat']; ?>">
                  <div class="invalid-feedback" id="alamat">
                    <?= $validation->getError('alamat'); ?>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="telepon" class="form-label">Telepon</label>
                  <input type="text" class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : ''; ?>" name="telepon" id="telepon" placeholder="Masukkan Nama Sekolah" value="<?= (old('telepon')) ? old('telepon') : $detail_profil_sekolah['telepon']; ?>">
                  <div class="invalid-feedback" id="telepon">
                    <?= $validation->getError('telepon'); ?>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Masukkan Nama Sekolah" value="<?= (old('email')) ? old('email') : $detail_profil_sekolah['email_sekolah']; ?>">
                  <div class="invalid-feedback" id="email">
                    <?= $validation->getError('email'); ?>
                  </div>
                </div>
                
                <div class="mb-3">
                  <label for="visi" class="form-label">Visi</label>
                  <textarea name="visi" id="visi" class="form-control editor <?= $validation->hasError('visi') ? 'is-invalid' : ''; ?>"><?= (old('visi')) ? old('visi') : $detail_profil_sekolah['visi']; ?></textarea>
                  <div class="invalid-feedback" id="visi">
                    <?= $validation->getError('visi'); ?>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="misi" class="form-label">Misi</label>
                  <textarea name="misi" id="misi" class="form-control editor <?= $validation->hasError('misi') ? 'is-invalid' : ''; ?>"><?= (old('misi')) ? old('misi') : $detail_profil_sekolah['misi']; ?></textarea>
                  <div class="invalid-feedback" id="misi">
                    <?= $validation->getError('misi'); ?>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="logo" class="form-label">Logo</label>
                  <div class="row">
                    <div class="col-sm-2 mb-2">
                      <img src="<?= base_url('img/logo/'.$detail_profil_sekolah['logo']); ?>" alt="Logo Sekolah" class="img-thumbnail img-preview my-image-preview">
                      <label for="logo" class="custom-file-label text-muted fontku-2"><?= $detail_profil_sekolah['logo']; ?></label>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <input type="file" name="logo" id="logo" class="form-control <?= $validation->hasError('logo') ? 'is-invalid': ''; ?>" value="<?= old('logo'); ?>" onchange="previewImg()">
                    <div class="invalid-feedback" id="logo">
                      <?= $validation->getError('logo'); ?>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="logo_lama" value="<?= $detail_profil_sekolah['logo']; ?>">

                <button class="btn btn-primary" type="submit">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,96L34.3,80C68.6,64,137,32,206,42.7C274.3,53,343,107,411,128C480,149,549,139,617,165.3C685.7,192,754,256,823,261.3C891.4,267,960,213,1029,186.7C1097.1,160,1166,160,1234,149.3C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
</section>

<?= $this->endSection(); ?>