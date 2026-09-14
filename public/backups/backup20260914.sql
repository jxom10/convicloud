/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.20-12.3.3-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: convicloud
-- ------------------------------------------------------
-- Server version	12.3.3-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `actor_casos`
--

DROP TABLE IF EXISTS `actor_casos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `actor_casos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_caso` bigint(20) unsigned NOT NULL,
  `id_alumno` bigint(20) unsigned NOT NULL,
  `rol` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `actor_casos_id_caso_foreign` (`id_caso`),
  KEY `actor_casos_id_alumno_foreign` (`id_alumno`),
  CONSTRAINT `actor_casos_id_alumno_foreign` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`),
  CONSTRAINT `actor_casos_id_caso_foreign` FOREIGN KEY (`id_caso`) REFERENCES `casos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actor_casos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `actor_casos` WRITE;
/*!40000 ALTER TABLE `actor_casos` DISABLE KEYS */;
/*!40000 ALTER TABLE `actor_casos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nia` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido1` varchar(255) NOT NULL,
  `apellido2` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `grupo` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES
(1,'11537294','Samuel','Abellán','García','1970-01-01','1ESO','C','E',1,'2026-08-28 16:43:03','2026-09-14 19:05:33'),
(2,'11536011','Oriana','Achau','Belda','1970-01-01','1ESO','C','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(3,'11542861','PAULA','ADAME','BOEGEL','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(4,'11467129-12','Dylan Alejandro','Aguilera','Sabogal','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(5,'321546','MONICA','AGUIRRECHE','CANTO','1970-01-01','1ESO','B','E',1,'2026-08-28 16:43:03','2026-09-14 18:47:49'),
(6,'11535040','IGNACIO','ALARCÓN','GALLEGO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(7,'13528359','Rafael','Amaya','Atencio','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(8,'11532717','ALTEA','APARICIO','ARCINIEGAS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(9,'','YAZMIN NOEMI','AREVALOS','ALONSO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(10,'','DULCE MARIA','ARIAS','ERAS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(11,'11573419','JUDITH GLORIA','ASISTIRI','SEBASTIA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(12,'','SABA','ATILLA','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(13,'BD934320','Dayanna Alexandra','Avendaño','Ojeda','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(14,'','TEO','BARCO','BALDEZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(15,'','DARA','BARCOS','LEÓN','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(16,'','WAEL ANAS','BELBACHIR','BIRLANGA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(17,'','ABDELHAMID','BELBACHIR','ILYES','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(18,'11437599','Ángel','Benavent','Diaz','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(19,'11810009','ANDREW','BOTELLO','SERNA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(20,'','CAROLINA','BULO','MADISON','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(21,'','TIFFANY ANDREA','BUSTAMANTE','GARCÍA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(22,'','SALOME','CANO','SALAS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(23,'','XIMENA','CASTILLO','RAMÍREZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(24,'Y9605146S','Oleksandr','Chaika','Sin apellido','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(25,'','TANIA','CIOTEC','LOPATA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(26,'11521167','CEANA DALGLIESH','CLARKE','RODAS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(27,'11531043','Elena','Córdova','Marín','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(28,'11532288','Victoria Leticia','Corona','Costa','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(29,'11508747','Víctor David','Correa','Pochev','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(30,'','ISABELLA ANTONIA','CRESPO','ALEGRE','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(31,'11521884','Justin José','Cumbicus','Garrido','2012-10-30','1ESO','A','O',1,'2026-08-28 16:43:03','2026-09-14 19:25:38'),
(32,'11532502','Ainara','David','Vicente','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(33,'','AITANA','DE SILVA','BELTRA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(34,'','Kyra','Del Pino','Poblet','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(35,'11522858','Mayte','Diazgranados','Parsons','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(36,'','OWEN DANIEL','ENCISO','PEREIRA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(37,'','MICHAEL ARMANDO','FERNÁNDEZ','GALEANO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(38,'','JOAN','FERRER','CONGOST','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(39,'11527926','LAIA','GALÁN','FELIU','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(40,'11540954','Gabriela','García','Machicela','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(41,'11537812','MARCO','GARCIA','MONERRIS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(42,'11537827','Lope','García','Rey','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:03','2026-08-28 16:43:03'),
(43,'11545658','Lila','Gasulla','Moreno','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(44,'','Carlos Alberto','Geraud','Fereira','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(45,'','Eva','Giner','García','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(46,'','CHRISTOPHER','GIRALDO','OJEDA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(47,'11521498','Daniel','Gómez','Jarabo','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(48,'11537531','María','Góngora','Orozco','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(49,'11535009','Olivia','González','de Francisco','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(50,'11534973','ADRIANA','HEREDIA','RUIZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(51,'11534985','MARÍA','HEREDIA','RUIZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(52,'','ANA VICTORIA','HERNANDEZ','CASTRO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(53,'','KONSTANTIN','ISABEKIAN','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(54,'','ALLISSON','ISOLA','JYASSY','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(55,'11551276','Leo','Johansson','Romero','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(56,'11537771','CARLOS','JUÁREZ','GÓMEZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(57,'','ZHANGYR','KASYMKHAN','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(58,'13528896','Veronika','Khomenko','SINAPELLIDO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(59,'','ADAM','KJIDAA','MAJROUDA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(60,'','EMANUEL','KOSTOSKI','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(61,'11527959','Valentina','Laosa','Canevelli','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(62,'','OLENA','LESHCHENKO','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(63,'','ARTEM','LESYK','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(64,'','JINGYI','LIN','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(65,'','CHEN','LIU','YU','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(66,'11532152','Sofia','Lobon','Markina','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(67,'','DANNA ANTONELLA','LOOR','SALAS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(68,'','LUCÍA','LÓPEZ','GONZÁLEZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(69,'','LYLIA','LOUNNAS','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(70,'11528026','Alejandro','Lozano','Narros','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(71,'13122264','Santiago Xavier','Lucero','Moya','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(72,'','YULIA DANIELA','MACIAS','ALCIVAR','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(73,'11537786','Amanda','Maestre','Habjouqa','1970-01-01','1ESO','C',NULL,1,'2026-08-28 16:43:04','2026-09-14 19:26:20'),
(74,'','GIORGI','MAMSIKASHVILI','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(75,'11433220','Daniel','Marco','Iborra','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(76,'','AARÓN','MÁRQUEZ','CARBONELL','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(77,'11437398','Paula','Martínez','GIlly','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(78,'11536639','Arián','Martínez','Hajdini','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(79,'','Rhys Iván','Medina','Lozano','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(80,'11527849','EDURNE','MERINO','GÁLVEZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(81,'','ADRIÁN','MIHAI','MARK','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(82,'','SALSABIL','MOKEDDEM','BELAHCENE','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(83,'','SAMIR','MONTERO','CRUZADO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(84,'11537706','Lucía','Morales','Botella','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(85,'11497445','Sharick Mariana','Morales','Paz','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(86,'','Sarai','Moreno','Arenas','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(87,'11536129','ERIC','MORENO','GARCIA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(88,'','GABRIELA','MORENO','PIZARRO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(89,'11513615','Nora','Moreno de Arcos','Marco','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(90,'','Valentina','Morillo','Herrera','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(91,'13487912','Daniel','Ortiz','Castañeda','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(92,'13487695','Mateo','Ortiz','Castañeda','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(93,'11494151','DESIDERIO','ORTUÑO','GIMENEZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(94,'','OSCAR ALEXIS','OVIEDO','CONTRERAS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(95,'11534992','GAEL','PARRA','CARRILLO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(96,'13495869','JULIAN EMILIANO','PEREZ','Sinapellido','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(97,'01887081T','José María','Pimentel','Garcia','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(98,'','África','Pina','Periró','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(99,'11527872','Jimena','Planelles','Mum','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(100,'Y6061524A','Artem','Pluzhnyk','Pluzhnyk','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(101,'11494007','Álvaro','Ponsoda','Poveda','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:04','2026-08-28 16:43:04'),
(102,'','Daniel','Poveda','Valero','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(103,'Z1755512L','Myron','Prokopchenko','no','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(104,'13531021','Melanie','Pulgarin','Carmona','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(105,'11528021','Lola','Rabellino','Pina','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(106,'11528029','Uriel  ','Raído','Navarlaz','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(107,'13342883','Samuel Andrés','Restrepo','Sánchez','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(108,'11535033','Raúl','Rico','Gil','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(109,'','Paola','Rodríguez','Ballenilla','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(110,'','PAOLA','RODRIGUEZ','MOISES','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(111,'','ANGELYN','RODRÍGUEZ','MÁRQUEZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(112,'11666704','Valentina','Ruiz de la Sierra','Mira','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(113,'11537739','Alma','Santos','Rivero','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(114,'','OLIVIA','SANZ','PIQUERAS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(115,'Z2600489E','VERONIKA','SERHIIENKO','SINAPELLIDO','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(116,'','POTAP','SHEREMET','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(117,'','YEVHENIIA','SHUNEVYCH','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(118,'11537816','Alba','Simón','Bártulos','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(119,'11495433','Marc','Soler','Meyer','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(120,'11510948','Nicolas Cristhian','Soto','Aguilar','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(121,'','AINHOA','STANCIU','COZAC','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(122,'','XIAOFENG','SUN','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(123,'','ISKRA','TIKVICKI','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(124,'','SABRINA','TORRES','PALACIOS','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(125,'','ANIS','TROUDI','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(126,'11526384','MARTINA','VALVERDE','TOVARRA','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(127,'','ERICK AARON','VASILE','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(128,'','VALENTINA','VILLAREAL','RAMÍREZ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(129,'BE562224','Brittany sofia','Wisamano','Salinas','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(130,'','YUCHEN','XIA','','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05'),
(131,'','JESUS MANUEL','YERA','FERNANDEZ ','1970-01-01','1ESO','','N',1,'2026-08-28 16:43:05','2026-08-28 16:43:05');
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `casos`
--

DROP TABLE IF EXISTS `casos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `casos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_estado` bigint(20) unsigned NOT NULL,
  `id_triaje` bigint(20) unsigned NOT NULL,
  `id_tipologia` bigint(20) unsigned NOT NULL,
  `id_origen` bigint(20) unsigned NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `implicados` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `casos_id_estado_foreign` (`id_estado`),
  KEY `casos_id_triaje_foreign` (`id_triaje`),
  KEY `casos_id_tipologia_foreign` (`id_tipologia`),
  KEY `casos_id_origen_foreign` (`id_origen`),
  CONSTRAINT `casos_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`),
  CONSTRAINT `casos_id_origen_foreign` FOREIGN KEY (`id_origen`) REFERENCES `origenes` (`id`),
  CONSTRAINT `casos_id_tipologia_foreign` FOREIGN KEY (`id_tipologia`) REFERENCES `tipologias` (`id`),
  CONSTRAINT `casos_id_triaje_foreign` FOREIGN KEY (`id_triaje`) REFERENCES `triajes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `casos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `casos` WRITE;
/*!40000 ALTER TABLE `casos` DISABLE KEYS */;
/*!40000 ALTER TABLE `casos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `valor` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `configs` WRITE;
/*!40000 ALTER TABLE `configs` DISABLE KEYS */;
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `estados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES
(1,'Activo','#57e389','2026-08-15 05:37:48','2026-08-15 05:37:48'),
(2,'Seguimiento','#ffa348','2026-08-15 05:37:58','2026-08-15 05:37:58'),
(3,'Archivado','#1a5fb4','2026-08-19 04:49:39','2026-08-27 07:59:54');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `expedientes`
--

DROP TABLE IF EXISTS `expedientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `expedientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_apertura` date NOT NULL,
  `id_alumno` bigint(20) unsigned NOT NULL,
  `id_profesor` bigint(20) unsigned NOT NULL,
  `id_tipologia` bigint(20) unsigned NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fecha_solucion` date DEFAULT NULL,
  `solucion` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expedientes_id_profesor_foreign` (`id_profesor`),
  KEY `expedientes_id_alumno_foreign` (`id_alumno`),
  KEY `expedientes_id_tipologia_foreign` (`id_tipologia`),
  CONSTRAINT `expedientes_id_alumno_foreign` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`),
  CONSTRAINT `expedientes_id_profesor_foreign` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id`),
  CONSTRAINT `expedientes_id_tipologia_foreign` FOREIGN KEY (`id_tipologia`) REFERENCES `tipologias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expedientes`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `expedientes` WRITE;
/*!40000 ALTER TABLE `expedientes` DISABLE KEYS */;
INSERT INTO `expedientes` VALUES
(1,'2026-08-27',73,1,1,'dfssad','1970-01-01','sdgds','2026-08-27 07:57:49','2026-08-27 07:57:49');
/*!40000 ALTER TABLE `expedientes` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_07_06_110151_create_origenes_table',1),
(5,'2026_07_22_083813_create_alumnos_table',1),
(6,'2026_07_22_085526_create_triajes_table',1),
(7,'2026_07_22_085802_create_estados_table',1),
(8,'2026_07_22_090042_create_tipologias_table',1),
(9,'2026_07_22_173257_create_profesores_table',1),
(10,'2026_07_22_174837_create_expendientes_table',1),
(11,'2026_07_22_174846_create_partes_table',1),
(12,'2026_07_22_174902_create_casos_table',1),
(13,'2026_07_27_121620_create_configs_table',1),
(14,'2026_08_28_164448_create_actor_casos_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `origenes`
--

DROP TABLE IF EXISTS `origenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `origenes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `origenes`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `origenes` WRITE;
/*!40000 ALTER TABLE `origenes` DISABLE KEYS */;
INSERT INTO `origenes` VALUES
(3,'Iniciativa propia','2026-08-15 05:36:16','2026-08-19 04:50:37'),
(4,'Iniciativa Alumnado','2026-08-15 05:36:26','2026-08-19 04:50:54'),
(5,'Iniciativa Docente','2026-08-19 04:51:04','2026-08-19 04:51:04');
/*!40000 ALTER TABLE `origenes` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `partes`
--

DROP TABLE IF EXISTS `partes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `partes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nivel` varchar(255) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `acciones` mediumtext NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(255) NOT NULL,
  `id_profesor` bigint(20) unsigned NOT NULL,
  `comunicacion` varchar(255) NOT NULL,
  `firmado` tinyint(4) NOT NULL DEFAULT 0,
  `id_tipologia` bigint(20) unsigned NOT NULL,
  `id_alumno` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partes_id_alumno_foreign` (`id_alumno`),
  KEY `partes_id_tipologia_foreign` (`id_tipologia`),
  KEY `partes_id_profesor_foreign` (`id_profesor`),
  CONSTRAINT `partes_id_alumno_foreign` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`),
  CONSTRAINT `partes_id_profesor_foreign` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id`),
  CONSTRAINT `partes_id_tipologia_foreign` FOREIGN KEY (`id_tipologia`) REFERENCES `tipologias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partes`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `partes` WRITE;
/*!40000 ALTER TABLE `partes` DISABLE KEYS */;
INSERT INTO `partes` VALUES
(1,'grave','vzcvcxzvxc','zxcvzxcvcxz','2026-07-31','2',1,'itaca',1,1,73,'2026-08-27 11:21:46','2026-08-27 11:21:46');
/*!40000 ALTER TABLE `partes` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `profesores`
--

DROP TABLE IF EXISTS `profesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `apellido1` varchar(255) NOT NULL,
  `apellido2` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `grupo` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profesores_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesores`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `profesores` WRITE;
/*!40000 ALTER TABLE `profesores` DISABLE KEYS */;
INSERT INTO `profesores` VALUES
(1,'delgado','parra','beatriz','beatriz@iesmh.com',NULL,NULL,0,'2026-08-15 04:56:41','2026-08-15 04:56:41'),
(2,'bouix',NULL,'pascal','pascalbouix@hotmail.com',NULL,NULL,1,'2026-08-24 10:42:16','2026-08-24 10:42:16'),
(3,'bouix','NULL','pascal','sat@levantia.net','1ESO','A',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(4,'Aracil','Segui','Lucia','l.aracilses@edu.gva.es','2ESO','D',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(5,'Arroyo','Boyero','Maria Francisca','mf.arroyoboyero@edu.gva.es','2ESO','C',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(6,'Bonet','Segui','Gabriel','g.bonetsegui@edu.gva.es','1ESO','B',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(7,'Bravo','Beato','Jose Juan','jj.bravobeato@edu.gva.es','2ESO','B',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(8,'Enguidanos','Chinchilla','Juan Carlos','jc.enguidanoschinc@edu.gva.es','2ESO','A',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(9,'Esteve','Trigueros','Pedro','p.estevetriguero@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(10,'Fernandez','Fernandez','Jorge Juan','jj.fernandezfernan@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(11,'Gimenez','Gomez','Ester Violeta','ev.gimenezgomez@edu.gva.es','1ESO','C',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(12,'Gonzalez','Peris',' Borja ','b.gonzalezperis@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(14,'Lopez','Miñano',' Lucia ','l.lopezminano@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(16,'Mayor','Serra',' Antonio Jose','aj.mayorserra@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(17,'Orovio','Orovio',' Isabel Pilar','ip.orovioorovio@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(18,'Perez','Ferrando',' Joan',' j.perezferrando@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(19,'Pico','Llinares',' Miguel','m.picollinares@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(20,'Santana','Torres',' Carolina',' c.santanatorres@edu.gva.es','1BACH','B',1,'2026-09-01 13:07:05','2026-09-01 13:10:22'),
(22,'Vila','Benavent',' Andres','a.vilabenavent@edu.gva.es','','',0,'2026-09-01 13:07:05','2026-09-01 13:16:36'),
(24,'VIVES','ESPAÑA','PALMIRA','p.vivesespana@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(25,'Aceituno','Lara','Alicia','a.aceitunolara@edu.gva.es','','',0,'2026-09-01 13:07:05','2026-09-01 13:16:36'),
(26,'Ureña','Bordería','Agueda','alr.urenaborderia@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05'),
(27,'Guillen','Garcia','Laura','l.guillengarcia@edu.gva.es','','',0,'2026-09-01 13:07:05','2026-09-01 13:16:36'),
(28,'Lopez','de la O','Francisco Javier','fj.lopez@edu.gva.es','','',1,'2026-09-01 13:07:05','2026-09-01 13:07:05');
/*!40000 ALTER TABLE `profesores` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tipologias`
--

DROP TABLE IF EXISTS `tipologias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipologias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipologias`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tipologias` WRITE;
/*!40000 ALTER TABLE `tipologias` DISABLE KEYS */;
INSERT INTO `tipologias` VALUES
(1,'Acoso','2026-08-15 05:09:24','2026-08-15 05:37:25'),
(2,'Conflicto entre pares','2026-08-15 05:09:36','2026-09-03 08:53:56'),
(3,'Civismo','2026-09-03 08:51:44','2026-09-03 08:51:44'),
(4,'Móvil','2026-09-03 08:54:09','2026-09-03 08:54:09'),
(5,'Disruptivo','2026-09-03 08:54:21','2026-09-03 08:54:21'),
(6,'Sustancias','2026-09-03 08:54:31','2026-09-03 08:54:31'),
(7,'Discriminación','2026-09-03 08:54:41','2026-09-03 08:54:41'),
(8,'Agresión','2026-09-03 08:55:08','2026-09-03 08:55:08'),
(9,'Fugas','2026-09-03 08:55:15','2026-09-03 08:55:15'),
(10,'Acompañamiento emocional','2026-09-03 08:55:31','2026-09-03 08:55:31'),
(11,'Otros','2026-09-03 08:55:38','2026-09-03 08:55:38');
/*!40000 ALTER TABLE `tipologias` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `triajes`
--

DROP TABLE IF EXISTS `triajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `triajes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `triajes`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `triajes` WRITE;
/*!40000 ALTER TABLE `triajes` DISABLE KEYS */;
INSERT INTO `triajes` VALUES
(1,'HHSS',NULL,'2026-08-19 05:09:10','2026-08-19 05:09:10'),
(3,'Representantes',NULL,'2026-08-19 05:13:07','2026-08-19 05:13:07'),
(4,'Violencias',NULL,'2026-08-19 05:13:15','2026-08-19 05:13:15'),
(6,'Mediación',NULL,'2026-08-19 05:15:24','2026-08-19 05:15:24');
/*!40000 ALTER TABLE `triajes` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `code_created_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(2,'admin','admin@convicloud.iesmh',NULL,'$2y$12$lyIR5gt4F4E4IwsMtVhZyuX0.0nOnBtDUYVbULhoGRXScMSKlFILi',NULL,NULL,NULL,'2026-08-24 03:17:39','2026-08-24 04:18:54'),
(3,'pascal','pascalbouix@hotmail.com',NULL,'$2y$12$pDqXSb54i1hqV2NBea7aJu9eIvhBOxBAEZ/1OwtWbiWOE7EiinJFG',NULL,NULL,NULL,'2026-08-24 10:42:16','2026-08-24 10:42:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-09-14 23:31:09
