/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.1.38-MariaDB : Database - sima_krs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sima_krs` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sima_krs`;

/*Table structure for table `dosen` */

DROP TABLE IF EXISTS `dosen`;

CREATE TABLE `dosen` (
  `nidn` varchar(15) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dosen` */

insert  into `dosen`(`nidn`,`nama`,`alamat`,`jenis_kelamin`,`email`,`telp`) values 
('130297','Kharisma  Dian Febrianti','Kabupaten Malang, Jawa Timur','Perempuan','kharisma.dian@gmail.com','081230650287'),
('210196','Elika Felicia','Solo, Jawa Tengah','perempuan','ela.f@gmail.com','087643278965');

/*Table structure for table `dospem` */

DROP TABLE IF EXISTS `dospem`;

CREATE TABLE `dospem` (
  `id_dospem` int(10) NOT NULL AUTO_INCREMENT,
  `id_thn_akad` int(10) DEFAULT NULL,
  `nidn` varchar(15) NOT NULL,
  `nim` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_dospem`),
  KEY `nim` (`nim`),
  KEY `nidn` (`nidn`),
  KEY `id_thn_akad` (`id_thn_akad`),
  CONSTRAINT `dospem_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  CONSTRAINT `dospem_ibfk_2` FOREIGN KEY (`nidn`) REFERENCES `dosen` (`nidn`),
  CONSTRAINT `dospem_ibfk_3` FOREIGN KEY (`id_thn_akad`) REFERENCES `thn_akad_semester` (`id_thn_akad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `dospem` */

insert  into `dospem`(`id_dospem`,`id_thn_akad`,`nidn`,`nim`) values 
(1,NULL,'210196','2017010015'),
(2,NULL,'130297','2017010012');

/*Table structure for table `index_prestasi` */

DROP TABLE IF EXISTS `index_prestasi`;

CREATE TABLE `index_prestasi` (
  `nim` varchar(15) DEFAULT NULL,
  `ips` double DEFAULT NULL,
  KEY `nim` (`nim`),
  CONSTRAINT `index_prestasi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `index_prestasi` */

insert  into `index_prestasi`(`nim`,`ips`) values 
('2017010012',3);

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_thn_akad` int(10) DEFAULT NULL,
  `nama_kegiatan` varchar(50) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_berakhir` datetime NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_thn_akad` (`id_thn_akad`),
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_thn_akad`) REFERENCES `thn_akad_semester` (`id_thn_akad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jadwal` */

insert  into `jadwal`(`id_jadwal`,`id_thn_akad`,`nama_kegiatan`,`tgl_mulai`,`tgl_berakhir`) values 
(1,13,'Pengisian KRS','2022-08-01 00:00:00','2022-08-31 00:00:00'),
(2,13,'Validasi KRS','2022-08-01 00:00:00','2022-08-30 00:00:00'),
(4,14,'Pengisian KRS','2022-08-01 00:00:00','2022-08-31 00:00:00'),
(5,14,'Validasi KRS','2022-08-01 00:00:00','2022-08-31 00:00:00');

/*Table structure for table `khs` */

DROP TABLE IF EXISTS `khs`;

CREATE TABLE `khs` (
  `id_thn_akad` int(10) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `kode_matkul` varchar(15) NOT NULL,
  `nilai` varchar(2) NOT NULL,
  `konversi` double NOT NULL,
  `sks` int(11) NOT NULL,
  KEY `id_thn_akad` (`id_thn_akad`),
  CONSTRAINT `khs_ibfk_1` FOREIGN KEY (`id_thn_akad`) REFERENCES `thn_akad_semester` (`id_thn_akad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `khs` */

insert  into `khs`(`id_thn_akad`,`nim`,`kode_matkul`,`nilai`,`konversi`,`sks`) values 
(13,'2017010012','02.02.03.1.2019','A',4,3),
(13,'2017010012','02.01.01.1.2019','A',4,2),
(13,'2017010012','02.01.03.1.2019','A',4,2),
(13,'2017010012','02.01.09.1.2019','A',4,3),
(13,'2017010012','02.01.11.1.2019','C',2,2),
(13,'2017010012','02.02.01.1.2019','D',1,3),
(13,'2017010012','02.02.02.1.2019','C',2,3),
(13,'2017010012','02.04.09.1.2019','B',3,3),
(14,'2017010012','02.01.02.2.2019','0',0,2),
(14,'2017010012','02.01.04.6.2019','0',0,3),
(14,'2017010012','02.02.04.2.2019','0',0,3),
(14,'2017010012','02.03.02.4.2019','0',0,2),
(14,'2017010012','02.02.11.2.2019','0',0,3),
(14,'2017010012','02.02.10.2.2019','0',0,3);

/*Table structure for table `krs` */

DROP TABLE IF EXISTS `krs`;

CREATE TABLE `krs` (
  `id_krs` int(10) NOT NULL AUTO_INCREMENT,
  `id_thn_akad` int(10) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `kode_matakuliah` varchar(15) NOT NULL,
  PRIMARY KEY (`id_krs`),
  KEY `id_thn_akad` (`id_thn_akad`),
  KEY `kode_matakuliah` (`kode_matakuliah`),
  KEY `nim` (`nim`),
  CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`id_thn_akad`) REFERENCES `thn_akad_semester` (`id_thn_akad`),
  CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`kode_matakuliah`) REFERENCES `matakuliah` (`kode_matakuliah`),
  CONSTRAINT `krs_ibfk_3` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `krs` */

