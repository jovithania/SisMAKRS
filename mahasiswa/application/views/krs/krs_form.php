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

			<!-- Form input dan edit data KRS-->
			<legend><?php echo $judul; ?> Data Kartu Rencana Studi </legend>

			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="int">Tahun Akademik <?php echo form_error('id_thn_akad') ?></label>
					<input type="text" class="form-control" name="thn_akad_smt" id="thn_akad_smt" value="<?php echo $thn_akad_smt . '/' . $semester; ?>" readonly />
					<input type="hidden" class="form-control" name="id_thn_akad" id="id_thn_akad" value="<?php echo $id_thn_akad; ?>" />
					<input type="hidden" class="form-control" name="id_krs" id="id_krs" value="<?php echo $id_krs; ?>" />
					<input type="hidden" id="sisa_sks" class="form-control" name="sisa_sks" id="sisa_sks" value="<?php echo $sisa_sks; ?>">
				</div>

				<div class="form-group">
					<label for="char">Nomor Mahasiswa <?php echo form_error('nim') ?></label>
					<input type="text" class="form-control" name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" readonly />
				</div>
				<div class="form-group">
					<label for="int">Matakuliah <?php echo form_error('kode_matakuliah') ?></label>
					<?php
					$username    = $this->session->userdata['username'];
					// $sql= "SELECT kode_matakuliah, nama_matakuliah
					// 												FROM matakuliah 
					// 												WHERE jenis =(SELECT CASE WHEN semester ='1' THEN 'Ganjil'
					// 												ELSE 'Genap' END 
					// 												FROM thn_akad_semester WHERE aktif='Y')";
					// $query = $this->db->query('SELECT kode_matakuliah, nama_matakuliah
					// 												FROM matakuliah 
					// 												WHERE jenis =(SELECT CASE WHEN semester ='1' THEN 'Ganjil'
					// 												ELSE 'Genap' END 
					// 												FROM thn_akad_semester WHERE aktif='Y')');
					//$query = $this->db->query($sql);
					//$dropdowns = $query->result();
					$dropdowns = $semester_matkul;
					foreach ($dropdowns as $dropdown) {
						$dropDownList[$dropdown->kode_matakuliah] = $dropdown->nama_matakuliah;
					}
					echo  form_dropdown('kode_matakuliah', $dropDownList, $kode_matakuliah, 'class="form-control" id="kode_matakuliah"');
					?>
				</div>
				<button type="submit" class="btn btn-primary">Simpan</button>
				<a href="<?php echo site_url('krs_control/isi_krs') ?>" class="btn btn-default">Cancel</a>
			</form>