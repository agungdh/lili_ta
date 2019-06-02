-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1	Database: lili_ta
-- ------------------------------------------------------
-- Server version 	5.5.5-10.1.38-MariaDB
-- Date: Sun, 02 Jun 2019 04:45:27 +0200

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
  `kode` varchar(191) NOT NULL,
  `tarif` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formula_tarif`
--

LOCK TABLES `formula_tarif` WRITE;
/*!40000 ALTER TABLE `formula_tarif` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `formula_tarif` VALUES (1,'15067',70000),(2,'15068',95000),(3,'15066',55000),(4,'15063',65000);
/*!40000 ALTER TABLE `formula_tarif` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `formula_tarif` with 4 row(s)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_polisi` (`nomor_polisi`),
  KEY `id_formula_tarif` (`id_formula_tarif`),
  KEY `id_pemilik_kendaraan` (`id_pemilik_kendaraan`),
  CONSTRAINT `kendaraan_ibfk_1` FOREIGN KEY (`id_formula_tarif`) REFERENCES `formula_tarif` (`id`),
  CONSTRAINT `kendaraan_ibfk_2` FOREIGN KEY (`id_pemilik_kendaraan`) REFERENCES `pemilik_kendaraan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kendaraan`
--

LOCK TABLES `kendaraan` WRITE;
/*!40000 ALTER TABLE `kendaraan` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `kendaraan` VALUES (1,1,1,'BE 2032 JC',28,28),(2,1,3,'BE 7365 CU',18,18);
/*!40000 ALTER TABLE `kendaraan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `kendaraan` with 2 row(s)
--

--
-- Table structure for table `loket`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(191) NOT NULL,
  `lokasi` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loket`
--

LOCK TABLES `loket` WRITE;
/*!40000 ALTER TABLE `loket` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `loket` VALUES (1,'1500010','Loket Depan (2)'),(2,'150009','Loket Depan (1)');
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
  `kode` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemilik_kendaraan`
--

LOCK TABLES `pemilik_kendaraan` WRITE;
/*!40000 ALTER TABLE `pemilik_kendaraan` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `pemilik_kendaraan` VALUES (1,'15002010','PT PUTRA KARO MANDIRI'),(2,'15002022','PT. PUTRA KARONA MANDIRI'),(3,'15002178','PT KURNIAWAN SIDIQ TRANS EX PUTRI'),(4,'15002995','TAXI PERORANGAN'),(5,'15002997','NON BUS PEDESAAN (KAT 2. CBG)');
/*!40000 ALTER TABLE `pemilik_kendaraan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `pemilik_kendaraan` with 5 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Sun, 02 Jun 2019 04:45:27 +0200