insert  into `krs`(`id_krs`,`id_thn_akad`,`nim`,`kode_matakuliah`) values 
(14,13,'2017010012','02.02.03.1.2019'),
(18,13,'2017010012','02.01.01.1.2019'),
(25,13,'2017010012','02.01.03.1.2019'),
(26,13,'2017010012','02.01.09.1.2019'),
(27,13,'2017010012','02.01.11.1.2019'),
(28,13,'2017010012','02.02.01.1.2019'),
(29,13,'2017010012','02.02.02.1.2019'),
(30,13,'2017010012','02.04.09.1.2019'),
(37,14,'2017010012','02.01.02.2.2019'),
(38,14,'2017010012','02.01.04.6.2019'),
(39,14,'2017010012','02.02.04.2.2019'),
(40,14,'2017010012','02.03.02.4.2019'),
(41,14,'2017010012','02.02.11.2.2019'),
(42,14,'2017010012','02.02.10.2.2019'),
(45,13,'2017010015','02.02.03.1.2019'),
(46,13,'2017010015','02.01.01.1.2019'),
(47,13,'2017010015','02.01.03.1.2019'),
(48,13,'2017010015','02.01.09.1.2019'),
(49,13,'2017010015','02.01.11.1.2019'),
(50,13,'2017010015','02.02.01.1.2019'),
(51,13,'2017010015','02.02.02.1.2019'),
(52,13,'2017010015','02.04.09.1.2019');

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  PRIMARY KEY (`nim`),
  KEY `id_prodi` (`id_prodi`),
  CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`nim`,`nama_lengkap`,`alamat`,`email`,`telp`,`jenis_kelamin`,`id_prodi`) values 
('2017010012','Jovita Nathania Tunliu','Tawangmangu, Karanganyar, Jawa Tengah','jovita@gmail.com','098436223211','P',2),
('2017010015','Heri Setiawan','Jakarta Selatan','heri.s@gmail.com','0812876586431','L',2),
('2017010016','Davin Ega P','Kota Malang','Dabin@gmail.com','086787654321','L',2);

/*Table structure for table `matakuliah` */

DROP TABLE IF EXISTS `matakuliah`;

