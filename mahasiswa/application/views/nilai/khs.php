<section class="content-header">
	<h1>
		Sekolah Tinggi Teologi Tawangmangu
	</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<?php
			$ci = get_instance(); // Memanggil object utama
			$ci->load->helper('my_function'); // Memanggil fungsi pada helper dengan nama my_function
			?>
			<center>
				<legend>KARTU HASIL STUDI</strong></legend>
				<table>
					<tr>
						<td><strong>NIM </strong></td>
						<td> : <?php echo $mhs_nim; ?></td>
					</tr>
					<tr>
						<td><strong>Nama</strong></td>
						<td> : <?php echo $mhs_nama; ?></td>
					</tr>
					<tr>
						<td><strong>Program Studi</strong></td>
						<td> : <?php echo $mhs_prodi; ?></td>
					</tr>
					<tr>
						<td><strong>Tahun akademik (semester)</strong></td>
						<td>&nbsp;: <?php echo $thn_akad; ?></td>
					</tr>
				</table>
				<br />
				<table class="table table-bordered table table-striped">
					<tr>
						<td>NO</td>
						<td>KODE</td>
						<td>MATAKULIAH</td>
						<td>SKS</td>
						<td>NILAI</td>
						<td>SKOR</td>
					</tr>
					<?php
					$no   	=	0; // Nomor urut dalam menampilkan data 
					$jSks 	=	0; // Jumlah SKS awal yaitu 0
					$jSkor	=	0; // Jumlah Skor awal yaitu 0

					// Menampilkan data KHS
					foreach ($mhs_data as $row) {
						$no++;
					?>
						<tr>
							<td> <?php echo $no; ?></td>
							<td> <?php echo $row->kode_matakuliah; ?></td>
							<td> <?php echo $row->nama_matakuliah; ?></td>
							<td align="right"> <?php echo $row->sks; ?></td>
							<td align="center"> <?php echo $row->nilai; ?></td>
							<td align="right"> <?php echo skorNilai($row->nilai, $row->sks); ?></td>
							<?php
							if ($row->nilai != 'K') {


								$jSks += $row->sks;
								$jSkor += skorNilai($row->nilai, $row->sks);
							} ?>
						</tr>
					<?php
					}
					?>
					<tr>
						<td colspan="3">Jumlah </td>
						<td align="right"> <?php echo $jSks; ?></td>
						<td>&nbsp;</td>
						<td align="right"> <?php echo $jSkor; ?></td>
					</tr>
				</table>
				Indeks Prestasi : <?php if ($jSks == 0) {
										echo '0.0';
									} else {
										echo number_format($jSkor / $jSks, 2);
									} ?>
			</center>