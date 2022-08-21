<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script>
	$(function() {
		$("#datepicker").datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});
</script>

<section class="content-header">
	<h1>
		Sekolah Tinggi Teologi Tawangmangu
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $back ?>">Jadwal Akademik</a></li>
		<li class="active"><?php echo $button ?> Jadwal Akademik</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-body">

			<!-- Form input dan edit Dosen-->
			<legend> Jadwal Akademik </legend>
			<form role="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

				<div class="form-group">
					<label for="varchar">Tahun Akademik</label>
					<!-- <input type="text" class="form-control" name="" id="" placeholder="" value="<?php echo $id_thn_akad; ?>" /> -->
					<?php
					$dropdowns = $thn_akademik;
					foreach ($dropdowns as $dropdown) {
						$dropDownList[$dropdown->id_thn_akad] = $dropdown->thn_akad;
					}
					echo  form_dropdown('id_thn_akad', $dropDownList, $id_thn_akad, 'class="form-control id="id_thn_akad" ');
					?>
					<!-- <input type="text" class= "form-control" name="tahun_akademik"> -->
				</div>

				<div class="form-group">
					<label for="varchar">Nama Kegiatan </label> <br><br>
					<!--  <input type="text" class="form-control" name="" id="" placeholder="" value="<?php echo $nama_kegiatan; ?>" /> -->
					<!-- <input type="radio" name="nama_kegiatan" value="Pengisian KRS" checked> Pengisian KRS
						<input type="radio" name="nama_kegiatan" value="Validasi KRS"> Validasi KRS -->
					<!-- <label class="col-sm-2" for="varchar">Nama Kegiatan </label>
           -->
					<!-- <div class="col-sm-4">
						<?php
						$pilihan = array("" => "-- Pilihan --", "Pengisian KRS", "Validasi KRS");
						echo form_dropdown('nama_kegiatan', $pilihan, 'class="form-control" id="nama_kegiatan"');
						echo form_error('nama_kegiatan');
						?>		 
					</div> -->


					<?php
					$options = array(
						'Pengisian KRS' => 'Pengisian KRS',
						'Validasi KRS'  => 'Validasi KRS',
					);
					echo form_dropdown('nama_kegiatan', $options, '', 'class="form-control" id="nama_kegiatan"');  ?>

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

				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('jadwal_control') ?>" class="btn btn-default">Cancel</a>
			</form>