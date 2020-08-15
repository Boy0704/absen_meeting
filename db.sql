/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.6.12-log : Database - absen_meeting
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`absen_meeting` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `absen_meeting`;

/*Table structure for table `absen_datang` */

DROP TABLE IF EXISTS `absen_datang`;

CREATE TABLE `absen_datang` (
  `id_absen_datang` int(11) NOT NULL AUTO_INCREMENT,
  `jam` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `foto_selfi` varchar(100) DEFAULT NULL,
  `lokasi` text,
  `status` varchar(30) DEFAULT NULL,
  `npp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_absen_datang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `absen_datang` */

/*Table structure for table `absen_pulang` */

DROP TABLE IF EXISTS `absen_pulang`;

CREATE TABLE `absen_pulang` (
  `id_absen_pulang` int(11) NOT NULL AUTO_INCREMENT,
  `jam` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `foto_selfi` varchar(100) DEFAULT NULL,
  `lokasi` text,
  `status` varchar(30) DEFAULT NULL,
  `npp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_absen_pulang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `absen_pulang` */

/*Table structure for table `alarm` */

DROP TABLE IF EXISTS `alarm`;

CREATE TABLE `alarm` (
  `id_alarm` int(11) NOT NULL AUTO_INCREMENT,
  `judul_alarm` varchar(255) DEFAULT NULL,
  `jam_alarm` time DEFAULT NULL,
  PRIMARY KEY (`id_alarm`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `alarm` */

insert  into `alarm`(`id_alarm`,`judul_alarm`,`jam_alarm`) values 
(1,'Sholat Zuhur','12:20:00'),
(2,'Tes Alarm','08:55:00'),
(3,'Rapat dimulai','09:22:50'),
(4,'istirahat rapat','09:25:00'),
(5,'Rapat Selesai','09:30:00');

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `judul_gallery` varchar(255) DEFAULT NULL,
  `foto_gallery` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `gallery` */

insert  into `gallery`(`id_gallery`,`judul_gallery`,`foto_gallery`) values 
(1,'tes gambar','gallery_1518606422.png'),
(2,'GDdfgdg','gallery_1518607119.png');

/*Table structure for table `jadwal_rundown` */

DROP TABLE IF EXISTS `jadwal_rundown`;

CREATE TABLE `jadwal_rundown` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` varchar(30) DEFAULT NULL,
  `durasi` varchar(10) DEFAULT NULL,
  `acara` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `nama_pic` varchar(50) DEFAULT NULL,
  `no_tlp` varchar(12) DEFAULT NULL,
  `hari` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jadwal_rundown` */

/*Table structure for table `materi` */

DROP TABLE IF EXISTS `materi`;

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `judul_materi` varchar(255) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `berkas` varchar(100) DEFAULT NULL,
  `waktu` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_materi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `materi` */

insert  into `materi`(`id_materi`,`judul_materi`,`nama_user`,`unit`,`berkas`,`waktu`) values 
(1,'tes file','Administrator','unit1','https://drive.google.com/open?id=1jyhRVtf50daXzJnHwecGTS2YM0injss7','19:16:52'),
(3,'Materi 1','Boy Kurniawan','unit1','https://drive.google.com/open?id=1jyhRVtf50daXzJnHwecGTS2YM0injss7','19:15:13');

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `judul_news` varchar(255) DEFAULT NULL,
  `isi_news` text,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `news` */

insert  into `news`(`id_news`,`judul_news`,`isi_news`,`gambar`) values 
(1,'Heading','<p>onec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>','foto_1518602238.png'),
(2,'Heading','<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>','foto_1518602227.png');

/*Table structure for table `set_absen` */

DROP TABLE IF EXISTS `set_absen`;

CREATE TABLE `set_absen` (
  `absen_datang` varchar(1) DEFAULT NULL,
  `absen_pulang` varchar(1) DEFAULT NULL,
  `awal_absen_datang` time DEFAULT NULL,
  `akhir_absen_datang` time DEFAULT NULL,
  `awal_absen_pulang` time DEFAULT NULL,
  `akhir_absen_pulang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `set_absen` */

insert  into `set_absen`(`absen_datang`,`absen_pulang`,`awal_absen_datang`,`akhir_absen_datang`,`awal_absen_pulang`,`akhir_absen_pulang`) values 
('t','y','07:00:00','09:00:00','18:00:00','20:00:00');

/*Table structure for table `set_lokasi` */

DROP TABLE IF EXISTS `set_lokasi`;

CREATE TABLE `set_lokasi` (
  `latlng` varchar(50) DEFAULT NULL,
  `lokasi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `set_lokasi` */

insert  into `set_lokasi`(`latlng`,`lokasi`) values 
('-1.6272483999999998,103.5676872','Jl. Hibah Ibrahim No.16, Rw. Sari, Kota Baru, Kota Jambi, Jambi 36361, Indonesia');

/*Table structure for table `unit` */

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(50) DEFAULT NULL,
  `deskripsi_unit` text,
  `alamat` text,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `unit` */

insert  into `unit`(`id_unit`,`nama_unit`,`deskripsi_unit`,`alamat`) values 
(1,'unit1','-','-'),
(2,'unit2','-','-');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `npp` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `jabatan` varchar(30) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id_user`,`npp`,`nama`,`username`,`password`,`jabatan`,`unit`,`foto`,`level`) values 
(1,'1111111','Boy Kurniawan','boy','1','manager','unit1','foto_1518184280.png','user'),
(2,'0','Administrator','admin','admin','Administrator','unit1','foto_1518184382.png','admin');

/*Table structure for table `video` */

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL AUTO_INCREMENT,
  `judul_video` varchar(255) DEFAULT NULL,
  `link_video` text,
  PRIMARY KEY (`id_video`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `video` */

insert  into `video`(`id_video`,`judul_video`,`link_video`) values 
(1,'Tes Video','https://www.youtube.com/watch?v=bEQc337KioY'),
(2,'FGD','https://www.youtube.com/watch?v=7GhyPoGxTX8');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