CREATE TABLE `matakuliah` (
  `kode_matakuliah` varchar(15) NOT NULL,
  `nama_matakuliah` varchar(100) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `kode_prasyarat` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_matakuliah`),
  KEY `id_prodi` (`id_prodi`),
  CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matakuliah` */

insert  into `matakuliah`(`kode_matakuliah`,`nama_matakuliah`,`sks`,`semester`,`jenis`,`id_prodi`,`kode_prasyarat`) values 
('02.01.01.1.2019','PENDIDIKAN KEWARGANEGARAAN',2,1,'Ganjil',2,''),
('02.01.02.2.2019','KOMUNIKASI',2,2,'Genap',2,''),
('02.01.03.1.2019','BAHASA INDONESIA',2,1,'Ganjil',2,''),
('02.01.04.6.2019','FILSAFAT DAN LOGIKA',3,6,'Genap',2,''),
('02.01.05.7.2019','METODOLOGI PENELITIAN SOSIAL DAN TINDAKAN KELAS',2,7,'Ganjil',2,''),
('02.01.06.4.2019','PSIKOLOGI KRISTEN',2,4,'Genap',2,''),
('02.01.07.3.2019','ANTROPOLOGI BUDAYA DAN SOSIAL',2,3,'Ganjil',2,''),
('02.01.08.5.2019','PELAYANAN ANAK, REMAJA DAN PEMUDA',3,5,'Ganjil',2,''),
('02.01.09.1.2019','PENDIDIKAN KARAKTER 1',3,1,'Ganjil',2,''),
('02.01.10.2.2019','PENDIDIKAN KARAKTER 2',3,2,'Genap',2,'02.01.09.1.2019'),
('02.01.11.1.2019','PANCASILA',2,1,'Ganjil',2,''),
('02.02.01.1.2019','PEMBIMBING DAN PENGETAHUAN PL 1',3,1,'Ganjil',2,''),
('02.02.02.1.2019','PEMBIMBING DAN PENGETAHUAN PB 1',3,1,'Ganjil',2,''),
('02.02.03.1.2019','BAHASA IBRANI',3,1,'Ganjil',2,''),
('02.02.04.2.2019','BAHASA YUNANI',3,2,'Genap',2,''),
('02.02.05.3.2019','HERMENEUTIKA',3,3,'Ganjil',2,''),
('02.02.06.3.2019','TAFSIR PERJANJIAN LAMA 1',3,3,'Ganjil',2,''),
('02.02.07.3.2019','TAFSIR PERJANJIAN BARU 1',3,3,'Ganjil',2,''),
('02.02.08.4.2019','TAFSIR PERJANJIAN LAMA 2',3,4,'Genap',2,'02.02.06.3.2019'),
('02.02.09.4.2019','TAFSIR PERJANJIAN BARU 2',3,4,'Genap',2,'02.02.07.3.2019'),
('02.02.10.2.2019','PEMBIMBING DAN PENGETAHUAN PL 2',3,2,'Genap',2,'02.02.01.1.2019'),
('02.02.11.2.2019','PEMBIMBING DAN PENGETAHUAN PB 2',3,2,'Genap',2,'02.02.02.1.2019'),
('02.02.11.3.2019','TEORI-TEORI BELAJAR DAN PENERAPANNYA DALAM PAK 1',3,3,'Ganjil',2,''),
('02.02.12.5.2019','KONSELING KRISTEN',3,5,'Ganjil',2,''),
('02.03.01.4.2019','SEJARAH GEREJA UMUM DAN INDONESIA',3,4,'Genap',2,''),
('02.03.02.4.2019','OUKUMENIKA',2,4,'Genap',2,''),
('02.03.03.7.2019','KEPEMIMPINAN KRISTEN DAN KELUARGA KRISTEN',3,7,'Ganjil',2,''),
('02.03.05.5.2019','PAK DALAM MASYARAKAT PLURALIS',2,5,'Ganjil',2,''),
('02.03.06.4.2019','LITURGIKA',2,4,'Genap',2,''),
('02.03.07.2.2019','HOMELITIKA',3,2,'Genap',2,''),
('02.03.08.5.2019','KODE ETIK DAN PROFESIONALISMEGURU PAK',3,5,'Ganjil',2,''),
('02.03.09.5.2019','PRAKTIK PERENCANAAN PAK',3,5,'Ganjil',2,''),
('02.04.01.2.2019','TEOLOGI SISTEMATIKA 1',3,2,'Genap',2,''),
('02.04.02.3.2019','TEOLOGI SISTEMATIKA 2',3,3,'Ganjil',2,'02.04.01.2.2019'),
('02.04.03.5.2019','ETIKA KRISTEN',3,5,'Ganjil',2,''),
('02.04.04.3.2019','TEOLOGI DAN MISI KONTEKSTUAL',3,3,'Ganjil',2,''),
('02.04.05.5.2019','TEOLOGI PERJANJIAN LAMA 1',3,5,'Ganjil',2,''),
('02.04.06.7.2019','TEOLOGI PERJAJIAN LAMA 2',3,7,'Ganjil',2,'02.04.05.5.2019'),
('02.04.07.6.2019','TEOLOGI PERJANJIAN BARU 1',3,6,'Genap',2,''),
('02.04.08.7.2019','TEOLOGI PERJAJIAN BARU 2',3,7,'Ganjil',2,'02.04.07.6.2019'),
('02.04.09.1.2019','PUJIAN DAN PENYEMBAHAN',3,1,'Ganjil',2,''),
('02.04.10.2.2019','DASAR-DASAR KEPENDIDIKAN',3,2,'Genap',2,''),
('02.04.12.4.2019','STRATEGI PEMBELAJARAN PAK',3,4,'Genap',2,''),
('02.04.13.4.2019','PERANCANAAN PEMBELAJARAN PAK',3,4,'Genap',2,''),
('02.04.14.5.2019','PSIKOLOGI PENDIDIKAN',2,5,'Ganjil',2,''),
('02.04.15.7.2019','PSIKOLOGI PERKEMBANGAN DAN BIMBINGAN PESERTA DIDIK',3,7,'Ganjil',2,''),
('02.04.16.7.2019','TEKNOLOGI DAN MEDIA PEMBELAJARAN PAK',3,7,'Ganjil',2,''),
('02.04.17.7.2019','EVALUASI PEMBELAJARAN PAK',3,7,'Ganjil',2,''),
('02.05.01.6.2019','PRAKTEK KULIAH LAPANGAN',6,6,'Genap',2,''),
('02.05.02.8.2019','SKRIPSI',6,8,'Genap',2,'');

/*Table structure for table `prodi` */

DROP TABLE IF EXISTS `prodi`;

CREATE TABLE `prodi` (
  `id_prodi` int(10) NOT NULL AUTO_INCREMENT,
  `nama_prodi` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_prodi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `prodi` */

insert  into `prodi`(`id_prodi`,`nama_prodi`) values 
(1,'Teologi'),
(2,'Pendidikan Agama Kristen');

/*Table structure for table `thn_akad_semester` */

DROP TABLE IF EXISTS `thn_akad_semester`;

CREATE TABLE `thn_akad_semester` (
  `id_thn_akad` int(10) NOT NULL AUTO_INCREMENT,
  `thn_akad` varchar(9) NOT NULL,
  `semester` varchar(1) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_berakhir` datetime NOT NULL,
  PRIMARY KEY (`id_thn_akad`),
  KEY `id_thn_akad` (`id_thn_akad`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `thn_akad_semester` */

insert  into `thn_akad_semester`(`id_thn_akad`,`thn_akad`,`semester`,`aktif`,`tgl_mulai`,`tgl_berakhir`) values 
(13,'2019/2020','1','Y','2022-08-08 18:48:08','2022-08-09 18:48:13'),
(14,'2019/2020','2','T','0000-00-00 00:00:00','2022-08-08 19:41:49'),
(17,'2021/2022','1','T','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `id_session` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`username`,`password`,`level`,`id_session`) values 
('130297','ee497ba421d4208a8fdbe14b1f8cf5bd','dosen',NULL),
('2017010012','f142e423c15ee9c8236293eb78528eb3','mahasiswa','f142e423c15ee9c8236293eb78528eb3'),
('admin','21232f297a57a5a743894a0e4a801fc3','administrator',NULL),
('2017010015','e2fa69f219ba22a2d6a7b6bb34671f6b','mahasiswa',NULL),
('210196','b9cf343ac5bfead1f0ef00ae04866ffc','dosen',NULL),
('2017010016','8e861d70919e5f751a096d916c8849a1','mahasiswa',NULL);

/*Table structure for table `validasi` */

DROP TABLE IF EXISTS `validasi`;

CREATE TABLE `validasi` (
  `nim` varchar(15) DEFAULT NULL,
  `nidn` varchar(15) DEFAULT NULL,
  `id_thn_akad` int(10) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  KEY `nim` (`nim`),
  KEY `nidn` (`nidn`),
  KEY `id_thn_akad` (`id_thn_akad`),
  CONSTRAINT `validasi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  CONSTRAINT `validasi_ibfk_2` FOREIGN KEY (`nidn`) REFERENCES `dosen` (`nidn`),
  CONSTRAINT `validasi_ibfk_3` FOREIGN KEY (`id_thn_akad`) REFERENCES `thn_akad_semester` (`id_thn_akad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `validasi` */

insert  into `validasi`(`nim`,`nidn`,`id_thn_akad`,`status`) values 
('2017010012','130297',14,'Y'),
('2017010015','210196',13,'T');

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `aktif_thn_akad` */

/*!50106 DROP EVENT IF EXISTS `aktif_thn_akad`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `aktif_thn_akad` ON SCHEDULE EVERY 1 DAY STARTS '2022-08-08 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
        DECLARE cek INT;
	SELECT id_thn_akad INTO cek FROM THN_AKAD_SEMESTER WHERE DATE_FORMAT (TGL_MULAI, "%Y-%m-%d") = CURDATE();              
            UPDATE thn_akad_semester SET aktif = 'Y' WHERE id_thn_akad = cek;
    END */$$
DELIMITER ;

/* Event structure for event `nonaktif_thn_akad` */

/*!50106 DROP EVENT IF EXISTS `nonaktif_thn_akad`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `nonaktif_thn_akad` ON SCHEDULE EVERY 1 DAY STARTS '2022-08-08 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN   
            UPDATE thn_akad_semester SET aktif = 'T' WHERE DATE_FORMAT (TGL_BERAKHIR, "%Y-%m-%d") <= CURDATE(); 
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
