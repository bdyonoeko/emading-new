<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <section id="my-background">
    <div class="container">

    
      <div class="row justify-content-center">
        <div class="col-md-6">

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/user'); ?>">My Profile</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
          </nav>

          <div class="container bg-white shadow p-5 rounded">
          
            <div class="row text-center mb-4">
              <h3>Edit Profile</h3>
            </div>

            <div class="row">
              <form action="<?= base_url('/user/saveEditProfile/'.$detail_user['kode_user']); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" value="<?= (old('nama')) ? old('nama') : $detail_user['nama_user'] ; ?>" placeholder="Masukkan Nama" autofocus>
                  <div class="invalid-feedback" id="nama">
                    <?= $validation->getError('nama'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= (old('email')) ? old('email') : $detail_user['email_user'] ; ?>" placeholder="Masukkan Email">
                  <div class="invalid-feedback" id="email">
                    <?= $validation->getError('email'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="bio" class="form-label">Bio</label>
                  <textarea class="form-control <?= ($validation->hasError('bio')) ? 'is-invalid' : ''; ?>" id="bio" name="bio" rows="3"><?= (old('bio')) ? old('bio') : $detail_user['bio']; ?></textarea>
                  <div class="invalid-feedback" id="bio">
                    <?= $validation->getError('bio'); ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="foto" class="form-label">Foto</label>
                  <div class="row justify-content-between">
                    <div class="col-sm-4 mb-2">
                      <img src="<?= base_url('/img/user/profil/'.$detail_user['foto']); ?>" alt="<?= $detail_user['nama_user']; ?>" class="img-thumbnail img-preview my-image-preview">
                      <label for="foto" class="custom-file-label text-muted fontku-2"><?= $detail_user['foto']; ?></label>
                    </div>
                    <div class="col-sm-8">
                      <input type="file" class="form-control gambar-edit <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" name="foto" id="foto" onchange="previewImg()">
                      <div class="invalid-feedback" id="foto">
                        <?= $validation->getError('foto'); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="email_lama" value="<?= $detail_user['email_user']; ?>">
                <input type="hidden" name="foto_lama" value="<?= $detail_user['foto']; ?>">
                <button class="btn btn-primary" type="submit">Update</button>
              </form>
            </div>
          
          </div>

        </div>
      </div>

    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,192L40,186.7C80,181,160,171,240,186.7C320,203,400,245,480,245.3C560,245,640,203,720,197.3C800,192,880,224,960,229.3C1040,235,1120,213,1200,202.7C1280,192,1360,192,1400,192L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
  </section>
<?= $this->endSection(); ?>