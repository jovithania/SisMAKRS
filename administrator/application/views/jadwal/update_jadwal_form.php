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
					<input type="text" class="form-control" readonly value="<?php echo $thn_akad ?>" />
				</div>

				<div class="form-group">
					<label for="varchar">Nama Kegiatan </label>
					<input type="text" class="form-control" readonly value="<?php echo $nama_kegiatan ?>" />

				</div>

				<div class="form-group">
					<label for="varchar">Tanggal Mulai <?php echo form_error('tgl_mulai') ?></label>
					<input required type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" value="<?php echo $tgl_mulai; ?>" />
				</div>

				<div class="form-group">
					<label for="varchar">Tanggal Berakhir <?php echo form_error('tgl_berakhir') ?></label>
					<?php echo form_error('tgl_berakhir'); ?>
					<input required type="date" class="form-control" name="tgl_berakhir" id="tgl_berakhir" value="<?php echo $tgl_berakhir; ?>" />
				</div>

				<input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" />
				<input type="hidden" name="id_thn_akad" value="<?php echo $id_thn_akad; ?>" />

				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('jadwal_control') ?>" class="btn btn-default">Cancel</a>
			</form>