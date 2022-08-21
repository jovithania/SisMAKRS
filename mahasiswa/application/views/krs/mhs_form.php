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

			<!-- Form KRS Mahasiswa-->
			<legend>Kartu Rencana Studi Mahasiswa</legend>
			<form action="<?php echo $action; ?>" method="post">
				<?php echo validation_errors(); ?>
				<div class="form-group">
					<label for="char">Nomor Mahasiswa <?php echo form_error('nim') ?></label>
					<?php $username    = $this->session->userdata['username']; ?>
					<input type="text" class="form-control" name="nim" id="nim" placeholder="Nomor mahasiswa" value="<?php echo $username; ?>" readonly />
				</div>

				<input id="sisa_sks" name="sisa_sks" type="hidden" value="<?php echo $sisa_sks; ?>">


				<div class="form-group">
					<label for="int">
						Tahun Akademik/Semester
						<?php echo form_error('id_thn_akad') ?>
					</label>
					<?php
					// Query untuk menampilkan data tahun akademik	
					$query = $this->db->query('SELECT id_thn_akad, semester, 
											       CONCAT(thn_akad,"/") 
												   AS thn_sememester 
												   FROM thn_akad_semester ORDER BY id_thn_akad DESC');
					$dropdowns = $query->result();

					foreach ($dropdowns as $dropdown) {

						if ($dropdown->semester == 1) {
							$tampilSemester = "Ganjil";
						} else {
							$tampilSemester =  "Genap";
						}

						$dropDownList[$dropdown->id_thn_akad] = $dropdown->thn_sememester . " " . $tampilSemester;
					}
					echo  form_dropdown('id_thn_akad', $dropDownList, '', 'class="form-control" id="id_thn_akad"');
					?>
				</div>
				<button type="submit" class="btn btn-primary"></button>
			</form>