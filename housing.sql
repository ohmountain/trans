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
-- Table structure for table `housing_property_rights`
--

-- DROP TABLE IF EXISTS `housing_property_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
-- CREATE TABLE `housing_property_rights` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `property_number` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '产权证书号',
--   `owner_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '户主姓名',
--   `owner_id` varchar(18) COLLATE utf8_unicode_ci NOT NULL COMMENT '户主身份证号码',
--   `owner_id_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '户主身份证号码hash',
--   `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '房屋地址',
--   `comm_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '村委会名称',
--   `comm_pp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '村委组名称',
--   `east` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '东',
--   `south` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '南',
--   `west` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '西',
--   `north` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '北',
--   `construction_area` double NOT NULL COMMENT '房屋建筑面积',
--   `house_area` double NOT NULL COMMENT '房屋占地面积',
--   `house_style` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '房屋结构',
--   `authorized_date` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '发证日期',
--   `authorized_dept` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '发证机关',
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `UNIQ_D8D1D427E8E77028` (`property_number`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_property_rights`
--

LOCK TABLES `housing_property_rights` WRITE;
/*!40000 ALTER TABLE `housing_property_rights` DISABLE KEYS */;
INSERT INTO `housing_property_rights` VALUES (1,'10092','杨秀才','522502196211282652','4dc6d2c37fe510a6a44a77840dc0dc3d681287d7863a2017db499b0bb4445cdd','凤山村','凤山村','2组','池塘','马路','马路','自家田',140.1,140.1,'砖结构','20040511','贵阳市房产局'),(2,'10100','张以华','52250219761016261X','0cb92bc5b76f7e55ce97f895057eb39cf966847612110570dac77f66992a2564','凤山村','凤山村','上寨组','池塘','马路','马路','自家田',130.43,140.43,'砖结构','20040512','贵阳市房产局'),(3,'10130','凡祥华','522502196501132652','8c6ffa68c90abfaba75b8f87126ea93bb7b47e6cf37e85654b1cc19bb1d785a6','凤山村','凤山村','高山组','池塘','马路','马路','自家田',129.1,150.1,'砖结构','20040511','贵阳市房产局');
/*!40000 ALTER TABLE `housing_property_rights` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-24 15:43:10
