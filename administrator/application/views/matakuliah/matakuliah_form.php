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

			<legend><?php echo $button ?> Matakuliah</legend>
			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="varchar">Kode Matakuliah <?php echo form_error('kode_matakuliah') ?></label>
					<input required type="text" class="form-control" name="kode_matakuliah" id="kode_matakuliah" placeholder="Kode Matakuliah" value="<?php echo $kode_matakuliah; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Nama Matakuliah <?php echo form_error('nama_matakuliah') ?></label>
					<input required type="text" class="form-control" name="nama_matakuliah" id="nama_matakuliah" placeholder="Nama Matakuliah" value="<?php echo $nama_matakuliah; ?>" />
				</div>
				<div class="form-group">
					<label for="enum">SKS <?php echo form_error('sks'); ?></label>
					<?php
					$pilihan = array(
						"" => "-- Pilihan --",
						"1" => "1",
						"2" => "2",
						"3" => "3",
						"4" => "4",
						"5" => "5",
						"6" => "6"
					);
					echo  form_dropdown('sks', $pilihan, $sks, 'class="form-control" id="sks" required'); ?>
				</div>

				<div class="form-group">
					<div class="form-group">
						<label for="enum">Semester <?php echo form_error('semester'); ?></label>
						<?php
						$pilihan = array(
							"" => "-- Pilihan --",
							"1" => "1",
							"2" => "2",
							"3" => "3",
							"4" => "4",
							"5" => "5",
							"6" => "6",
							"7" => "7",
							"8" => "8",
						);
						echo  form_dropdown('semester', $pilihan, $semester, 'class="form-control" id="semester" required '); ?>
					</div>
				</div>

				<div class="form-group">
					<label for="enum">Jenis <?php echo form_error('jenis'); ?></label>
					<?php $piljenis = array("" => "-- Pilihan --", "Ganjil" => "Ganjil", "Genap" => "Genap");
					echo  form_dropdown('jenis', $piljenis, $jenis, 'class="form-control" id="jenis" required'); ?>
				</div>

				<div class="form-group">
					<label for="int">Prodi <?php echo form_error('id_prodi') ?></label>
					<?php
					echo combobox('id_prodi', 'prodi', 'nama_prodi', 'id_prodi', $id_prodi);
					?>
				</div>

				<div class="form-group">
					<label for="varchar">Mata Kuliah Prasyarat <?php echo form_error('kode_prasyarat') ?></label>
					<input type="text" class="form-control" name="kode_prasyarat" id="kode_prasyarat" placeholder="Mata Kuliah Prasyarat" value="<?php echo $kode_prasyarat; ?>" />
				</div>

				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('matakuliah_control') ?>" class="btn btn-default">Cancel</a>
			</form>
			<!--// Form Matakuliah-->