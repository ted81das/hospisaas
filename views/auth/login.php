<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?php echo base_url(); ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo lang('login'); ?> - <?php echo $this->db->get('settings')->row()->system_vendor; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="adminlte/plugins/flag-icon-css/css/flag-icon.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">


</head>


<body class="hold-transition login-page">
  <!-- Language Dropdown Menu -->

  <?php

  if ($this->language == 'arabic') {
    $flagIcon = 'sa';
  }
  if ($this->language == 'english') {
    $flagIcon = 'us';
  }
  if ($this->language == 'spanish') {
    $flagIcon = 'es';
  }
  if ($this->language == 'french') {
    $flagIcon = 'fr';
  }
  if ($this->language == 'italian') {
    $flagIcon = 'it';
  }
  if ($this->language == 'portuguese') {
    $flagIcon = 'pt';
  }
  if ($this->language == 'turkish') {
    $flagIcon = 'tr';
  }
  ?>
  <ul class="navbar-nav ml-auto mr-3" style="position: fixed;
      top: 0;
      right: 0;">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="">
        <button type="button" class="btn btn-block btn-default btn-lg">
          <span class="ml-2 text-lg mr-2" style="text-transform: capitalize;"><?php echo $this->language; ?> </span>
          <span class="fas fa-angle-down text-primary"></span>
        </button>
      </a>
      <div class="dropdown-menu dropdown-menu-right p-0">
        <a href="frontend/changeLanguageFlag?lang=arabic" class="dropdown-item <?php if ($this->language == 'arabic') {
                                                                                  echo 'active';
                                                                                } ?>">
          <i class="flag-icon flag-icon-sa mr-2"></i> عربى
        </a>
        <a href="frontend/changeLanguageFlag?lang=english" class="dropdown-item <?php if ($this->language == 'english') {
                                                                                  echo 'active';
                                                                                } ?>">
          <i class="flag-icon flag-icon-us mr-2"></i> English
        </a>
        <a href="frontend/changeLanguageFlag?lang=spanish" class="dropdown-item <?php if ($this->language == 'spanish') {
                                                                                  echo 'active';
                                                                                } ?>">
          <i class="flag-icon flag-icon-es mr-2"></i> Español
        </a>
        <a href="frontend/changeLanguageFlag?lang=french" class="dropdown-item <?php if ($this->language == 'french') {
                                                                                  echo 'active';
                                                                                } ?>">
          <i class="flag-icon flag-icon-fr mr-2"></i> Français
        </a>
        <a href="frontend/changeLanguageFlag?lang=italian" class="dropdown-item <?php if ($this->language == 'italian') {
                                                                                  echo 'active';
                                                                                } ?>">
          <i class="flag-icon flag-icon-it mr-2"></i> Italiano
        </a>
        <a href="frontend/changeLanguageFlag?lang=portuguese" class="dropdown-item <?php if ($this->language == 'portuguese') {
                                                                                      echo 'active';
                                                                                    } ?>">
          <i class="flag-icon flag-icon-pt mr-2"></i> Português
        </a>
        <a href="frontend/changeLanguageFlag?lang=turkish" class="dropdown-item <?php if ($this->language == 'turkish') {
                                                                                  echo 'active';
                                                                                } ?>">
          <i class="flag-icon flag-icon-tr mr-2"></i> Türkçe
        </a>
      </div>
    </li>
  </ul>

  <div class="login-box">

    <div class="login-logo">
      <a href="adminlte/index2.html"><b><?php echo $this->db->get('settings')->row()->title; ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">



      <div class="card-body login-card-body">
        <p class="login-box-msg"><?php echo lang('Sign in to start your session') ?></p>


        <?php if (!empty($message)) { ?>
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title"> <?php echo $message; ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="mt-3">

            </div>
            <!-- /.card-body -->
          </div>
        <?php } ?>


        <style>
          .card {
            display: block;
          }
        </style>



        <form method="post" action="auth/login">
          <div class="input-group mb-3">
            <input type="email" name="identity" class="form-control" placeholder="<?php echo lang('email') ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password') ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block"><?php echo lang('sign_in') ?></button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mb-1 d-flex ">
          <a data-toggle="modal" href="#myModal"><?php echo lang('forgot_your_password') ?>?</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->





  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="auth/forgot_password">
          <div class="modal-header">
            <h4 class="modal-title"><?php echo lang('forgot_your_password') ?> ?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>

          <div class="modal-body panel">
            <p><?php echo lang('enter_your_email_address_to_reset_your_password') ?></p>
            <input type="text" name="email" placeholder="<?php echo lang('email') ?>" autocomplete="off" class="form-control placeholder-no-fix">

          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-warning" type="button"><?php echo lang('cancel') ?></button>
            <input class="btn btn-primary detailsbutton" type="submit" name="submit" value="<?php echo lang('submit') ?>">
          </div>
        </form>
      </div>
    </div>
  </div>






  <!-- jQuery -->
  <script src="adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>