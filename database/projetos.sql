CREATE DATABASE  IF NOT EXISTS `projetos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `projetos`;
-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: projetos
-- ------------------------------------------------------
-- Server version	5.7.23

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
-- Table structure for table `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) DEFAULT NULL,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedor`
--

LOCK TABLES `fornecedor` WRITE;
/*!40000 ALTER TABLE `fornecedor` DISABLE KEYS */;
INSERT INTO `fornecedor` VALUES (4,'Teste','28283774281');
/*!40000 ALTER TABLE `fornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init',1458853453);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `visualizacao_candidatos` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visualizacao_candidatos_finalizados` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visualizacao_cartas_respondidas` datetime NOT NULL,
  `administrador` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coordenador` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secretaria` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professor` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aluno` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `siape` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dataIngresso` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telcelular` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telresidencial` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unidade` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulacao` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `classe` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regime` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `turno` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idLattes` bigint(20) DEFAULT NULL,
  `formacao` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resumo` text COLLATE utf8_unicode_ci,
  `alias` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ultimaAtualizacao` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idRH` int(11) DEFAULT NULL,
  `cargo` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (78,'Usuário Todo Poderoso','878.832.797-34',NULL,'dr-kWlFrkClQ-u-D8bscat9gfqapwxKI','$2y$13$lPFaaNl2E3ZcfbNUC5VzCu5DPQ0D7MtdSGby6Djy9TIgBbtbQ5T7y',NULL,'utp@icomp.ufam.edu.br',10,NULL,NULL,'2018-09-21 11:10:56','2018-09-21 11:10:56','2018-09-21 11:10:56','1','1','1','1',NULL,'','','','','','','','','','','',NULL,NULL,NULL,'',NULL,NULL,''),(80,'David Fernandes','600.808.762-34',NULL,'LT6hrlCNFGGG7X_5h2MuyHAfYLHaImfv','$2y$13$pweiTb780XjoNOkFfFs4qeVx0J4ZSZYBmI/go6flDPJScneyR/JPy',NULL,'david@teste.com',10,'2018-09-24 13:49:24','2018-09-24 13:49:24','2018-09-24 13:49:24','2018-09-24 13:49:24','2018-09-24 13:49:24','0','0','1','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-08 17:02:48
