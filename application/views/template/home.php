<!DOCTYPE html>
<html>
<?php $app = json_decode(file_get_contents(base_url('cdn/db/app.json')), true); ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?= $app['nama'] ?> - <?= $title ?></title>
  <?php include('_main/css.php') ?>
</head>

<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="dashboard.html">
        <img src="<?= base_url() ?>cdn/img/icons/<?= $app->icon ? $app->icon : 'default.png' ?>">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="dashboard.html">
                <img src="<?= base_url() ?>cdn/img/icons/<?= $app->icon ? $app->icon : 'default.png' ?>">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="<?= base_url() ?>home" class="nav-link <?= (strtolower($title) == 'home') ? "active" : "" ?>">
              <span class="nav-link-inner--text">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>home/registrasi" class="nav-link <?= (strtolower($title) == 'registrasi') ? "active" : "" ?>">
              <span class="nav-link-inner--text">Registrasi</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>home/cek" class="nav-link <?= (strtolower($title) == 'cek') ? "active" : "" ?>">
              <span class="nav-link-inner--text">Cek</span>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item d-none d-lg-block ml-lg-4">
            <a href="<?= base_url() ?>auth/login" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
                <i class="fas fa-door-open mr-2"></i>
              </span>
              <span class="nav-link-inner--text">Masuk</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9"> -->
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8">
        <?= $content ?>
    </div>
  </div>

  <?php include('_main/js.php') ?>
  <?= $script ?>

  <div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; text-align:center; color:#fff; font-size:20px; line-height:100vh;">
      Loading...
  </div>
</body>

</html>