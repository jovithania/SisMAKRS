<section class="content-header">
	<h1>
		Sekolah Tinggi Teologi Tawangmangu
	</h1>
</section>
<section class="content">


	<div class="box">
		<div class="box-body">


			<legend> Mahasiswa</legend>
			<form role="form" class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<input class="form-control" name="nimAwal" id="nimAwal" type="hidden" value="<?php echo $nim; ?>" />

				<div class="form-group">
					<label class="col-sm-2" for="char">Nomor Induk Mahasiswa</label>
					<div class="col-sm-4">
						<input required type="text" class="form-control" name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" />
						<?php echo form_error('nim'); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2" for="varchar">Nama Lengkap</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
						<?php echo form_error('nama_lengkap') ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2" for="varchar">Alamat </label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
						<?php echo form_error('alamat') ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2" for="varchar">Email </label>
					<div class="col-sm-4">
						<input required type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
						<?php echo form_error('email') ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2" for="varchar">Telp </label>
					<div class="col-sm-8">
						<input required type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
						<?php echo form_error('telp') ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2" for="enum">Jenis Kelamin</label>
					<div class="col-sm-4">
						<?php
						$pilihan = array("" => "-- Pilihan --", "L" => "Laki-laki", "P" => "Perempuan");
						echo form_dropdown('jenis_kelamin', $pilihan, $jenis_kelamin, 'class="form-control" id="jenis_kelamin"');
						echo form_error('jenis_kelamin');
						?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2" for="int">Program Studi </label>
					<div class="col-sm-4">
						<?php
						$query = $this->db->query('SELECT id_prodi,nama_prodi FROM prodi');
						$dropdowns = $query->result();
						foreach ($dropdowns as $dropdown) {
							$dropDownList[$dropdown->id_prodi] = $dropdown->nama_prodi;
						}
						$dropDownList[""] =  "-- Pilihan --";
						echo  form_dropdown(
							'id_prodi',
							$dropDownList,
							$id_prodi,
							'class="form-control" id="id_prodi"'
						);
						echo form_error('id_prodi')
						?>
					</div>
				</div>
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('mahasiswa_control') ?>" class="btn btn-default">Cancel</a>
			</form>