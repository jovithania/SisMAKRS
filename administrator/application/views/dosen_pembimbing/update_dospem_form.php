<script src="<?php echo base_url('assets/css/search.css') ?>"></script>

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
            <!-- Form input dan edit Dosen-->
            <legend><?php echo $button ?> Mahasiswa Bimbingan Akademik</legend>
            <form role="form" action="<?php echo site_url('dosen_pembimbing/update/' . $nidn); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="nidn" id="nidn" value="<?php echo $nidn; ?>" />

                <div class="form-group">
                    <label for="varchar">NIDN <?php echo form_error('nidn') ?></label>
                    <input type="text" class="form-control" name="nidn" id="nidn" placeholder="nidn" readonly value="<?php echo $nidn; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Nama Dosen <?php echo form_error('nama') ?></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dosen" readonly value="<?php echo $nama_dosen; ?>" />
                </div>

                <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </form> -->


                <table class="table table-bordered table table-striped" style="margin-bottom: 10px;">
                    <tr>
                        <th>NO</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $no = 1; // Nomor urut dalam menampilkan data
                    foreach ($mahasiswa_bimbingan as $mhs) {
                    ?>
                        <tr>
                            <td width="40px"><?php echo $no++; ?></td>
                            <td width="200px"><?php echo $mhs->nim; ?></td>
                            <td><?php echo $mhs->nama_mahasiswa; ?></td>
                            <td style="text-align:center" width="120px">
                                <?php
                                // Button untuk melakukan edit KRS
                                // echo anchor(
                                // 	site_url('krs/update/' . $krs->id_krs),
                                // 	'<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>'
                                // );
                                echo '&nbsp';
                                // Button untuk melakukan delete KRS
                                echo anchor(
                                    site_url('dosen_pembimbing/delete/' . $mhs->nim . '/' . $nidn),
                                    '<button type="button" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>',
                                    'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'
                                );
                                ?>
                            </td>
                        <?php
                    }
                        ?>
                        </tr>
                </table>

                <sector class="content">
                    <div class="box">
                        <div class="box-body">
                            <legend> Tambah Mahasiswa Bimbingan Akademik</legend>


                            <input id="search" name="search" type="text" placeholder="<?php echo $input ? $input : 'Masukkan NIM'; ?>" />
                            <button type="submit">Go</button>

                            <table class="table table-bordered table table-striped" style="margin-bottom: 10px;">
                                <tr>
                                    <th>NO</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                $no = 1; // Nomor urut dalam menampilkan data
                                foreach ($mahasiswa_tanpa_dospem as $mhs) {
                                ?>
                                    <tr>
                                        <td width="40px"><?php echo $no++; ?></td>
                                        <td width="200px"><?php echo $mhs->nim; ?></td>
                                        <td><?php echo $mhs->nama_mahasiswa; ?></td>
                                        <td style="text-align:center" width="120px">
                                            <?php
                                            // Button untuk melakukan edit KRS
                                            // echo anchor(
                                            // 	site_url('krs/update/' . $krs->id_krs),
                                            // 	'<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>'
                                            // );
                                            echo '&nbsp';
                                            // Button untuk melakukan delete KRS
                                            echo anchor(
                                                site_url('dosen_pembimbing/add_action/' . $mhs->nim . '/' . $nidn),
                                                '<button type="button" class="btn btn-primary"> 
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>',
                                                'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'
                                            );
                                            ?>
                                        </td>
                                    <?php
                                }
                                    ?>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </sector>

                <a href="<?php echo site_url('dosen') ?>" class="btn btn-primary">Kembali</a>
            </form>