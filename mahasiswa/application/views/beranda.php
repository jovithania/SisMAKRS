<?php
ini_set('display_errors', '0');
ini_set('error_reporting', E_ALL);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.:: Sekolah Tinggi Teologi Tawangmangu ::.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/_all-skins.min.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="admin" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>STTT </b> </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SiMa KRS </b> </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a class="btn btn-primary" href="admin/logout" role="button"> Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN MENU</li>

          <!-- <li>
            <a href="<?php echo site_url('mahasiswa') ?>">
              <i class="fa fa-user"></i><span>Biodata</span>
            </a>
          </li> -->

          <li>
            <a href="<?php echo site_url('krs_control') ?>">
              <i class="fa fa-book"></i><span>Lihat KRS</span>
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('krs_control/isi_krs') ?>">
              <i class="fa fa-pencil"></i><span>Isi KRS</span>
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('nilai_control') ?>">
              <i class="fa fa-file-text"></i><span>KHS</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <div class="wrapper">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sekolah Tinggi Teologi Tawangmangu
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box box-default color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-gears"></i> Control Panel</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <!-- <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">BIODATA</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('mahasiswa') ?>">
                        <center><i class="fa fa-user" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div> -->

                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Lihat KRS</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('krs_control') ?>">
                        <center><i class="fa fa-book" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>

                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Isi KRS</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('krs_control/isi_krs') ?>">
                        <center><i class="fa fa-edit" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>

                  <!-- /.col -->
                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">KHS</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('nilai_control') ?>">
                        <center><i class="fa fa-file-text-o" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <center>SiMa KRS <a href="https://stt-tawangmangu.ac.id/"><strong>Sekolah Tinggi Teologi Tawangmangu</strong></a> - 2021</center>
              </div>
            </div>

          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <div class="control-sidebar-bg"></div>

    </div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/js/adminlte.min.js') ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets/js/demo.js') ?>"></script>

</body>

</html>