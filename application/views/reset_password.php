<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sekolah Tinggi Teologi Tawangmangu</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css')?>">
</head>


</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>Sistem Manajemen KRS</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
     <p align="center">Silahkan isi password baru Anda</p>
     <div class="form-group has-feedback">
      <!-- <input type="text" name="username" class="form-control" placeholder="Username" autofocus="true"> -->
       <input type="password" name="pswd_baru" class="form-control" placeholder="Password baru" />
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="pswd_ulang" class="form-control" placeholder="Ulangi Password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="row">
      <div class="col-xs-8"></div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit"  id="btn_login"  class="btn btn-primary btn-block btn-flat">Submit</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</div>
<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo"  >
      <a href="index.php"><b>Sistem Manajemen KRS</b></a>
    </div>
    <h2>Lupa Password</h2>
    <p>Untuk melakukan reset password, silakan masukkan alamat email anda. </p>
    <?php echo form_open('lupa_password'); ?>
    <p>Email:</p>
    <p>
        <input type="text" name="email" value="<?php echo set_value('email'); ?>" />
    </p>
    <p> <?php echo form_error('email'); ?> </p>
    <p>
        <input type="submit" name="btnSubmit" value="Submit" />
    </p>
</div>
</body> -->

</html>  