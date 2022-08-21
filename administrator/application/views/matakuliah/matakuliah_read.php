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

			<!-- Tampil Data Matakuliah -->
			<legend><?php echo $button ?> Matakuliah</legend>
			<!-- Button untuk melakukan update -->
			<a href="<?php echo site_url('matakuliah_control/update/' . $kode_matakuliah) ?>" class="btn btn-primary">Update</a>
			<!-- Button cancel untuk kembali ke halaman mahasiswa list -->
			<a href="<?php echo site_url('matakuliah_control') ?>" class="btn btn-warning">Cancel</a>
			<p></p>
			<table class="table table-striped table-bordered">
				<tr>
					<td>Kode Matakuliah</td>
					<td><?php echo $kode_matakuliah; ?></td>
				</tr>
				<tr>
					<td>Nama Matakuliah</td>
					<td><?php echo $nama_matakuliah; ?></td>
				</tr>
				<tr>
					<td>Sks</td>
					<td><?php echo $sks; ?></td>
				</tr>
				<tr>
					<td>Semester</td>
					<td><?php echo $semester; ?></td>
				</tr>
				<tr>
					<td>Jenis</td>
					<td>
						<?php
						if ($jenis == "Ganjil") {
							echo "Ganjil";
						} else {
							echo "Genap";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Program Studi</td>
					<td><?php echo $nama_prodi; ?></td>
				</tr>
				<!-- <tr>
					<td></td>
					<td><a href="<?php echo site_url('matakuliah_control') ?>" class="btn btn-default">Cancel</a></td>
				</tr> -->
			</table>
			<!--// Tampil Data Matakuliah -->