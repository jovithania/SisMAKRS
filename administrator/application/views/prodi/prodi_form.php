<section class="content-header">
	<h1>
		Sekolah Tinggi Teologi Tawangmangu
	</h1>
	<ol class="breadcrumb">
		<li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $back ?>">Program Studi</a></li>
		<li class="active"><?php echo $button ?> Program Studi</li>
	</ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<legend><?php echo $button ?> Program Studi</legend>
			<form role="form" class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="varchar">Id Prodi <?php echo form_error('id_prodi') ?></label>
					<input type="text" class="form-control" name="id_prodi" id="id_prodi" placeholder="Nama Prodi" value="<?php echo $id_prodi; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Nama Prodi <?php echo form_error('nama_prodi') ?></label>
					<input type="text" class="form-control" name="nama_prodi" id="nama_prodi" placeholder="Nama Prodi" value="<?php echo $nama_prodi; ?>" />
				</div>
				<input type="hidden" name="id_prodi" value="<?php echo $id_prodi; ?>" />
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
				<a href="<?php echo site_url('prodi') ?>" class="btn btn-default">Cancel</a>
			</form>