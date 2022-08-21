<section class="content-header">
  <h1>
    Sekolah Tinggi Teologi Tawangmangu
  </h1>
</section>
<section class="content">
  <div class="box">
    <div class="box-body">

      <legend><?php echo $button ?> Dosen</legend>
      <form role="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="nidn" id="nidn" value="<?php echo $nidn; ?>" />
        <div class="form-group">
          <label for="varchar">NIDN <?php echo form_error('nidn') ?></label>
          <input type="text" class="form-control" name="nidn" id="nidn" placeholder="nidn" value="<?php echo $nidn; ?>" />
        </div>
        <div class="form-group">
          <label for="varchar">Nama Dosen <?php echo form_error('nama') ?></label>
          <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dosen" value="<?php echo $nama; ?>" />
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

        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('dosen_control') ?>" class="btn btn-default">Cancel</a>
      </form>