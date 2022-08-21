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

			<!-- Form KRS-->
			<center>
				<legend><strong>KARTU RENCANA STUDI</strong></legend>
				<table>
					<tr>
						<td><strong>NIM </strong></td>
						<td> &nbsp;: <?php echo $nim; ?></td>
					<tr>
					<tr>
						<td><strong>Nama </strong></td>
						<td> &nbsp;: <?php echo $nama_lengkap; ?> </td>
					</tr>
					<tr>
						<td><strong>Program Studi</strong></td>
						<td> &nbsp;: <?php echo $prodi; ?> </td>
					</tr>
					<tr>
						<td><strong>Tahun akademik(semester) </strong></td>
						<td> &nbsp;: <?php echo $thn_akad . '&nbsp;(' . $semester . ')'; ?> </td>
					</tr>
				</table>
			</center>
			<br />
			<table class="table table-bordered table table-striped" style="margin-bottom: 10px;">
				<tr>
					<th>NO</th>
					<th>KODE</th>
					<th>MATAKULIAH</th>
					<th>SKS</th>
				</tr>
				<?php
				$no = 1; // Nomor urut dalam menampilkan data
				$jumlahSks = 0; // Jumlah SKS dimulai dari 0

				// Menampilkan data KRS
				foreach ($krs_data as $krs) {
				?>
					<tr>
						<td width="80px"><?php echo $no++; ?></td>
						<td><?php echo $krs->kode_matakuliah; ?></td>
						<td><?php echo $krs->nama_matakuliah; ?></td>
						<td>
							<?php
							echo $krs->sks;
							$jumlahSks += $krs->sks;
							?>
						</td>
					</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="3"><strong>JUMLAH SKS</strong></td>
					<td><strong><?php echo $jumlahSks; ?></strong></td>
					<td></td>
				</tr>
			</table>
			<?php
			// Button untuk melakukan create KRS
			echo anchor(site_url('krs_control'), 'Kembali', 'class="btn btn-primary"');
			?>
		</div>