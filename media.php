<?php

// Mengaktifkan session pada php
session_start();

// Apabila user belum login
if  (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])) {
    header('location:index.php?log=1');;
}

// Apabila user sudah login dengan benar, maka terbentuklah session
else {
  include "config/koneksi.php";
  include "config/library.php";
  include "config/fungsi_indotgl.php";

?>

<!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/logotitle.png"/>
    <title>Sistem Informasi SPPD Kominfo Pasaman</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="theme/bootstrap/css/bootstrap.min.css">
    <!-- Detepicker -->
    <link rel="stylesheet" href="theme/plugins/datepicker/datepicker3.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="theme/fontawesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="theme/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="theme/dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="theme/plugins/datatables/dataTables.bootstrap.css">
    <!-- sppd -->
    <link href="css/style_properti.css" rel="stylesheet" type="text/css" />
    <!-- Pikaday -->
    <script src="pikaday/js/moment.js"></script>
    <script src="pikaday/js/pikaday.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->
  <body class="hold-transition skin-green-dark sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="?module=home" class="logo" aria-label="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SPPD</b></span>

          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SPPD</b> KOMINFO</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" aria-label="sidebar toggle">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-label="dropdown toggle">
                  <img src="images/profil.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo "$_SESSION[namauser]"; ?></span>
                </a>
                <ul class="dropdown-menu">

                  <!-- Menu Body -->
                  <li class="user-body">
                    <?php
                      echo "<p align=right>Login : $hari_ini, ";
                      echo tgl_indo(date("Y m d")); 
                      echo " | "; 
                      echo date("H:i:s");
                      echo " WIB</p>";
                    ?>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat" onClick="return confirm('Anda Yakin Ingin Keluar')" aria-label="Sign out">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar" aria-label="Control Sidebar"><i class="fa fa-cog"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php
          if ($_SESSION['level']=="operator") {
          ?>
            </p>
            <ul class="sidebar-menu">
              <li>
                <a href="?module=home" aria-label="Home">
                <i class="fa fa-home"></i> <span>Home</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="#" aria-label="Menu Pegawai">
                  <i class="fa fa-user"></i>
                  <span>Menu Pegawai</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?module=pegawai" aria-label="pegawai"><i class="fa fa-user"></i>Data Pegawai</a></li>
                  <li><a href="?module=pangkat" aria-label="pangkat"><i class="fa fa-circle-o"></i>Pangkat</a></li>
                  <li><a href="?module=jabatan" aria-label="jabatan"><i class="fa fa-circle-o"></i>Jabatan</a></li>
                  <li><a href="?module=tujuan" aria-label="tujuan"><i class="fa fa-map-marker"></i>Tujuan</a></li>
                  <li><a href="?module=transportasi" aria-label="transportasi"><i class="fa fa-bus"></i>Transportasi</a></li>
                </ul>
              </li>
              <li>
                <a href="?module=biaya" aria-label="biaya">
                  <i class="fa fa-bitcoin"></i> <span>Biaya Perjalanan Dinas</span>
                </a>
              </li>
              <li>
                <a href="?module=nppt" aria-label="nppt">
                  <i class="fa fa-sticky-note"></i> <span>NPPD</span>
                </a>
              </li>
              <li>
                <a href="?module=spt" aria-label="spt">
                  <i class="fa fa-book"></i> <span>SPT</span>
                </a>
              </li>        
              <li>
                <a href="?module=sppd" aria-label="sppd">
                  <i class="fa fa-share"></i> <span>SPPD</span>
                </a>
              </li>  
              <li class="treeview">
                <a href="#" aria-label="Menu Laporan">
                  <i class="fa fa-folder-open"></i> <span>Menu Laporan</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?module=kwitansi" aria-label="kwitansi"><i class="fa fa-circle-o"></i> Laporan Kwitansi</a></li>
                  <li><a href="?module=lpd" aria-label="lpd"><i class="fa fa-circle-o"></i> Laporan Perjalanan Dinas</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#" aria-label="Pengaturan">
                  <i class="fa fa-gear"></i> <span>Pengaturan</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?module=ttdkwitansi" aria-label="ttd kwitansi"><i class="fa fa-pencil-square"></i>TTD Kwitansi</a></li>
                  <li><a href="?module=password" aria-label="password"><i class="fa fa-envelope"></i>Email & Password</a></li>
                </ul>
              </li>
              <li>
                <a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar')" aria-label="log out">
                  <i class="fa fa-sign-out"></i><span>Logout</span>
                </a>
              </li>
            </ul>
          <?php }elseif($_SESSION['level']=="kadis") { ?>
            <ul class="sidebar-menu">
              <li>
                <a href="?module=home" aria-label="home">
                  <i class="fa fa-home"></i> <span>Home</span> 
                </a>
              </li>
              <li class="treeview">
                <a href="?module=nppt" aria-label="nppt">
                  <i class="fa fa-sticky-note"></i> <span>NPPD</span>
                </a>
              </li>
              <li>
                <a href="?module=kwitansi" aria-label="kwitansi">
                  <i class="fa fa-share"></i> <span>Kwitansi</span>
                </a>
              </li>
              <li>
                <a href="?module=lpd" aria-label="lpd">
                  <i class="fa fa-share"></i> <span>Laporan Perjalanan Dinas</span>
                </a>
              </li>
              <li>
                <a href="?module=password" aria-label="password">
                  <i class="fa fa-envelope"></i> <span>Email & Password</span>
                </a>
              </li>
              <li>
                <a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar')" aria-label="Logout">
                  <i class="fa fa-sign-out"></i><span>Logout</span>
                </a>
              </li>
            </ul>
          <?php }else { ?>
            <ul class="sidebar-menu">
              <li>
                <a href="?module=home" aria-label="home">
                  <i class="fa fa-home"></i> <span>Home</span> 
                </a>
              </li>
              <li>
                <a href="?module=spt" aria-label="spt">
                  <i class="fa fa-book"></i> <span>Input Laporan SPT</span>
                </a>
              </li>
              <li>
                <a href="?module=lpd" aria-label="lpd">
                  <i class="fa fa-share"></i> <span>Laporan Perjalanan Dinas</span>
                </a>
              </li>
              <li>
                <a href="?module=password" aria-label="password">
                  <i class="fa fa-envelope"></i> <span>Email & Password</span>
                </a>
              </li>
              <li>
                <a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar')" aria-label="logouut">
                  <i class="fa fa-sign-out"></i><span>Logout</span>
                </a>
              </li>
            </ul>
          <?php } ?>
        </section><!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Main content -->
        <!-- content -->
        <section class="content style1">
          <?php include "content.php"; ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1
        </div>
        <strong>Copyright &copy; 2021 <a href="http://instagram.com/rijalularif" aria-label="instagram">Rijalul Arif </a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="control-sidebar-home-tab" data-toggle="tab" aria-label="Control Sidebar Home Tab"><i class="fa fa-home"></i></a></li>
          <li><a href="control-sidebar-settings-tab" data-toggle="tab" aria-label="Control Sidebar Settings Tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab"></div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab"></div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->

      <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- /wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="theme/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="theme/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- Detepicker -->
    <script src="theme/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- FastClick -->
    <script src="theme/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="theme/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="theme/dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="theme/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="theme/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Pikaday -->
    
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable( {
          'scrollX': true,
          'scrollCollapse': true
        });
        $('#example2').DataTable( {
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

  </body>
</html>
<?php 
}

?>
