<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- my css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">

    <!-- my font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- datatables -->
    <link rel="stylesheet" href="<?= base_url('/datatables/dataTables.bootstrap4.min.css'); ?>"/>
    <title>E-mading | <?= $title; ?></title>
  </head>
  <body>
    
    <?= $this->include('templates/navbar'); ?>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('templates/footer'); ?>
    
    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- datatables -->
    <script src="<?= base_url('/'); ?>/datatables/jquery.min.js"></script>
    <script src="<?= base_url('/'); ?>/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('/'); ?>/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('/'); ?>/datatables/datatables-demo.js"></script>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
  </body>
</html>