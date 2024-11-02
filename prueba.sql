-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: avipla
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actividades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `actividad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `actividades_actividad_unique` (`actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES (2,'Comercial / Distribuidor'),(1,'Industrial / Transformador');
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `afiliado_materias_primas`
--

DROP TABLE IF EXISTS `afiliado_materias_primas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `afiliado_materias_primas` (
  `materia_prima_id` bigint unsigned NOT NULL,
  `afiliado_id` bigint unsigned NOT NULL,
  KEY `afiliado_materias_primas_materia_prima_id_foreign` (`materia_prima_id`),
  KEY `afiliado_materias_primas_afiliado_id_foreign` (`afiliado_id`),
  CONSTRAINT `afiliado_materias_primas_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `afiliado_materias_primas_materia_prima_id_foreign` FOREIGN KEY (`materia_prima_id`) REFERENCES `materias_primas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afiliado_materias_primas`
--

LOCK TABLES `afiliado_materias_primas` WRITE;
/*!40000 ALTER TABLE `afiliado_materias_primas` DISABLE KEYS */;
INSERT INTO `afiliado_materias_primas` VALUES (1,7),(2,7),(4,7);
/*!40000 ALTER TABLE `afiliado_materias_primas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `afiliado_referencias`
--

DROP TABLE IF EXISTS `afiliado_referencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `afiliado_referencias` (
  `afiliado_id` bigint unsigned NOT NULL,
  `afiliado_referencia_id` bigint unsigned NOT NULL,
  KEY `afiliado_referencias_afiliado_id_foreign` (`afiliado_id`),
  KEY `afiliado_referencias_afiliado_referencia_id_foreign` (`afiliado_referencia_id`),
  CONSTRAINT `afiliado_referencias_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `afiliado_referencias_afiliado_referencia_id_foreign` FOREIGN KEY (`afiliado_referencia_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afiliado_referencias`
--

LOCK TABLES `afiliado_referencias` WRITE;
/*!40000 ALTER TABLE `afiliado_referencias` DISABLE KEYS */;
INSERT INTO `afiliado_referencias` VALUES (7,5);
/*!40000 ALTER TABLE `afiliado_referencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `afiliados`
--

DROP TABLE IF EXISTS `afiliados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `afiliados` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `actividad_id` bigint unsigned DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siglas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anio_fundacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capital_social` decimal(8,2) DEFAULT NULL,
  `pagina_web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relacion_comercio_exterior` enum('IMPORTADOR','EXPORTADOR','AMBOS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rif_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_financiero_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registro_mercantil_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `afiliados_rif_unique` (`rif`),
  KEY `afiliados_actividad_id_foreign` (`actividad_id`),
  CONSTRAINT `afiliados_actividad_id_foreign` FOREIGN KEY (`actividad_id`) REFERENCES `actividades` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afiliados`
--

LOCK TABLES `afiliados` WRITE;
/*!40000 ALTER TABLE `afiliados` DISABLE KEYS */;
INSERT INTO `afiliados` VALUES (1,1,'logo.png','Test Empresa #0','F-000000000','FC','2001',100.00,'https://tepuy21.com','EXPORTADOR','brand.pdf','brand.pdf','brand.pdf',1,NULL,'2024-10-19 19:47:53','2024-10-19 19:47:53'),(2,1,'logo.png','Test Empresa #1','F-000000001','FC','2001',100.00,'https://tepuy21.com','EXPORTADOR','brand.pdf','brand.pdf','brand.pdf',1,NULL,'2024-10-19 19:47:53','2024-10-19 19:47:53'),(3,1,'logo.png','Test Empresa #2','F-000000002','FC','2001',100.00,'https://tepuy21.com','EXPORTADOR','brand.pdf','brand.pdf','brand.pdf',1,NULL,'2024-10-19 19:47:53','2024-10-19 19:47:53'),(4,1,'logo.png','Test Empresa #3','F-000000003','FC','2001',100.00,'https://tepuy21.com','EXPORTADOR','brand.pdf','brand.pdf','brand.pdf',1,'2024-10-24 17:11:29','2024-10-19 19:47:54','2024-10-24 17:11:29'),(5,NULL,NULL,'Agua Mineral Miranda, C.A.','J-00261969-4',NULL,'1987',NULL,NULL,'EXPORTADOR',NULL,NULL,NULL,1,NULL,'2024-10-20 07:12:49','2024-10-20 07:12:49'),(6,NULL,NULL,'Alfacocina, C.A.','J-00197352-4',NULL,'1984',NULL,NULL,'EXPORTADOR',NULL,NULL,NULL,1,NULL,'2024-10-20 07:12:49','2024-10-20 07:12:49'),(7,2,'public/brands/NSBxHO8FP3lSawnkPie2wPxGQ6iwoiFt2pMHjQbn.jpg','Homer','0000012','AVM','4234',12.00,'https://homer.com','IMPORTADOR','Fh1vfqppny54ENFKqGC343oEuYX8pHJgL7TDoVwa.pdf','Pl174AIqBGUP76b3mQ887PflJc4xm1rU7HUsuD6N.pdf','P7TfZzRDByqBx6D2SHItyWxLJ1HphgRT1IoK2U0s.pdf',1,NULL,'2024-10-26 07:51:13','2024-10-26 07:51:13');
/*!40000 ALTER TABLE `afiliados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `afiliados_servicios`
--

DROP TABLE IF EXISTS `afiliados_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `afiliados_servicios` (
  `afiliado_id` bigint unsigned NOT NULL,
  `servicio_id` bigint unsigned NOT NULL,
  KEY `afiliados_servicios_afiliado_id_foreign` (`afiliado_id`),
  KEY `afiliados_servicios_servicio_id_foreign` (`servicio_id`),
  CONSTRAINT `afiliados_servicios_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `afiliados_servicios_servicio_id_foreign` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afiliados_servicios`
--

LOCK TABLES `afiliados_servicios` WRITE;
/*!40000 ALTER TABLE `afiliados_servicios` DISABLE KEYS */;
INSERT INTO `afiliados_servicios` VALUES (7,1),(7,3);
/*!40000 ALTER TABLE `afiliados_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint unsigned NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audits`
--

LOCK TABLES `audits` WRITE;
/*!40000 ALTER TABLE `audits` DISABLE KEYS */;
INSERT INTO `audits` VALUES (1,'App\\Models\\User',1,'deleted','App\\Models\\AvisoCobro',22,'{\"id\":22,\"user_id\":1,\"afiliado_id\":2,\"estado\":\"PENDIENTE\",\"codigo_aviso\":\"JULIO2024\",\"monto_total\":\"100.00\",\"observaciones\":null,\"fecha_limite\":\"2024-07-01\"}','[]','http://avipla.test/admin/avisos-de-cobro/22','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0',NULL,'2024-10-24 17:12:13','2024-10-24 17:12:13'),(3,'App\\Models\\User',1,'created','App\\Models\\Boletine',1,'[]','{\"titulo\":\"Primera pubicacion\",\"contenido\":\"<p>rewer<\\/p>\",\"category_id\":\"2\",\"slug\":\"primera-pubicacion\",\"user_id\":1,\"id\":1}','http://avipla.test/admin/boletines','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0',NULL,'2024-10-26 07:37:13','2024-10-26 07:37:13'),(4,'App\\Models\\User',1,'updated','App\\Models\\User',1,'{\"remember_token\":\"UyimF7KEGzes2O51aeTCEZBS1dG7SFHDZZx8PX6GAZGnQB4yvSFLVRLoVTy7\"}','{\"remember_token\":\"S2yCWDknWjAVimOpr1u8n8Ubxbe8NjZYwsFuI3kou7T7aP3ZynOtWgrVW6qe\"}','http://avipla.test/admin/logout','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0',NULL,'2024-10-26 07:41:12','2024-10-26 07:41:12'),(5,'App\\Models\\User',1,'deleted','App\\Models\\AvisoCobro',30,'{\"id\":30,\"user_id\":1,\"afiliado_id\":6,\"estado\":\"PENDIENTE\",\"codigo_aviso\":\"OCTUBRE2024\",\"monto_total\":\"100.00\",\"observaciones\":null,\"fecha_limite\":null}','[]','http://avipla.test/admin/avisos-de-cobro/30','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0',NULL,'2024-10-26 08:06:07','2024-10-26 08:06:07');
/*!40000 ALTER TABLE `audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avipla_infos`
--

DROP TABLE IF EXISTS `avipla_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avipla_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `junta_directiva_anio_inicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `junta_directiva_anio_fin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avipla_infos`
--

LOCK TABLES `avipla_infos` WRITE;
/*!40000 ALTER TABLE `avipla_infos` DISABLE KEYS */;
INSERT INTO `avipla_infos` VALUES (1,'2024','2054');
/*!40000 ALTER TABLE `avipla_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aviso_cobros`
--

DROP TABLE IF EXISTS `aviso_cobros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aviso_cobros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `afiliado_id` bigint unsigned NOT NULL,
  `estado` enum('PENDIENTE','REVISION','CONCILIADO','DEVUELTO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `codigo_aviso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto_total` decimal(8,2) NOT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `fecha_limite` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aviso_cobros_user_id_foreign` (`user_id`),
  KEY `aviso_cobros_afiliado_id_foreign` (`afiliado_id`),
  CONSTRAINT `aviso_cobros_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aviso_cobros_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aviso_cobros`
--

LOCK TABLES `aviso_cobros` WRITE;
/*!40000 ALTER TABLE `aviso_cobros` DISABLE KEYS */;
INSERT INTO `aviso_cobros` VALUES (1,1,1,'PENDIENTE','FEBRERO2024',100.00,NULL,'2024-02-01',NULL,'2024-02-01 04:00:00','2024-02-01 04:00:00'),(2,1,2,'PENDIENTE','FEBRERO2024',100.00,NULL,'2024-02-01',NULL,'2024-02-01 04:00:00','2024-02-01 04:00:00'),(3,1,3,'PENDIENTE','FEBRERO2024',100.00,NULL,'2024-02-01',NULL,'2024-02-01 04:00:00','2024-02-01 04:00:00'),(4,1,4,'PENDIENTE','FEBRERO2024',100.00,NULL,'2024-02-01',NULL,'2024-02-01 04:00:00','2024-02-01 04:00:00'),(5,1,1,'PENDIENTE','MARZO2024',100.00,NULL,'2024-03-01',NULL,'2024-03-01 04:00:00','2024-03-01 04:00:00'),(6,1,2,'PENDIENTE','MARZO2024',100.00,NULL,'2024-03-01',NULL,'2024-03-01 04:00:00','2024-03-01 04:00:00'),(7,1,3,'PENDIENTE','MARZO2024',100.00,NULL,'2024-03-01',NULL,'2024-03-01 04:00:00','2024-03-01 04:00:00'),(8,1,4,'PENDIENTE','MARZO2024',100.00,NULL,'2024-03-01',NULL,'2024-03-01 04:00:00','2024-03-01 04:00:00'),(9,1,1,'PENDIENTE','ABRIL2024',100.00,NULL,'2024-04-01',NULL,'2024-04-01 04:00:00','2024-04-01 04:00:00'),(10,1,2,'PENDIENTE','ABRIL2024',100.00,NULL,'2024-04-01',NULL,'2024-04-01 04:00:00','2024-04-01 04:00:00'),(11,1,3,'PENDIENTE','ABRIL2024',100.00,NULL,'2024-04-01',NULL,'2024-04-01 04:00:00','2024-04-01 04:00:00'),(12,1,4,'PENDIENTE','ABRIL2024',100.00,NULL,'2024-04-01',NULL,'2024-04-01 04:00:00','2024-04-01 04:00:00'),(13,1,1,'PENDIENTE','MAYO2024',100.00,NULL,'2024-05-01',NULL,'2024-05-01 04:00:00','2024-05-01 04:00:00'),(14,1,2,'PENDIENTE','MAYO2024',100.00,NULL,'2024-05-01',NULL,'2024-05-01 04:00:00','2024-05-01 04:00:00'),(15,1,3,'PENDIENTE','MAYO2024',100.00,NULL,'2024-05-01',NULL,'2024-05-01 04:00:00','2024-05-01 04:00:00'),(16,1,4,'PENDIENTE','MAYO2024',100.00,NULL,'2024-05-01',NULL,'2024-05-01 04:00:00','2024-05-01 04:00:00'),(17,1,1,'PENDIENTE','JUNIO2024',100.00,NULL,'2024-06-01',NULL,'2024-06-01 04:00:00','2024-06-01 04:00:00'),(18,1,2,'PENDIENTE','JUNIO2024',100.00,NULL,'2024-06-01',NULL,'2024-06-01 04:00:00','2024-06-01 04:00:00'),(19,1,3,'PENDIENTE','JUNIO2024',100.00,NULL,'2024-06-01',NULL,'2024-06-01 04:00:00','2024-06-01 04:00:00'),(20,1,4,'PENDIENTE','JUNIO2024',100.00,NULL,'2024-06-01',NULL,'2024-06-01 04:00:00','2024-06-01 04:00:00'),(21,1,1,'PENDIENTE','JULIO2024',100.00,NULL,'2024-07-01',NULL,'2024-07-01 04:00:00','2024-07-01 04:00:00'),(22,1,2,'PENDIENTE','JULIO2024',100.00,NULL,'2024-07-01','2024-10-24 17:12:13','2024-07-01 04:00:00','2024-10-24 17:12:13'),(23,1,3,'PENDIENTE','JULIO2024',100.00,NULL,'2024-07-01',NULL,'2024-07-01 04:00:00','2024-07-01 04:00:00'),(24,1,4,'PENDIENTE','JULIO2024',100.00,NULL,'2024-07-01',NULL,'2024-07-01 04:00:00','2024-07-01 04:00:00'),(25,1,1,'PENDIENTE','OCTUBRE2024',100.00,NULL,NULL,NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),(26,1,2,'PENDIENTE','OCTUBRE2024',100.00,NULL,NULL,NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),(27,1,3,'PENDIENTE','OCTUBRE2024',100.00,NULL,NULL,NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),(28,1,4,'PENDIENTE','OCTUBRE2024',100.00,NULL,NULL,NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),(29,1,5,'PENDIENTE','OCTUBRE2024',100.00,NULL,NULL,NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),(30,1,6,'PENDIENTE','OCTUBRE2024',100.00,NULL,NULL,'2024-10-26 08:06:07','2024-10-26 07:57:15','2024-10-26 08:06:07');
/*!40000 ALTER TABLE `aviso_cobros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bancos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bancos_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` VALUES (1,'0001','BANCO CENTRAL DE VENEZUELA'),(2,'0102','BANCO DE VENEZUELA S.A.C.A. BANCO UNIVERSAL'),(3,'0104','VENEZOLANO DE CRÉDITO, S.A. BANCO UNIVERSAL'),(4,'0105','BANCO MERCANTIL, C.A. S.A.C.A. BANCO UNIVERSAL'),(5,'0108','BANCO PROVINCIAL, S.A. BANCO UNIVERSAL'),(6,'0114','BANCO DEL CARIBE, C.A. BANCO UNIVERSAL'),(7,'0115','BANCO EXTERIOR, C.A. BANCO UNIVERSAL'),(8,'0116','BANCO OCCIDENTAL DE DESCUENTO BANCO UNIVERSAL, C.A.'),(9,'0128','BANCO CARONI, C.A. BANCO UNIVERSAL'),(10,'0134','BANESCO BANCO UNIVERSAL S.A.C.A.'),(11,'0137','BANCO SOFITASA BANCO UNIVERSAL, C.A.'),(12,'0138','BANCO PLAZA, BANCO UNIVERSAL C.A.'),(13,'0146','BANCO DE LA GENTE EMPRENDEDORA BANGENTE, C.A.'),(14,'0149','BANCO DEL PUEBLO SOBERANO, BANCO DE DESARROLLO'),(15,'0151','BFC BANCO FONDO COMUN C.A. BANCO UNIVERSAL'),(16,'0157','DELSUR BANCO UNIVERSAL, C.A.'),(17,'0163','BANCO DEL TESORO, C.A. BANCO UNIVERSAL'),(18,'0166','BANCO AGRICOLA DE VENEZUELA, C.A. BANCO UNIVERSAL'),(19,'0168','BANCRECER S.A. BANCO DE DESARROLLO'),(20,'0169','MI BANCO, BANCO MICROFINANCIERO, C.A.'),(21,'0171','BANCO ACTIVO, C.A. BANCO UNIVERSAL'),(22,'0172','BANCAMIGA BANCO MICROFINANCIERO, C.A.'),(23,'0173','BANCO INTERNACIONAL DE DESARROLLO, C.A. BANCO UNIVERSAL'),(24,'0174','BANPLUS BANCO UNIVERAL, C.A.'),(25,'0175','BANCO BICENTENARIO BANCO UNIVERSAL, C.A.'),(26,'0176','NOVO BANCO, S.A. SUCURSAL VENEZUELA BANCO UNIVERSAL'),(27,'0177','BANCO DE LA FUERZA ARMADA NACIONAL BOLIVARIANA, B.U.'),(28,'0190','CITIBANK N.A.'),(29,'0191','BANCO NACIONAL CRÉDITO, C.A. BANCO UNIVERSAL');
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boletines`
--

DROP TABLE IF EXISTS `boletines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `boletines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `boletines_titulo_unique` (`titulo`),
  KEY `boletines_user_id_foreign` (`user_id`),
  KEY `boletines_category_id_foreign` (`category_id`),
  CONSTRAINT `boletines_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categoria_boletines` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `boletines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boletines`
--

LOCK TABLES `boletines` WRITE;
/*!40000 ALTER TABLE `boletines` DISABLE KEYS */;
INSERT INTO `boletines` VALUES (1,1,2,'Primera pubicacion','primera-pubicacion','<p>rewer</p>','2024-10-26 07:37:13','2024-10-26 07:37:13',NULL);
/*!40000 ALTER TABLE `boletines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carousels`
--

DROP TABLE IF EXISTS `carousels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carousels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carousels`
--

LOCK TABLES `carousels` WRITE;
/*!40000 ALTER TABLE `carousels` DISABLE KEYS */;
/*!40000 ALTER TABLE `carousels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_boletines`
--

DROP TABLE IF EXISTS `categoria_boletines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_boletines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoria_boletines_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_boletines`
--

LOCK TABLES `categoria_boletines` WRITE;
/*!40000 ALTER TABLE `categoria_boletines` DISABLE KEYS */;
INSERT INTO `categoria_boletines` VALUES (1,'Noticias','noticias'),(2,'Eventos','eventos'),(3,'Opinión','opinion'),(4,'Recursos','recursos');
/*!40000 ALTER TABLE `categoria_boletines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (2,'Motos','motos'),(3,'Bicicletas','bicicletas'),(4,'Clima','clima');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direcciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `afiliado_id` bigint unsigned NOT NULL,
  `direccion_oficina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad_oficina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_oficina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_planta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad_planta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_planta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `direcciones_afiliado_id_foreign` (`afiliado_id`),
  CONSTRAINT `direcciones_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones`
--

LOCK TABLES `direcciones` WRITE;
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
INSERT INTO `direcciones` VALUES (1,1,'Plaza Bolivar','Caracas','0412001010101','Plaza Bolivar','Caracas','0412012121333'),(2,2,'Plaza Bolivar','Caracas','0412001010101','Plaza Bolivar','Caracas','0412012121333'),(3,3,'Plaza Bolivar','Caracas','0412001010101','Plaza Bolivar','Caracas','0412012121333'),(4,4,'Plaza Bolivar','Caracas','0412001010101','Plaza Bolivar','Caracas','0412012121333'),(5,5,'Ctra. Nac. e/San Diego y San José de los Altos. Galpón Los Alpes. PB.  Sect. La Maitana. Edo. Miranda. (Agua Mineral Los Alpes)','Miranda','0412001010101','Zona Industrial Guayabal, Edif. Los Alpes. Frente a Maderas Guayabal. Guarenas. Edo. Miranda. ','Miranda','0412012121333'),(6,6,'Ctra. Petare- Santa Lucía, Cll. El Río, final de la Av. Las Palmas, Galpón Nro. 8, Boleíta Sur, Caracas. Edo. Miranda','Miranda','0412001010101','Av. Maturín y José R. Farías. Local Nro. 18 urb. Santa Cruz, Zona Industrial, Edo. Miranda. Código postal 1220','Miranda','0412012121333'),(7,7,'El Calvario, Caracas Venezuela\r\nUrbanismo el calvario','Caracas','123','El Calvario, Caracas Venezuela\r\nUrbanismo el calvario','Caracas','54754');
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pago_id` bigint unsigned NOT NULL,
  `aviso_cobro_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `numero_factura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_factura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto_total` decimal(8,2) NOT NULL,
  `invoice_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_numero_factura_unique` (`numero_factura`),
  UNIQUE KEY `invoices_codigo_factura_unique` (`codigo_factura`),
  KEY `invoices_pago_id_foreign` (`pago_id`),
  KEY `invoices_aviso_cobro_id_foreign` (`aviso_cobro_id`),
  KEY `invoices_user_id_foreign` (`user_id`),
  CONSTRAINT `invoices_aviso_cobro_id_foreign` FOREIGN KEY (`aviso_cobro_id`) REFERENCES `aviso_cobros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoices_pago_id_foreign` FOREIGN KEY (`pago_id`) REFERENCES `pagos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `junta_directiva_roles`
--

DROP TABLE IF EXISTS `junta_directiva_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `junta_directiva_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `junta_directiva_roles`
--

LOCK TABLES `junta_directiva_roles` WRITE;
/*!40000 ALTER TABLE `junta_directiva_roles` DISABLE KEYS */;
INSERT INTO `junta_directiva_roles` VALUES (1,'Presidente'),(2,'Vice presidente'),(3,'Tesorero'),(4,'Directores principales'),(5,'Director ejecutivo'),(6,'Directores secundarios');
/*!40000 ALTER TABLE `junta_directiva_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `junta_directivas`
--

DROP TABLE IF EXISTS `junta_directivas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `junta_directivas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `junta_directiva_role_id` bigint unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `junta_directivas_junta_directiva_role_id_foreign` (`junta_directiva_role_id`),
  CONSTRAINT `junta_directivas_junta_directiva_role_id_foreign` FOREIGN KEY (`junta_directiva_role_id`) REFERENCES `junta_directiva_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `junta_directivas`
--

LOCK TABLES `junta_directivas` WRITE;
/*!40000 ALTER TABLE `junta_directivas` DISABLE KEYS */;
INSERT INTO `junta_directivas` VALUES (1,3,'Camisa');
/*!40000 ALTER TABLE `junta_directivas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linea_productos`
--

DROP TABLE IF EXISTS `linea_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linea_productos` (
  `producto_id` bigint unsigned NOT NULL,
  `afiliado_id` bigint unsigned NOT NULL,
  `produccion_total_mensual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `porcentage_exportacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mercado_exportacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `linea_productos_producto_id_foreign` (`producto_id`),
  KEY `linea_productos_afiliado_id_foreign` (`afiliado_id`),
  CONSTRAINT `linea_productos_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `linea_productos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea_productos`
--

LOCK TABLES `linea_productos` WRITE;
/*!40000 ALTER TABLE `linea_productos` DISABLE KEYS */;
INSERT INTO `linea_productos` VALUES (7,7,'123123','123123','12312'),(4,7,'123123','123','213213'),(8,7,'123123','23123','213123');
/*!40000 ALTER TABLE `linea_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias_primas`
--

DROP TABLE IF EXISTS `materias_primas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias_primas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `materia_prima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias_primas`
--

LOCK TABLES `materias_primas` WRITE;
/*!40000 ALTER TABLE `materias_primas` DISABLE KEYS */;
INSERT INTO `materias_primas` VALUES (1,'Madera'),(2,'Algodón'),(3,'Tierra'),(4,'sdfsfsf');
/*!40000 ALTER TABLE `materias_primas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodos_pago`
--

DROP TABLE IF EXISTS `metodos_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodos_pago` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `metodo_pago` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodos_pago`
--

LOCK TABLES `metodos_pago` WRITE;
/*!40000 ALTER TABLE `metodos_pago` DISABLE KEYS */;
INSERT INTO `metodos_pago` VALUES (1,'Pago movil'),(2,'Transferencia'),(3,'Efectivo'),(4,'Otro');
/*!40000 ALTER TABLE `metodos_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_06_02_182949_create_actividades_table',1),(6,'2024_06_03_162110_create_afiliados_table',1),(7,'2024_06_07_140704_create_aviso_cobros_table',1),(8,'2024_06_09_175936_create_bancos_table',1),(9,'2024_06_09_175937_create_payment_methods_table',1),(10,'2024_06_09_180037_create_pagos_table',1),(11,'2024_06_10_020000_create_categories_table',1),(12,'2024_06_10_020536_create_noticias_table',1),(13,'2024_06_11_143010_create_direcciones_table',1),(14,'2024_06_11_143640_create_personal_table',1),(15,'2024_06_11_143849_create_materias_primas_table',1),(16,'2024_06_11_144008_create_afiliado_materias_primas_table',1),(17,'2024_06_11_145757_create_afiliado_referencias_table',1),(18,'2024_06_11_150123_create_productos_table',1),(19,'2024_06_11_150212_create_linea_productos_table',1),(20,'2024_06_12_133537_create_servicios_table',1),(21,'2024_06_12_133552_create_afiliados_servicios_table',1),(22,'2024_06_13_183058_create_solicitudes_afiliados_table',1),(23,'2024_06_17_180000_create_categoria_boletines_table',1),(24,'2024_06_17_180125_create_boletines_table',1),(25,'2024_06_23_045257_create_notifications_table',1),(26,'2024_06_28_130000_create_tags_table',1),(27,'2024_06_28_133653_create_tag_noticia_table',1),(28,'2024_07_04_132406_create_invoices_table',1),(29,'2024_07_04_200323_create_carousels_table',1),(30,'2024_07_07_024308_create_social_networks_table',1),(31,'2024_07_07_152849_create_organismos_table',1),(32,'2024_07_08_000000_create_junta_directiva_roles_table',1),(33,'2024_07_08_005336_create_junta_directivas_table',1),(34,'2024_07_12_181527_create_avipla_infos_table',1),(35,'2024_08_23_141513_create_audits_table',1),(36,'2024_09_26_141352_add_afiliado_to_users_table',1),(37,'2024_09_27_034422_create_permission_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(2,'App\\Models\\User',3),(2,'App\\Models\\User',4),(2,'App\\Models\\User',5),(2,'App\\Models\\User',6);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noticias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `categoria_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` enum('DRAFT','PUBLISHED','DELETED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PUBLISHED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `noticias_titulo_unique` (`titulo`),
  KEY `noticias_categoria_id_foreign` (`categoria_id`),
  KEY `noticias_user_id_foreign` (`user_id`),
  CONSTRAINT `noticias_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `noticias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES (2,3,1,'34234','34234','<p><br></p><h1>Hola</h1>','public/noticias/O9FUXq6Jl4TtUDpE62eSKdIK3b6Bo3RjmpsG824b.jpg','PUBLISHED','2024-10-26 07:33:24','2024-10-26 07:33:24');
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('2c475e31-46af-470c-afc9-17fe9b67ad76','App\\Notifications\\AvisoCobroCreated','App\\Models\\User',5,'{\"icon\":\"fas fa-exclamation-triangle\",\"bg-class\":\"bg-warning\",\"aviso_id\":28,\"codigo_aviso\":\"OCTUBRE2024\",\"url\":\"http:\\/\\/avipla.test\\/admin\\/avisos-de-cobro\\/28\",\"message\":\"Aviso de cobro #OCTUBRE2024\"}',NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),('4bb1c63d-c712-41d3-8156-54bc589ffbd5','App\\Notifications\\AvisoCobroCreated','App\\Models\\User',4,'{\"icon\":\"fas fa-exclamation-triangle\",\"bg-class\":\"bg-warning\",\"aviso_id\":27,\"codigo_aviso\":\"OCTUBRE2024\",\"url\":\"http:\\/\\/avipla.test\\/admin\\/avisos-de-cobro\\/27\",\"message\":\"Aviso de cobro #OCTUBRE2024\"}',NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),('5c9896c5-3e7d-4f2d-8111-37d1e6ea0931','App\\Notifications\\BoletinCreated','App\\Models\\User',3,'{\"icon\":\"fa fa-envelope\",\"bg-class\":\"bg-warning\",\"url\":\"http:\\/\\/avipla.test\\/admin\\/boletines\\/primera-pubicacion\",\"boletine_id\":1,\"boletine_slug\":\"primera-pubicacion\",\"titulo\":\"Primera pubicacion\",\"message\":\"Se cre\\u00f3 un nuevo boletin \\\"Primera pubicacion\\\"\"}',NULL,'2024-10-26 07:37:13','2024-10-26 07:37:13'),('62adbb2d-373b-4162-8999-afc5c04f3b7c','App\\Notifications\\BoletinCreated','App\\Models\\User',5,'{\"icon\":\"fa fa-envelope\",\"bg-class\":\"bg-warning\",\"url\":\"http:\\/\\/avipla.test\\/admin\\/boletines\\/primera-pubicacion\",\"boletine_id\":1,\"boletine_slug\":\"primera-pubicacion\",\"titulo\":\"Primera pubicacion\",\"message\":\"Se cre\\u00f3 un nuevo boletin \\\"Primera pubicacion\\\"\"}',NULL,'2024-10-26 07:37:13','2024-10-26 07:37:13'),('7556cd10-ea62-4a35-aedf-61532fad6ce4','App\\Notifications\\AvisoCobroCreated','App\\Models\\User',3,'{\"icon\":\"fas fa-exclamation-triangle\",\"bg-class\":\"bg-warning\",\"aviso_id\":26,\"codigo_aviso\":\"OCTUBRE2024\",\"url\":\"http:\\/\\/avipla.test\\/admin\\/avisos-de-cobro\\/26\",\"message\":\"Aviso de cobro #OCTUBRE2024\"}',NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),('975b09e7-e38f-454e-bf34-f27b1d0ad9f4','App\\Notifications\\AvisoCobroCreated','App\\Models\\User',2,'{\"icon\":\"fas fa-exclamation-triangle\",\"bg-class\":\"bg-warning\",\"aviso_id\":25,\"codigo_aviso\":\"OCTUBRE2024\",\"url\":\"http:\\/\\/avipla.test\\/admin\\/avisos-de-cobro\\/25\",\"message\":\"Aviso de cobro #OCTUBRE2024\"}',NULL,'2024-10-24 15:57:03','2024-10-24 15:57:03'),('a2cec734-c067-4da5-960a-529f703e83b6','App\\Notifications\\BoletinCreated','App\\Models\\User',2,'{\"icon\":\"fa fa-envelope\",\"bg-class\":\"bg-warning\",\"url\":\"http:\\/\\/avipla.test\\/admin\\/boletines\\/primera-pubicacion\",\"boletine_id\":1,\"boletine_slug\":\"primera-pubicacion\",\"titulo\":\"Primera pubicacion\",\"message\":\"Se cre\\u00f3 un nuevo boletin \\\"Primera pubicacion\\\"\"}',NULL,'2024-10-26 07:37:13','2024-10-26 07:37:13'),('d9411fe3-2200-40fc-8858-6f1ef5e45cf3','App\\Notifications\\BoletinCreated','App\\Models\\User',4,'{\"icon\":\"fa fa-envelope\",\"bg-class\":\"bg-warning\",\"url\":\"http:\\/\\/avipla.test\\/admin\\/boletines\\/primera-pubicacion\",\"boletine_id\":1,\"boletine_slug\":\"primera-pubicacion\",\"titulo\":\"Primera pubicacion\",\"message\":\"Se cre\\u00f3 un nuevo boletin \\\"Primera pubicacion\\\"\"}',NULL,'2024-10-26 07:37:13','2024-10-26 07:37:13');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organismos`
--

DROP TABLE IF EXISTS `organismos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organismos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logotipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organismos`
--

LOCK TABLES `organismos` WRITE;
/*!40000 ALTER TABLE `organismos` DISABLE KEYS */;
/*!40000 ALTER TABLE `organismos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `aviso_cobro_id` bigint unsigned NOT NULL,
  `metodo_pago_id` bigint unsigned NOT NULL,
  `banco_id` bigint unsigned DEFAULT NULL,
  `comprobante` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tasa` decimal(8,2) DEFAULT NULL,
  `monto` decimal(8,2) NOT NULL,
  `referencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_pago` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagos_aviso_cobro_id_foreign` (`aviso_cobro_id`),
  KEY `pagos_metodo_pago_id_foreign` (`metodo_pago_id`),
  KEY `pagos_banco_id_foreign` (`banco_id`),
  CONSTRAINT `pagos_aviso_cobro_id_foreign` FOREIGN KEY (`aviso_cobro_id`) REFERENCES `aviso_cobros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pagos_banco_id_foreign` FOREIGN KEY (`banco_id`) REFERENCES `bancos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pagos_metodo_pago_id_foreign` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodos_pago` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_user','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(2,'create_user','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(3,'update_user','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(4,'delete_user','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(5,'view_afiliado','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(6,'create_afiliado','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(7,'update_afiliado','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(8,'delete_afiliado','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(9,'view_role','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(10,'create_role','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(11,'update_role','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(12,'delete_role','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(13,'view_solicitud','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(14,'create_solicitud','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(15,'update_solicitud','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(16,'delete_solicitud','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(17,'view_factura','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(18,'create_factura','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(19,'update_factura','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(20,'delete_factura','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(21,'view_aviso','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(22,'create_aviso','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(23,'update_aviso','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(24,'delete_aviso','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(25,'view_noticia','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(26,'create_noticia','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(27,'update_noticia','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(28,'delete_noticia','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(29,'view_boletine','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(30,'create_boletine','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(31,'update_boletine','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(32,'delete_boletine','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(33,'view_category','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(34,'create_category','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(35,'update_category','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(36,'delete_category','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(37,'view_tag','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(38,'create_tag','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(39,'update_tag','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(40,'delete_tag','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(41,'view_category_boletine','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(42,'create_category_boletine','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(43,'update_category_boletine','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(44,'delete_category_boletine','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(45,'view_pago','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(46,'create_pago','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(47,'update_pago','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(48,'delete_pago','web','2024-10-19 19:47:52','2024-10-19 19:47:52');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `afiliado_id` bigint unsigned NOT NULL,
  `correo_presidente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_gerente_general` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_gerente_compras` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_gerente_marketing_ventas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_gerente_planta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_gerente_recursos_humanos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_administrador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_gerente_exportaciones` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_representante_avipla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_encargado_ws` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_afiliado_id_foreign` (`afiliado_id`),
  CONSTRAINT `personal_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` VALUES (1,1,'','','','','','','','','',NULL),(2,2,'','','','','','','','','',NULL),(3,3,'','','','','','','','','',NULL),(4,4,'','','','','','','','','',NULL),(5,5,'','','','','','','','','',NULL),(6,6,'','','','','','','','','',NULL),(7,7,'juan@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'23123');
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (2,'Bicicleta'),(6,'Cama'),(1,'Carro'),(7,'Disco'),(4,'Pizarra'),(3,'Teclado'),(8,'Telefono'),(5,'Tornillo');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2024-10-19 19:47:52','2024-10-19 19:47:52'),(2,'afiliado','web','2024-10-19 19:47:53','2024-10-19 19:47:53');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_servicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'Desarrollo web'),(2,'Diseño de interiores'),(3,'sdfsfsf');
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_networks`
--

DROP TABLE IF EXISTS `social_networks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_networks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_networks`
--

LOCK TABLES `social_networks` WRITE;
/*!40000 ALTER TABLE `social_networks` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_networks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes_afiliados`
--

DROP TABLE IF EXISTS `solicitudes_afiliados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitudes_afiliados` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `afiliado_id` bigint unsigned DEFAULT NULL,
  `confirmation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `solicitudes_afiliados_correo_unique` (`correo`),
  KEY `solicitudes_afiliados_afiliado_id_foreign` (`afiliado_id`),
  CONSTRAINT `solicitudes_afiliados_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes_afiliados`
--

LOCK TABLES `solicitudes_afiliados` WRITE;
/*!40000 ALTER TABLE `solicitudes_afiliados` DISABLE KEYS */;
INSERT INTO `solicitudes_afiliados` VALUES (1,'Test Empresa #0','test0@gmail.com',1,NULL,'2024-10-19 19:47:53','2024-10-19 19:47:53'),(2,'Test Empresa #1','test1@gmail.com',2,NULL,'2024-10-19 19:47:53','2024-10-19 19:47:53'),(3,'Test Empresa #2','test2@gmail.com',3,NULL,'2024-10-19 19:47:53','2024-10-19 19:47:54'),(4,'Test Empresa #3','test3@gmail.com',4,NULL,'2024-10-19 19:47:54','2024-10-19 19:47:54'),(5,'Homer','hm@gmail.com',7,NULL,'2024-10-26 07:40:43','2024-10-26 07:51:13');
/*!40000 ALTER TABLE `solicitudes_afiliados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_noticia`
--

DROP TABLE IF EXISTS `tag_noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_noticia` (
  `tag_id` bigint unsigned DEFAULT NULL,
  `noticia_id` bigint unsigned DEFAULT NULL,
  KEY `tag_noticia_tag_id_foreign` (`tag_id`),
  KEY `tag_noticia_noticia_id_foreign` (`noticia_id`),
  CONSTRAINT `tag_noticia_noticia_id_foreign` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tag_noticia_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_noticia`
--

LOCK TABLES `tag_noticia` WRITE;
/*!40000 ALTER TABLE `tag_noticia` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `afiliado_id` bigint unsigned DEFAULT NULL,
  `tipo_afiliado` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_afiliado_id_foreign` (`afiliado_id`),
  CONSTRAINT `users_afiliado_id_foreign` FOREIGN KEY (`afiliado_id`) REFERENCES `afiliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador AVIPLA','homermoncallo@gmail.com',NULL,'$2y$12$3stJuSBjkNOYTf0Uuth0Cu2tbignCQo0pRtm6O3PXvSXjez.AxEcK','S2yCWDknWjAVimOpr1u8n8Ubxbe8NjZYwsFuI3kou7T7aP3ZynOtWgrVW6qe','2024-10-19 19:47:53','2024-10-26 07:29:10',NULL,NULL,0),(2,'Test User #0','test0@gmail.com',NULL,'$2y$12$BNYWjhnMvEbAhp4beLktAeTaqzi6uLeCOZvR4dkUdlpL18pstG.hS',NULL,'2024-10-19 19:47:53','2024-10-19 19:47:53',NULL,1,0),(3,'Test User #1','test1@gmail.com',NULL,'$2y$12$5gMRO7YwgzNdd0BzP6C1jeVOJBEBLSyfXESaBBIFlYj5XP8F9v4..',NULL,'2024-10-19 19:47:53','2024-10-19 19:47:53',NULL,2,0),(4,'Test User #2','test2@gmail.com',NULL,'$2y$12$eZeDTJOPFHE4nireXr1JZu7ruqO/LcDytCb8.7ru7k50smSEbjvFm',NULL,'2024-10-19 19:47:54','2024-10-19 19:47:54',NULL,3,0),(5,'Test User #3','test3@gmail.com',NULL,'$2y$12$a/Q5lBkAAIbkyb6QH1rBQepp51Ok6bw/W9xWD1Ys7k0GKqzYAor9y',NULL,'2024-10-19 19:47:54','2024-10-19 19:47:54',NULL,4,0),(6,'HM','hm@gmail.com',NULL,'$2y$12$WRACkAUoNcdyAe5N3pLbuu8c3ceCQyfjDIml7G0EOwRUlaXQGMBBK',NULL,'2024-10-26 07:51:13','2024-10-26 07:51:13',NULL,7,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-26  0:16:15
