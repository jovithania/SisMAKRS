<section class="content-header">
	<h1>
		Sekolah Tinggi Teologi Tawangmangu
	</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">

			<legend><?php echo $button ?> Tahun Akademik</legend>
			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="varchar">Tahun Akademik <?php echo form_error('thn_akad') ?></label>
					<input required type="text" class="form-control" name="thn_akad" id="thn_akad" placeholder="Tahun Akademik" value="<?php echo $thn_akad; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Semester <?php echo form_error('semester') ?></label>
					<div class="radio">
						<label>
							<input type="radio" name="semester" id="semester" value="1" <?php
																						echo set_value('semester', $semester) == 1 ? "checked" : "";
																						?> checked />
							Ganjil
						</label>
						<label>
							<input type="radio" name="semester" id="semester" value="2" <?php
																						echo set_value('semester', $semester) == 2 ? "checked" : "";
																						?> />
							Genap
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="varchar">Tanggal Mulai <?php echo form_error('tgl_mulai') ?></label><br><br>
					<!--  <input type="text" class="form-control" name="" id="" placeholder="" value="<?php echo $tgl_mulai; ?>" /> -->
					<!-- <input type="datetime="YYYY-MM-DDThh:mm:ssTZD"" class= "form-control" name="tgl_mulai"> -->
					<input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" required />
				</div>
				<div class="form-group">
					<label for="varchar">Tanggal Berakhir <?php echo form_error('tgl_berakhir') ?></label>
					<!-- <?php echo form_error('tgl_berakhir'); ?> -->
					<br><br>
					<!--  <input type="text" class="form-control" name="" id="" placeholder="" value="<?php echo $tgl_berakhir; ?>">	      -->
					<input type="date" class="form-control" name="tgl_berakhir" id="tgl_berakhir" required />
				</div>
				<input type="hidden" name="id_thn_akad" value="<?php echo $id_thn_akad; ?>" />
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('thn_akad_semester_control') ?>" class="btn btn-default">Cancel</a>
			</form>