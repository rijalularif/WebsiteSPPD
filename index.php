<!DOCTYPE html>
<html lang=en>

  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/logotitle.png"/>
    <title>Sign In Sistem Informasi SPPD Kominfo Pasaman</title>
    <!-- Tell the browser to be responsive to screen width -->
	<meta name="author" content="Rijalul Arif">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="theme/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="theme/fontawesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="theme/dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
      $(document).ready(function() {
        $(".text").val('');
        $("#username").focus();
      });
      function validasi(form) {
        if (form.username.value == "") {
          alert("Anda belum mengisikan Username.");
          form.username.focus();
          return (false);
        }
        if (form.password.value == "") {
          alert("Anda belum mengisikan Password.");
          form.password.focus();
          return (false);
        }
        return (true);
      }
    </script>
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p><img src="images/logomasuk.png" width="361" height="231" img alt="Logo Sign In"></p>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php 
					$log= isset($_GET['log']) ? $_GET['log'] : "";
          if ($log == 2) {
            echo "<div class='alert alert-danger'><strong>Login gagal, Silahkan coba kembali.</strong></div>";
          }
          elseif ($log == 1) {
            echo "<div class='alert alert-danger'><strong>Kami Mendeteksi Anda Belum Login.</strong></div>";
          }
        ?>
        <form name="form" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <select name="level" id="level" class="form-control" aria-label="Pembagian User">
              <option value="operator">operator</option>
              <option value="user">pegawai</option>
              <option value="kadis">kadis</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          <a href="lupapassword.php" class="btn btn-success btn-block btn-flat" aria-label="Lupa Password">Lupa Password</a>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    
    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    
  </body>
  
</html>
