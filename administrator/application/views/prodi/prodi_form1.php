<section class="content-header">
    <h1>
        Sekolah Tinggi Teologi Tawangmangu
    </h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-body">
            <legend><?php echo $button ?> Mahasiswa</legend>
            <form role="form" class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <!-- <div class="form-group">
                    <div class="col-sm-4">
                        <label for="varchar">Id Prodi <?php echo form_error('id_prodi') ?></label>
                        <input type="text" class="form-control" name="id_prodi" id="id_prodi" placeholder="Nama Prodi" value="<?php echo $id_prodi; ?>" />
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="col-sm-10">
                        <label for="varchar">Nama Prodi <?php echo form_error('nama_prodi') ?></label>
                        <input required type="text" class="form-control" name="nama_prodi" id="nama_prodi" placeholder="Nama Prodi" value="<?php echo $nama_prodi; ?>" />
                    </div>
                </div>

                <input type="hidden" name="id_prodi" value="<?php echo $id_prodi; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('prodi_control') ?>" class="btn btn-default">Cancel</a>
            </form>