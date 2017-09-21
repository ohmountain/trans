-- MySQL dump 10.13  Distrib 5.7.19, for macos10.12 (x86_64)
--
-- Host: localhost    Database: niwo
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `land_block`
--

DROP TABLE IF EXISTS `land_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `land_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `block_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block_area` double NOT NULL,
  `block_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block_coordinate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block_shape` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usage_status` smallint(6) NOT NULL,
  `contract_id_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6130190D7E3C61F9` (`owner_id`),
  CONSTRAINT `FK_6130190D7E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `land_rights` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land_block`
--

LOCK TABLES `land_block` WRITE;
/*!40000 ALTER TABLE `land_block` DISABLE KEYS */;
INSERT INTO `land_block` VALUES (1,6,'地块1',4,'田','1000','X24534342.120,Y34343434.309','方形',2,'4f1ac8102e52f0f0a887d1c7e52543ddda0721a466bfd6ca9f5c968a5daa7f66'),(2,5,'地块2',2,'田','1001','X24534342.120,Y34343434.309','方形',2,'12cc2c765efcd8603728e3ee3a57587c084aa02ea06717a0ae87815b2cc74029'),(3,4,'地块3',0.83,'田','1002','X24534342.120,Y34343434.309','方形',2,'40ace6cfc913f3db4c8f980910844704cd7c0e9ce4020396529e7fb71bc0ea8e'),(4,4,'地块4',0.14,'地','1003','X24534342.120,Y34343434.309','方形',2,'4486d5347ee4541c5ca53e281711797164595598e2c53685af56425b51ebb99d'),(5,5,'地块5',0.75,'地','1004','X24534342.120,Y34343434.309','方形',2,'7b7a6cc318e0f077fe11dca19985fdd79971c592248c2f2bdff7f888b0cff62a'),(6,4,'地块6',3,'田','1005','X24534342.120,Y34343434.309','方形',2,'0aeba8f1abe5b4b26f3b2aa531953490d448a153ef2e8999602edcafe9554b37'),(7,4,'地块7',0.4,'地','1006','X24534342.120,Y34343434.309','方形',2,'7f17e17fe5fdd27b52c986bfd71f8cccf91f058e1a76821856d7ff5ebe13048d'),(8,5,'地块8',1,'田','1007','X24534342.120,Y34343434.309','方形',2,'09124e172e0842a0e08f919e1d00ada31c1c03f4495b7b51807b98a55b240c0d'),(9,5,'地块9',0.88,'田','1008','X24534342.120,Y34343434.309','方形',2,'7176a3e86583df4da4dc56a43f4d89b5ca981cd2f1bdd5b331b099485903ecab'),(10,4,'地块10',2,'田','1009','X24534342.120,Y34343434.309','方形',2,'28477e81aaa4f0a3593afac99010b6cefd6a7c75d709805a7f1e6f7abc6c92d5'),(11,5,'地块11',0.1,'地','1010','X24534342.120,Y34343434.309','方形',2,'2aebb18024467af4b48f2982f5ff12da39a734db3eed4ab476e6c3cce1f5de68'),(12,6,'地块12',1.17,'地','1011','X24534342.120,Y34343434.309','方形',2,'6800ede3a31239b35f8773e13e593b4bda4843028ce5f5e4aaedd10c85ca0041'),(13,5,'地块13',1.6,'地','1012','X24534342.120,Y34343434.309','方形',2,'9271b928d0d33544b95cdbff9f2852402b2882e0e8b2ee356c9088733edc794f'),(14,5,'地块14',1,'地','1013','X24534342.120,Y34343434.309','方形',2,'1345748b1890e78aca768ea643eae2b0ba5cf103fcea63a9964cf3d12f84e9a3'),(15,6,'地块15',0.5,'地','1014','X24534342.120,Y34343434.309','方形',2,'91928737b43bc32f97a43540af6a1b41c7228d5ec7888d8e5aed412c0dd528f6');
/*!40000 ALTER TABLE `land_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land_rights`
--

DROP TABLE IF EXISTS `land_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `land_rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comm_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comm_pp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_sid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `family_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `family_gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `family_sid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land_rights`
--

LOCK TABLES `land_rights` WRITE;
/*!40000 ALTER TABLE `land_rights` DISABLE KEYS */;
INSERT INTO `land_rights` VALUES (4,'凤山村','2组','4672','姜鑫鑫','男','15950596914','320601198812280336','姜某某','男','320601201812280336','朋友'),(5,'凤山村','3组','6212','杨文丽','女','15616322910','522631199410263121','杨某某','女','522631201812280336','朋友'),(6,'凤山村','4组','5549','赵甜甜','女','18685014939','522101198608297626','赵某某','女','522101201812280336','朋友');
/*!40000 ALTER TABLE `land_rights` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-21 18:05:16
