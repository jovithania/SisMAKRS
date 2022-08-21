<!-------------------------------------------------------*/
/* Copyright   : Yosef Murya & Badiyanto                 */
/* Publish     : Penerbit Langit Inspirasi               */
/*-------------------------------------------------------->
<!-- <section class="content-header">
      <h1>
       Sekolah Tinggi Teologi Tawangmangu
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo $back ?>">Mahasiswa</a></li>
        <li class="active"><?php echo $button ?> Mahasiswa</li>
      </ol>
    </section> -->
<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<!-- <div class="box">        
        <div class="box-body">
        -->
	<!-- Tampil Data Mahasiswa -->
	<!-- <legend><?php echo $button ?> Mahasiswa</legend> -->
	<!-- Button untuk melakukan update -->
	<!-- <a href="<?php echo site_url('mahasiswa/update/' . $nim) ?>" class="btn btn-primary">Update</a>	 -->
	<!-- Button cancel untuk kembali ke halaman mahasiswa list -->
	<!-- <a href="<?php echo site_url('mahasiswa') ?>" class="btn btn-warning">Cancel</a> -->
	<!-- 	<p></p> -->
	<!-- Menampilkan data mahasiswa secara detail -->
	<!-- <table class="table table-striped table-bordered">
				<tr><td>Photo</td><td><img src="../../images/<?php echo $photo; ?>"></td></tr>
				<tr><td>Nim</td><td><?php echo $nim; ?></td></tr>
				<tr><td>Nama Lengkap</td><td><?php echo $nama_lengkap; ?></td></tr>
				<tr><td>Nama Panggilan</td><td><?php echo $nama_panggilan; ?></td></tr>
				<tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
				<tr><td>Email</td><td><?php echo $email; ?></td></tr>
				<tr><td>Telp</td><td><?php echo $telp; ?></td></tr>
				<tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
				<tr><td>Tanggal Lahir</td><td><?php echo tgl_indo($tgl_lahir); ?></td></tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>
					<?php
					// if($jenis_kelamin == "L"){
					// 	echo "Laki-laki";
					// }
					// else{
					// 	echo "Perempuan";
					// }
					?>
					</td>
				</tr>
				<tr><td>Agama</td><td><?php echo $agama; ?></td></tr>
				<tr><td>Program Studi</td><td><?php echo inputtext('id_prodi', 'prodi', 'nama_prodi', 'id_prodi', $id_prodi); ?></td></tr>
			</table> -->

	<!DOCTYPE html>
	<html>

	<head>
		<title>Bootstrap Part 15 : Membuat Modal dengan Bootstrap</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
	</head>

	<body>
		<div class="container">
			<center>
				<h1>Membuat Modal dengan Bootstrap | www.malasngoding.com</h1>
			</center>
			<br />
			<!-- Tombol untuk menampilkan modal-->
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Buka Modal</button>

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- konten modal-->
					<div class="modal-content">
						<!-- heading modal -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">KRS MAHASISWA</h4>
						</div>
						<!-- body modal -->
						<div class="modal-body">
							<p>bagian body modal.</p>
						</div>
						<!-- footer modal -->
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

	</html>