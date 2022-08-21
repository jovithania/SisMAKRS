<section class="content-header">
	<h1>
		Sekolah Tinggi Teologi Tawangmangu
	</h1>
</section>
<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-body">

			<!-- Tampil Data Dosen -->
			<legend><?php echo $button ?> Dosen</legend>
			<!-- Button untuk melakukan update -->
			<a href="<?php echo site_url('dosen_control/update/' . $id_dosen) ?>" class="btn btn-primary">Update</a>
			<!-- Button cancel untuk kembali ke halaman dosen list -->
			<a href="<?php echo site_url('dosen_control') ?>" class="btn btn-warning">Cancel</a>
			<p></p>
			<!-- Menampilkan data dosen secara detail -->
			<table class="table table-striped table-bordered">
				<tr>
					<td>Photo</td>
					<td><img src="../../../images/dosen/<?php echo $photo; ?>" </td>
				</tr>
				<tr>
					<td>NIDN</td>
					<td><?php echo $nidn; ?></td>
				</tr>
				<tr>
					<td>Nama Dosen</td>
					<td><?php echo $nama_dosen; ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><?php echo $alamat; ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td><?php echo $jenis_kelamin; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $email; ?></td>
				</tr>
				<tr>
					<td>Telp</td>
					<td><?php echo $telp; ?></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="<?php echo site_url('dosen_control') ?>" class="btn btn-default">Cancel</a></td>
				</tr>
			</table>