<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/logotitle.png">
    <title>Sistem Informasi SPPD Kominfo Pasaman</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1" name=viewport>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="theme/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="theme/fontawesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="theme/dist/css/AdminLTE.min.css">
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p><img src="images/logomasuk.png" img alt="Logo Masuk" width="361" height="231"></p>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Masukkan Email Anda</p>
        <?php 
        if (isset($_GET['log'])) {
          echo "<div class='alert alert-success'><strong>Password Anda Sudah Dikirimkan Oleh Sistem Ke Email Anda</strong></div>";
        }
        ?>
        <form name="form" action="mail.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Email" name="email" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
          <a href="index.php" class="btn btn-success btn-block btn-flat">Kembali Ke Login</a>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="theme/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="theme/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="theme/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck( {
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>

</html>
