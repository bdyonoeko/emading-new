<?= $this->extend('templates/starter'); ?>

<?= $this->section('content'); ?>
  <?php if(session()->get('kode_admin')): ?>
    <section id="detail-pengumuman">
  <?php else: ?>
    <section id="detail-pengumuman" class="my-background-kuning">
  <?php endif; ?>
    <div class="container pt-5">
      <div class="row justify-content-center">
        <div class="col-md-11">

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <?php if(session()->get('kode_admin')): ?>
                <li class="breadcrumb-item"><a href="<?= base_url('/sekolah/pengumuman'); ?>">Pengumuman</a></li>
              <?php else: ?>
                <li class="breadcrumb-item"><a href="<?= base_url('/home/pengumuman'); ?>">Pengumuman</a></li>
              <?php endif; ?>
              <li class="breadcrumb-item active" aria-current="page">Baca Pengumuman</li>
            </ol>
          </nav>

          <div class="container bg-putih shadow rounded p-5">

            <div class="row mb-3">
              <h1 class="text-center">
                <?= $detail_pengumuman['judul_pengumuman']; ?>
              </h1>
            </div>
            <div class="row mb-3 justify-content-center">
              <div class="col-md-8">
                <img class="my-image-karya-detail" src="<?= base_url('/img/pengumuman/'. $detail_pengumuman['gambar_pengumuman']); ?>" alt="<?= $detail_pengumuman['judul_pengumuman']; ?>">
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="container p-3" style="overflow-x:auto;">
                <p class="card-text px-3"><?= $detail_pengumuman['isi_pengumuman']; ?></p>
              </div>
              <p class="card-text"><b>Admin : <?= $detail_pengumuman['nama']; ?></b></p>
              <p class="text-muted card-text">Tanggal : <?= date('j F Y', strtotime($detail_pengumuman['updated_at'])); ?></p>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
    <?php if(session()->get('kode_admin')): ?>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e9e967" fill-opacity="1" d="M0,192L30,208C60,224,120,256,180,250.7C240,245,300,203,360,208C420,213,480,267,540,266.7C600,267,660,213,720,208C780,203,840,245,900,272C960,299,1020,309,1080,277.3C1140,245,1200,171,1260,122.7C1320,75,1380,53,1410,42.7L1440,32L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>
    <?php else: ?>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f4f4" fill-opacity="1" d="M0,256L40,224C80,192,160,128,240,117.3C320,107,400,149,480,154.7C560,160,640,128,720,106.7C800,85,880,75,960,106.7C1040,139,1120,213,1200,224C1280,235,1360,181,1400,154.7L1440,128L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
    <?php endif; ?>
  </section>
<?= $this->endSection(); ?>