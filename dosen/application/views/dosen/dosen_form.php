<!-------------------------------------------------------*/
/* Copyright   : Yosef Murya & Badiyanto                 */
/* Publish     : Penerbit Langit Inspirasi               */
/*-------------------------------------------------------->
<section class="content-header">
	<h1>
		Sekolah Tinggi Teologi Tawangmangu
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $back ?>">Dosen</a></li>
		<li class="active"><?php echo $button ?> Dosen</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-body">

			<!-- Form input dan edit Dosen-->
			<legend><?php echo $button ?> Dosen</legend>
			<form role="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" class="form-control" name="id_dosen" id="id_dosen" value="<?php echo $id_dosen; ?>" />
				<input type="hidden" class="form-control" name="photo" id="photo" value="<?php echo $photo; ?>" />
				<div class="form-group">
					<label for="varchar">Nidn <?php echo form_error('nidn') ?></label>
					<input type="text" class="form-control" name="nidn" id="nidn" placeholder="Nidn" value="<?php echo $nidn; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Nama Dosen <?php echo form_error('nama_dosen') ?></label>
					<input type="text" class="form-control" name="nama_dosen" id="nama_dosen" placeholder="Nama Dosen" value="<?php echo $nama_dosen; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
					<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
					<?php
					$pilihan = array("" => "-- Pilihan --", "laki-laki" => "Laki-laki", "perempuan" => "Perempuan");
					echo form_dropdown('jenis_kelamin', $pilihan, $jenis_kelamin, 'class="form-control" id="jenis_kelamin"');
					echo form_error('jenis_kelamin');
					?>
				</div>
				<div class="form-group">
					<label for="varchar">Email <?php echo form_error('email') ?></label>
					<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Telp <?php echo form_error('telp') ?></label>
					<input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Photo <?php echo form_error('photo') ?></label>
					<div>
						<?php
						if ($photo == "") {
							echo "<p class='help-block'>Silahkan upload foto dosen </p>";
						} else {
						?>
							<div>
								<img src="../../../images/dosen/<?php echo $photo; ?>">
							</div><br />
						<?php
						}
						?>
						<input type="file" name="photo" id="photo">
					</div>
				</div>

				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('dosen') ?>" class="btn btn-default">Cancel</a>
			</form>