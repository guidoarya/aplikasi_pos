<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SaiTech | Log in</title>
  <link rel="icon" href="<?= base_url() ?>assets/media/company/logo-saitech.jpg">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/code_template/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/code_template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/code_template/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/code_template/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/code_template/plugins/iCheck/square/blue.css">
  <!-- Sweatalert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/sweetalert/sweetalert2.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .swal2-popup {
      font-size: 1.6rem;
    }
  </style>
</head>

<body class="hold-transition login-page">

  <!-- set session respon login -->
  <div id="flash" data-flash="<?= $this->session->flashdata('login_fail') ?>"></div>

  <div class="login-box">
    <div class="login-logo">
      <img src="<?= base_url() ?>assets/media/company/logo-saitech.jpg" width="100px" class="img-circle" alt=""><br>
      <a href="#"><b>SaiTech</b>Point Of Sale</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?= site_url('auth/cek_login') ?>" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <a href="#">I forgot my password</a>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?= base_url() ?>assets/code_template/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url() ?>assets/code_template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?= base_url() ?>assets/code_template/plugins/iCheck/icheck.min.js"></script>
  <!-- sweetalert2 -->
  <script src="<?= base_url() ?>assets/sweetalert/sweetalert2.min.js"></script>

  <script>
    var flash = $('#flash').data('flash')
    if(flash) {
      const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'error',
      title: flash
    })
    }
  </script>

  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>

</body>

</html>