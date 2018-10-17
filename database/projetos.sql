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
-- Table structure for table `beneficiario`
--

DROP TABLE IF EXISTS `beneficiario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `orgao_emissor` varchar(20) DEFAULT NULL,
  `nivel_academico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beneficiario_UN` (`rg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `despesa`
--

DROP TABLE IF EXISTS `despesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor_unitario` double DEFAULT NULL,
  `qtde` int(11) DEFAULT NULL,
  `tipo_desp` tinyint(4) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `data_emissao_NF` datetime DEFAULT NULL,
  `pendencias` text,
  `numero_cheque` varchar(50) DEFAULT NULL,
  `data_pgto` datetime DEFAULT NULL,
  `nf_recibo` varchar(50) DEFAULT NULL,
  `objetivo` text,
  `id_beneficiario` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `despesa_beneficiario_FK` (`id_beneficiario`),
  KEY `despesa_fornecedor_FK` (`id_fornecedor`),
  KEY `despesa_item_FK` (`id_item`),
  CONSTRAINT `despesa_beneficiario_FK` FOREIGN KEY (`id_beneficiario`) REFERENCES `beneficiario` (`id`),
  CONSTRAINT `despesa_fornecedor_FK` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`),
  CONSTRAINT `despesa_item_FK` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `despesa_diaria`
--

DROP TABLE IF EXISTS `despesa_diaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesa_diaria` (
  `id_despesa` int(11) NOT NULL,
  `destino` varchar(200) DEFAULT NULL,
  `data_hora_volta` datetime DEFAULT NULL,
  `data_hora_ida` datetime DEFAULT NULL,
  `localizador` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_despesa`),
  CONSTRAINT `despesa_diaria_1_despesa_FK` FOREIGN KEY (`id_despesa`) REFERENCES `despesa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `despesa_passagem`
--

DROP TABLE IF EXISTS `despesa_passagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesa_passagem` (
  `id_despesa` int(11) NOT NULL,
  `data_hora_ida` datetime DEFAULT NULL,
  `data_hora_volta` datetime DEFAULT NULL,
  `destino` varchar(200) DEFAULT NULL,
  `localizador` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_despesa`),
  CONSTRAINT `despesa_passagem_despesa_FK` FOREIGN KEY (`id_despesa`) REFERENCES `despesa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `cpf_cnpj` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fornecedor_UN` (`cpf_cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `natureza` varchar(40) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `numero_item` varchar(100) DEFAULT NULL,
  `justificativa` text,
  `quantidade` int(11) DEFAULT NULL,
  `custo_unitario` double DEFAULT NULL,
  `tipo_item` tinyint(4) DEFAULT NULL,
  `descricao` text,
  `id_projeto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_projeto_FK` (`id_projeto`),
  CONSTRAINT `item_projeto_FK` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projeto`
--

DROP TABLE IF EXISTS `projeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_processo` varchar(50) DEFAULT NULL,
  `inicio_previsto` datetime DEFAULT NULL,
  `termino` datetime DEFAULT NULL,
  `nome_coordenador` varchar(200) DEFAULT NULL,
  `edital` varchar(200) DEFAULT NULL,
  `titulo_projeto` varchar(200) DEFAULT NULL,
  `num_protocolo` varchar(50) DEFAULT NULL,
  `cotacao_moeda_estrangeira` double DEFAULT NULL,
  `numero_fapeam_outorga` varchar(50) DEFAULT NULL,
  `publicacao_diario_oficial` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `receita`
--

DROP TABLE IF EXISTS `receita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receita_projeto_FK` (`id_projeto`),
  CONSTRAINT `receita_projeto_FK` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `relatorio_prestacao`
--

DROP TABLE IF EXISTS `relatorio_prestacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relatorio_prestacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_prevista` datetime DEFAULT NULL,
  `data_enviada` datetime DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `situacao` varchar(40) DEFAULT NULL,
  `tipo_anexo` tinyint(4) DEFAULT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relatorio_prestacao_projeto_FK` (`id_projeto`),
  CONSTRAINT `relatorio_prestacao_projeto_FK` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `termo_aditivo`
--

DROP TABLE IF EXISTS `termo_aditivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `termo_aditivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_do_termo` varchar(50) DEFAULT NULL,
  `motivo` text,
  `vigencia` datetime DEFAULT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `termo_aditivo_projeto_FK` (`id_projeto`),
  CONSTRAINT `termo_aditivo_projeto_FK` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-17 19:23:45
