-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: lili_ta
-- ------------------------------------------------------
-- Server version 	5.5.5-10.1.40-MariaDB-0ubuntu0.18.04.1
-- Date: Sat, 20 Jul 2019 10:19:41 +0700

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `formula_tarif`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formula_tarif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarif` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formula_tarif`
--

LOCK TABLES `formula_tarif` WRITE;
/*!40000 ALTER TABLE `formula_tarif` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `formula_tarif` VALUES (1,70000),(2,30000),(3,55000),(4,65000),(5,25000),(7,95000);
/*!40000 ALTER TABLE `formula_tarif` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `formula_tarif` with 6 row(s)
--

--
-- Table structure for table `karyawan`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `karyawan` (
  `nik` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `jabatan` varchar(191) NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawan`
--

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `karyawan` VALUES ('1234','Tukang nginput data','admin input'),('12345678','Boss','Boss'),('1432','gak tau apa','admin gak tau'),('masgas da','mboh opo iki','asfasf');
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `karyawan` with 4 row(s)
--

--
-- Table structure for table `kendaraan`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik_kendaraan` int(11) NOT NULL,
  `id_formula_tarif` int(11) NOT NULL,
  `nomor_polisi` varchar(191) NOT NULL,
  `seat_aktif` int(11) NOT NULL,
  `jumlah_seat` int(11) NOT NULL,
  `mulai_penagihan_bulan` int(11) NOT NULL,
  `mulai_penagihan_tahun` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_polisi` (`nomor_polisi`),
  KEY `id_formula_tarif` (`id_formula_tarif`),
  KEY `id_pemilik_kendaraan` (`id_pemilik_kendaraan`),
  CONSTRAINT `kendaraan_ibfk_1` FOREIGN KEY (`id_formula_tarif`) REFERENCES `formula_tarif` (`id`),
  CONSTRAINT `kendaraan_ibfk_2` FOREIGN KEY (`id_pemilik_kendaraan`) REFERENCES `pemilik_kendaraan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kendaraan`
--

LOCK TABLES `kendaraan` WRITE;
/*!40000 ALTER TABLE `kendaraan` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `kendaraan` VALUES (3,2,2,'BE 1337 EE',12,12,3,2018),(4,1,1,'BE 2032 JC',3,3,6,2019),(5,3,3,'BE 2059 AU',28,28,6,2019),(6,3,3,'BE 2229 AU',28,28,6,2019),(7,2,1,'BE 7966 CU',20,28,2,2018),(8,2,1,'BE 7955 CU',28,28,7,2018),(9,2,1,'BE 2620 CU',28,28,6,2019),(10,2,1,'BE 2642 CU',28,28,6,2019),(11,1,1,'BE 2089 BW',28,28,6,2019),(12,1,1,'BE 2101 BW',28,28,6,2019),(13,3,3,'BE  2289 ',28,28,6,2019),(14,3,1,'BE 2423 BU',28,28,6,2019),(15,1,1,'123123123',12412,22141241,6,2019);
/*!40000 ALTER TABLE `kendaraan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `kendaraan` with 13 row(s)
--

--
-- Table structure for table `konfigurasi`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konfigurasi` (
  `konfigurasi` varchar(191) NOT NULL,
  `value` varchar(191) NOT NULL,
  PRIMARY KEY (`konfigurasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konfigurasi`
--

LOCK TABLES `konfigurasi` WRITE;
/*!40000 ALTER TABLE `konfigurasi` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `konfigurasi` VALUES ('APP_TITLE','APP NOTIF'),('APP_TITLE_SHORT','APNT'),('APP_TITLE_SHORTER','AN'),('DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN','6'),('DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN','2019'),('ZENZIVA_API_PASS','ptt0hvy7mx'),('ZENZIVA_API_USER','ax6gro');
/*!40000 ALTER TABLE `konfigurasi` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `konfigurasi` with 7 row(s)
--

--
-- Table structure for table `log`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request` text NOT NULL,
  `respond` text NOT NULL,
  `datetime` datetime NOT NULL,
  `req_id_pemilik_kendaraan` varchar(191) NOT NULL,
  `req_nohp` varchar(191) NOT NULL,
  `req_text` text NOT NULL,
  `res_status` varchar(191) NOT NULL,
  `res_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `log` VALUES (40,'{\"id_pemilik_kendaraan\":1,\"nohp\":\"085368530235\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/085368530235\"}','{\"message\":{\"status\":\"99\",\"text\":\"Credit anda tidak mencukupi\"}}','2019-07-16 16:27:49','1','085368530235','Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/085368530235','99','Credit anda tidak mencukupi'),(41,'{\"id_pemilik_kendaraan\":2,\"nohp\":\"0853685302351\",\"text\":\"Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/0853685302351\"}','{\"message\":{\"status\":\"99\",\"text\":\"Credit anda tidak mencukupi\"}}','2019-07-16 16:27:49','2','0853685302351','Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/0853685302351','99','Credit anda tidak mencukupi'),(42,'{\"id_pemilik_kendaraan\":3,\"nohp\":\"0853685302352\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/0853685302352\"}','{\"message\":{\"status\":\"99\",\"text\":\"Credit anda tidak mencukupi\"}}','2019-07-16 16:27:49','3','0853685302352','Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/0853685302352','99','Credit anda tidak mencukupi'),(43,'{\"id_pemilik_kendaraan\":1,\"nohp\":\"085368530235\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/085368530235\"}','{\"message\":{\"status\":\"99\",\"text\":\"Credit anda tidak mencukupi\"}}','2019-07-16 16:29:05','1','085368530235','Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/085368530235','99','Credit anda tidak mencukupi'),(44,'{\"id_pemilik_kendaraan\":2,\"nohp\":\"0853685302351\",\"text\":\"Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/0853685302351\"}','{\"message\":{\"status\":\"99\",\"text\":\"Credit anda tidak mencukupi\"}}','2019-07-16 16:29:05','2','0853685302351','Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/0853685302351','99','Credit anda tidak mencukupi'),(45,'{\"id_pemilik_kendaraan\":3,\"nohp\":\"0853685302352\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/0853685302352\"}','{\"message\":{\"status\":\"99\",\"text\":\"Credit anda tidak mencukupi\"}}','2019-07-16 16:29:05','3','0853685302352','Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/0853685302352','99','Credit anda tidak mencukupi'),(46,'{\"id_pemilik_kendaraan\":1,\"nohp\":\"085368530235\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/085368530235\"}','{\"message\":{\"status\":\"99\",\"text\":\"Credit anda tidak mencukupi\"}}','2019-07-18 14:05:36','1','085368530235','Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/085368530235','99','Credit anda tidak mencukupi'),(47,'{\"id_pemilik_kendaraan\":2,\"nohp\":\"3\",\"text\":\"Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/3\"}','{\"message\":{\"status\":\"1\",\"text\":\"Nomor tujuan tidak valid\"}}','2019-07-18 14:05:37','2','3','Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/3','1','Nomor tujuan tidak valid'),(48,'{\"id_pemilik_kendaraan\":3,\"nohp\":\"2\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/2\"}','{\"message\":{\"status\":\"1\",\"text\":\"Nomor tujuan tidak valid\"}}','2019-07-18 14:05:37','3','2','Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/2','1','Nomor tujuan tidak valid'),(49,'{\"id_pemilik_kendaraan\":1,\"nohp\":\"085368530235\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/085368530235\"}','{\"message\":{\"messageId\":\"31658656\",\"to\":\"+6285368530235\",\"status\":\"0\",\"text\":\"Success\",\"balance\":\"9\"}}','2019-07-18 14:06:20','1','085368530235','Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/085368530235','0','Success'),(50,'{\"id_pemilik_kendaraan\":2,\"nohp\":\"3\",\"text\":\"Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/3\"}','{\"message\":{\"status\":\"1\",\"text\":\"Nomor tujuan tidak valid\"}}','2019-07-18 14:06:21','2','3','Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/3','1','Nomor tujuan tidak valid'),(51,'{\"id_pemilik_kendaraan\":3,\"nohp\":\"2\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost\\/lili_ta\\/cek\\/nohp\\/2\"}','{\"message\":{\"status\":\"1\",\"text\":\"Nomor tujuan tidak valid\"}}','2019-07-18 14:06:24','3','2','Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut localhost/lili_ta/cek/nohp/2','1','Nomor tujuan tidak valid'),(52,'{\"id_pemilik_kendaraan\":1,\"nohp\":\"085368530235\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut dev.lili.nyarikos.online\\/cek\\/nohp\\/085368530235\"}','{\"message\":{\"messageId\":\"31783839\",\"to\":\"+6285368530235\",\"status\":\"0\",\"text\":\"Success\",\"balance\":\"8\"}}','2019-07-20 10:19:00','1','085368530235','Anda mempunyai 4 kendaraan dengan jumlah 6 bulan yang belum dibayar. Buka link ini untuk lebih lanjut dev.lili.nyarikos.online/cek/nohp/085368530235','0','Success'),(53,'{\"id_pemilik_kendaraan\":2,\"nohp\":\"3\",\"text\":\"Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut dev.lili.nyarikos.online\\/cek\\/nohp\\/3\"}','{\"message\":{\"status\":\"1\",\"text\":\"Nomor tujuan tidak valid\"}}','2019-07-20 10:19:00','2','3','Anda mempunyai 5 kendaraan dengan jumlah 47 bulan yang belum dibayar. Buka link ini untuk lebih lanjut dev.lili.nyarikos.online/cek/nohp/3','1','Nomor tujuan tidak valid'),(54,'{\"id_pemilik_kendaraan\":3,\"nohp\":\"2\",\"text\":\"Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut dev.lili.nyarikos.online\\/cek\\/nohp\\/2\"}','{\"message\":{\"status\":\"1\",\"text\":\"Nomor tujuan tidak valid\"}}','2019-07-20 10:19:00','3','2','Anda mempunyai 4 kendaraan dengan jumlah 8 bulan yang belum dibayar. Buka link ini untuk lebih lanjut dev.lili.nyarikos.online/cek/nohp/2','1','Nomor tujuan tidak valid');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `log` with 15 row(s)
--

--
-- Table structure for table `loket`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loket`
--

LOCK TABLES `loket` WRITE;
/*!40000 ALTER TABLE `loket` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `loket` VALUES (1,'Loket Depan (2)'),(2,'Loket Depan (1)');
/*!40000 ALTER TABLE `loket` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `loket` with 2 row(s)
--

--
-- Table structure for table `pemilik_kendaraan`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemilik_kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) NOT NULL,
  `nohp` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nohp` (`nohp`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemilik_kendaraan`
--

LOCK TABLES `pemilik_kendaraan` WRITE;
/*!40000 ALTER TABLE `pemilik_kendaraan` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `pemilik_kendaraan` VALUES (1,'PT PUTRA KARO MANDIRI','085368530235'),(2,'PT. PUTRA KARONA MANDIRI','3'),(3,'PT KURNIAWAN SIDIQ TRANS EX PUTRI','2'),(4,'TAXI PERORANGAN','4'),(5,'NON BUS PEDESAAN (KAT 2. CBG)','1');
/*!40000 ALTER TABLE `pemilik_kendaraan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `pemilik_kendaraan` with 5 row(s)
--

--
-- Table structure for table `transaksi`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(191) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `id_loket` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `outstanding` int(11) NOT NULL,
  `potensi` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kendaraan` (`id_kendaraan`),
  KEY `id_loket` (`id_loket`),
  KEY `nik` (`nik`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id`),
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_loket`) REFERENCES `loket` (`id`),
  CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`nik`) REFERENCES `karyawan` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `transaksi` VALUES (2,'12345678',4,1,'2019-06-13',1234,5678,6,2019),(4,'12345678',3,2,'2019-06-18',21,123123,6,2019),(6,'12345678',8,2,'2019-06-25',4000,0,6,2019),(7,'12345678',15,1,'2019-06-26',0,0,6,2019),(8,'12345678',9,1,'2019-06-26',0,0,6,2019),(9,'12345678',3,2,'2019-06-26',0,0,3,2019),(10,'12345678',3,1,'2019-08-01',2322,0,4,2019);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `transaksi` with 7 row(s)
--

--
-- Table structure for table `user`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `level` enum('b','o') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik` (`nik`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `karyawan` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `user` VALUES (5,'12345678','$2y$10$LhbGx3LCZ0dyy23VOGkOCeFf7C7mjDMku2rvILsKOntu/M.WkzOc6','b'),(6,'1432','$2y$10$h4T4cguKFFzQA8dqhfBoXuYzI81dp.hf6v5yM43eaWJ1fqR88YeJK','b');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `user` with 2 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Sat, 20 Jul 2019 10:19:41 +0700
