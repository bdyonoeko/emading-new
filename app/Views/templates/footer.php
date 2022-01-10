<!-- datatables -->
<script type="text/javascript">
  $(document).ready(function() {
    $('.dataTable').DataTable();
  });
</script>

<!-- ckeditor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('isi');
</script>
<script>
  CKEDITOR.replace('visi');
</script>
<script>
  CKEDITOR.replace('misi');
</script>

<!-- previewImg -->
<script>
  function previewImg() {
    const gambar = document.querySelector('.gambar-edit');
    const gambarLabel = document.querySelector('.custom-file-label');
    const imgPreview = document.querySelector('.img-preview');

    gambarLabel.textContent = gambar.files[0].name;

    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);

    fileGambar.onload = function(e) {
      imgPreview.src = e.target.result;
    }
  }
</script>

<!-- footer -->
<?php if(session()->get('kode_admin')): ?>
  <footer class="bg-kuning footer-admin">
    <p class="text-center p-3 mb-0">Created with <i class="bi bi-suit-heart-fill text-danger"></i> by <a class="fw-bold text-dark" style="text-decoration: none" href="https://www.instagram.com/bdyn.eko/">bdyn.eko</a></p>
  </footer>
<?php else: ?>
  <footer class="bg-putih footer-user">
    <div class="container">
      <div class="row">

        <!-- profil Sekolah -->
        <div class="col-md-6">
          <div class="row">
            <div class="col-4">
              <img class="my-logo" src="<?= base_url('img/logo/'.$detail_profil_sekolah['logo']); ?>" alt="Logo">
            </div>
            <div class="col-8">
              <p class="font-sekolah"><?= $detail_profil_sekolah['nama_sekolah']; ?></p>
              <p class="mt-3 font-footer"><?= $detail_profil_sekolah['alamat']; ?></p>
              <p class="font-footer"><?= $detail_profil_sekolah['telepon']; ?></p>
              <p class="font-footer"><?= $detail_profil_sekolah['email_sekolah']; ?></p>
            </div>
          </div>
        </div>
        <!-- end profil Sekolah -->

        <!-- menu -->
        <div class="col-md-6 mt-4">
          <div class="container">
            <div class="row">
              <div class="col-6">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <a href="<?= base_url('/home'); ?>">Home</a>
                  </li>
                  <li class="list-group-item">
                    <a href="<?= base_url('/home/pengumuman'); ?>">Pengumuman</a>
                  </li>
                  <li class="list-group-item">
                    <a href="<?= base_url('/home/karya_tulis'); ?>">Karya Tulis</a>
                  </li>
                </ul>
              </div>
              <div class="col-6">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <a href="<?= base_url('/user'); ?>">My Profile</a>
                  </li>
                  <li class="list-group-item">
                    <a href="<?= base_url('/home/profilSekolah'); ?>">Profil Sekolah</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- end menu -->

      </div>
    </div>
  </footer>
<?php endif; ?>