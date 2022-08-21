<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN MENU</li>
            <li>
                <a href="<?php echo site_url('mahasiswa_control') ?>">
                    <i class="fa fa-graduation-cap"></i><span>Mahasiswa</span>
                </a>
            </li>

            <li>
                <a href="<?php echo site_url('dosen_control') ?>">
                    <i class="fa fa-user"></i><span>Dosen</span>
                </a>
            </li>

            <li>
                <a href="<?php echo site_url('matakuliah_control') ?>">
                    <i class="fa fa-sticky-note"></i><span>Mata Kuliah</span>
                </a>
            </li>

            <li>
                <a href="<?php echo site_url('Thn_akad_semester_control') ?>">
                    <i class="fa fa-calendar-o"></i><span>Tahun Akademik</span>
                </a>
            </li>

            <li>
                <a href="<?php echo site_url('krs_control') ?>">
                    <i class="fa fa-edit"></i><span>KRS</span>
                </a>
            </li>

            <!-- <li>
                <a href="<?php echo site_url('nilai_control') ?>">
                    <i class="fa fa-file-text "></i><span>KHS</span>
                </a>
            </li> -->

            <li>
                <a href="<?php echo site_url('nilai_control/inputNilai') ?>">
                    <i class="fa fa-sort-numeric-asc"></i><span>Input Nilai</span>
                </a>
            </li>

            <!-- <li>
                <a href="<?php echo site_url('dosen_pembimbing') ?>">
                    <i class="fa fa-user"></i><span>Dosen Pembimbing</span>
                </a>
            </li> -->

            <li>
                <a href="<?php echo site_url('jadwal_control') ?>">
                    <i class="fa fa-calendar" aria-hidden="true"></i><span>Jadwal Akademik</span>
                </a>
            </li>

            <li>
                <a href="<?php echo site_url('prodi_control') ?>">
                    <i class="fa fa-university" aria-hidden="true"></i><span>Program Studi</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>