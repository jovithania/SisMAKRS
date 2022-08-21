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

			<!-- Tampil Data Mahasiswa -->
			<legend><?php echo $button ?> Mahasiswa</legend>
			<!-- Button untuk melakukan update -->
			<a href="<?php echo site_url('mahasiswa_control/update/' . $nim) ?>" class="btn btn-primary">Update</a>
			<!-- Button cancel untuk kembali ke halaman mahasiswa list -->
			<a href="<?php echo site_url('mahasiswa_control') ?>" class="btn btn-warning">Cancel</a>
			<p></p>
			<!-- Menampilkan data mahasiswa secara detail -->
			<table class="table table-striped table-bordered">
				<tr>
					<td>Nim</td>
					<td><?php echo $nim; ?></td>
				</tr>
				<tr>
					<td>Nama Lengkap</td>
					<td><?php echo $nama_lengkap; ?></td>
				</tr>
				<tr>
					<td>Nama Panggilan</td>
					<td><?php echo $nama_panggilan; ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><?php echo $alamat; ?></td>
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
					<td>Jenis Kelamin</td>
					<td>
						<?php
						if ($jenis_kelamin == "L") {
							echo "Laki-laki";
						} else {
							echo "Perempuan";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Program Studi</td>
					<td><?php echo inputtext('id_prodi', 'prodi', 'nama_prodi', 'id_prodi', $id_prodi); ?></td>
				</tr>
			</table>