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
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="admin/index" class="logo">
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
          <li>
            <a href="<?php echo site_url('mahasiswa_control') ?>">
              <i class="fa fa-graduation-cap"></i><span>Mahasiswa</span>
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('dosen_control') ?>">
              <i class="fa fa-user"></i><span>Dosen</span>
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('matakuliah_control') ?>">
              <i class="fa fa-sticky-note"></i><span>Mata Kuliah</span>
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('Thn_akad_semester_control') ?>">
              <i class="fa fa-calendar-o"></i><span>Tahun Akademik</span>
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('krs_control') ?>">
              <i class="fa fa-edit"></i><span>KRS</span>
            </a>
          </li>

          <!-- <li>
            <a href="<?php echo site_url('nilai_control') ?>">
              <i class="fa fa-file-text "></i><span>KHS</span>
            </a>
          </li> -->

          <li>
            <a href="<?php echo site_url('nilai_control/inputNilai') ?>">
              <i class="fa fa-sort-numeric-asc"></i><span>Input Nilai</span>
            </a>
          </li>

          <!-- <li>
            <a href="<?php echo site_url('dosen_pembimbing') ?>">
              <i class="fa fa-user"></i><span>Dosen Pembimbing</span>
            </a>
          </li> -->

          <li>
            <a href="<?php echo site_url('jadwal_control') ?>">
              <i class="fa fa-calendar" aria-hidden="true"></i><span>Jadwal Akademik</span>
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('prodi_control') ?>">
              <i class="fa fa-university" aria-hidden="true"></i><span>Program Studi</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>



    <!-- Site wrapper -->
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
                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Mahasiswa</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('mahasiswa_control') ?>">
                        <center><i class="fa fa-graduation-cap" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>

                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Dosen PA</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('dosen_control') ?>">
                        <center><i class="fa fa-user" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>

                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Mata Kuliah</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('matakuliah_control') ?>">
                        <center><i class="fa fa-sticky-note" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>

                  <!-- /.col -->
                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Tahun Akademik</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('Thn_akad_semester_control') ?>">
                        <center><i class="fa fa-calendar-o" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">KRS</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('krs_control') ?>">
                        <center><i class="fa fa-edit" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>
                  <!-- /.col -->
                  <!-- <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">KHS</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('nilai_control') ?>">
                        <center><i class="fa fa-file-text-o" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div> -->
                  <!-- /.col -->
                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Input Nilai</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('nilai_control/inputNilai') ?>">
                        <center><i class="fa fa-sort-numeric-asc" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>
                  <!-- /.col -->
                  <!-- <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Dosen Pembimbing</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('dosen_pembimbing') ?>">
                        <center><i class="fa fa-user" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div> -->
                  <!-- /.col -->
                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Jadwal Akademik</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('jadwal_control') ?>">
                        <center><i class="fa fa-calendar" style="font-size:48px;color:#3c8dbc"></i>
                          <center>
                      </a>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-md-2">
                    <h4 class="text-center"><span class="info-box-text">Program Studi</span></h4>
                    <div class="color-palette-set">
                      <a href="<?php echo site_url('prodi_control') ?>">
                        <center><i class="fa fa-university" style="font-size:48px;color:#3c8dbc"></i>
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
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <div class="control-sidebar-bg"></div>

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