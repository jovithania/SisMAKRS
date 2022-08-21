<script src="<?php echo base_url('assets/css/search.css') ?>"></script>

<section class="content-header">
    <h1>
        Sekolah Tinggi Teologi Tawangmangu
    </h1>
</section>
<section class="content">


    <div class="box">
        <div class="box-body">
            <legend><?php echo $button ?> Mahasiswa Bimbingan Akademik</legend>
            <form role="form" action="<?php echo site_url('dosen_control/update_mahasiswaBA/' . $nidn); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="nidn" id="nidn" value="<?php echo $nidn; ?>" />

                <div class="form-group">
                    <label for="varchar">NIDN <?php echo form_error('nidn') ?></label>
                    <input type="text" class="form-control" name="nidn" id="nidn" placeholder="nidn" readonly value="<?php echo $nidn; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Nama Dosen <?php echo form_error('nama') ?></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dosen" readonly value="<?php echo $nama_dosen; ?>" />
                </div>

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
                    <label for="varchar">Mahasiswa</label>
                    <?php
                    $dropdowns1 = $mahasiswa;
                    foreach ($dropdowns1 as $dropdown1) {
                        $dropDownList[$dropdown1->nim] = $dropdown1->nama_lengkap;
                    }
                    echo  form_dropdown('nim', $dropDownList, $nim, 'class="form-control id="nim" ');
                    ?>
                    <!-- <input type="text" class= "form-control" name="tahun_akademik"> -->
                </div>

                <!-- 
                <table class="table table-bordered table table-striped" style="margin-bottom: 10px;">
                    <tr>
                        <th>NO</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($mahasiswa_bimbingan as $mhs) {
                    ?>
                        <tr>
                            <td width="40px"><?php echo $no++; ?></td>
                            <td width="200px"><?php echo $mhs->nim; ?></td>
                            <td><?php echo $mhs->nama_mahasiswa; ?></td>
                            <td style="text-align:center" width="120px">
                                <?php
                                echo '&nbsp';
                                echo anchor(
                                    site_url('dosen_control/delete_mahasiswaBA/' . $mhs->nim . '/' . $nidn),
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
                </table> -->
                <!-- 
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
                                $no = 1;
                                foreach ($mahasiswa_tanpa_dospem as $mhs) {
                                ?>
                                    <tr>
                                        <td width="40px"><?php echo $no++; ?></td>
                                        <td width="200px"><?php echo $mhs->nim; ?></td>
                                        <td><?php echo $mhs->nama_mahasiswa; ?></td>
                                        <td style="text-align:center" width="120px">
                                            <?php
                                            echo '&nbsp';
                                            echo anchor(
                                                site_url('dosen_control/add_mahasiswaBA/' . $mhs->nim . '/' . $nidn),
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
                </sector> -->

                <a href="<?php echo site_url('dosen_control') ?>" class="btn btn-primary pull-right">Simpan</a>
                <a href="<?php echo site_url('dosen_control') ?>" class="btn btn-primary">Kembali</a>
            </form>