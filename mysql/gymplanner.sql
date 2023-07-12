-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: gymplanner2
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

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
-- Table structure for table `exercicios`
--

DROP TABLE IF EXISTS `exercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exercicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `series` int DEFAULT NULL,
  `repeticao` int DEFAULT NULL,
  `tempo` int DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `orientacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercicios`
--

LOCK TABLES `exercicios` WRITE;
/*!40000 ALTER TABLE `exercicios` DISABLE KEYS */;
INSERT INTO `exercicios` VALUES (61,'Braço','Rosca Bíceps Direita',2,2,2,'Braços 2 - (RoscaBícepsDireita).webp',''),(62,'Braço','Extensão Tríceps',2,2,2,'Braços 3 - (ExtensãoTrpiceps).jpg',''),(63,'Perna','Elevação de Panturrilha',2,2,2,'Pernas 4 - (ElavaçãoPanturrilha).webp',''),(64,'Perna','Agachamento',2,2,2,'Pernas 1 - (Agachamento).gif',''),(65,'Peito','Flexão de Braço',2,2,2,'flexao de braço.webp',''),(66,'Glúteo','Elevação Lateral',2,2,2,'elevação lateral.gif',''),(67,'Costa','Remada Unilateral',2,2,2,'remada unilateral.webp','');
/*!40000 ALTER TABLE `exercicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercicios_usuarios`
--

DROP TABLE IF EXISTS `exercicios_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exercicios_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `series` int DEFAULT NULL,
  `repeticao` int DEFAULT NULL,
  `tempo` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `exercicios_usuarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=433 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercicios_usuarios`
--

LOCK TABLES `exercicios_usuarios` WRITE;
/*!40000 ALTER TABLE `exercicios_usuarios` DISABLE KEYS */;
INSERT INTO `exercicios_usuarios` VALUES (32,'marco','fnednfnd',2,2,2,4),(33,'marco','fnednfnd',2,2,2,4),(34,'marco','fnednfnd',2,2,2,4),(35,'marco','fnednfnd',2,2,2,4),(72,'Braço','Mario',222,22222,22222,4),(73,'Braço','Mario',29,22222,22222,4),(74,'Braço','Mario',222,22222,22222,4),(81,'marco','fnednfnd',2,2,2,4),(91,'Braço','Flexões inclinadas',15,6,0,5),(112,'djjdjjd','bbbbbb',3,2666,45566,3),(122,'hey','oi',2,2,2,6),(123,'hey','oi',2,2,2,6),(133,'oddoo','ooddodo',2,2,2,7),(135,'oddoo','ooddodo',2,2,2,8),(161,'oddoo','ooddodo',2,2,2,9),(180,'oddoo','ooddodo',2,2,2,13),(181,'oddoo','ooddodo',2,2,2,13),(190,'oddoo','ooddodo',2,2,2,14),(191,'oddoo','ooddodo',200000,2,2,14),(192,'oddoo','ooddodo',2,2,2,14),(193,'oddoo','ooddodo',2999999,2,2,14),(194,'oddoo','ooddodo',1111111111,2,2,14),(195,'oddoo','ooddodo',111111,2,2,14),(196,'oddoo','ooddodo',2,2,2,14),(197,'oddoo','ooddodo',2,2,2,14),(198,'oddoo','ooddodo',990000,2,2,14),(199,'oddoo','ooddodo',2,2,2,15),(201,'Braçoww','wwwwdjdjsjsjdj',2,2,2,15),(202,'Braçoww','wwwwdjdjsjsjdj',2,2,2,15),(204,'Braçoww','wwwwdjdjsjsjdj',2,2,2,17),(205,'Braçoww','wwwwdjdjsjsjdj',1,2,2,17),(206,'Braçoww','wwwwdjdjsjsjdj',9,2,2,17),(207,'Braçoww','wwwwdjdjsjsjdj',5,2,2,17),(209,'Braçoww','wwwwdjdjsjsjdj',2900,2,2,17),(365,'Pernas','Elevação de panturrilhas',11111,3,3,20),(366,'Pernas','Elevação de panturrilhas',11111,3,3,20),(367,'Pernas','Elevação de panturrilhas',2,3,3,20),(368,'Pernas','Elevação de panturrilhas',80,3,3,20),(369,'Pernas','Elevação de panturrilhas',2900,3,3,20),(370,'Pernas','Elevação de panturrilhas',2900,3,3,20),(371,'Pernas','Elevação de panturrilhas',2900,3,3,20),(372,'Pernas','Elevação de panturrilhas',2900,3,3,20),(373,'Pernas','Elevação de panturrilhas',2900,3,3,20),(374,'Pernas','Elevação de panturrilhas',2900,3,3,20),(375,'Pernas','Elevação de panturrilhas',2900,3,3,20),(376,'Pernas','Elevação de panturrilhas',2900,3,3,20),(377,'Pernas','Elevação de panturrilhas',2900,3,3,20),(378,'Pernas','Elevação de panturrilhas',2900,3,3,20),(379,'Pernas','Elevação de panturrilhas',2900,3,3,20),(380,'Pernas','Elevação de panturrilhas',2900,3,3,20),(381,'Pernas','Elevação de panturrilhas',2900,3,3,20),(382,'Pernas','Elevação de panturrilhas',2900,3,3,20),(383,'Pernas','Elevação de panturrilhas',2900,3,3,20),(384,'Pernas','Elevação de panturrilhas',2900,3,3,20),(385,'Pernas','Elevação de panturrilhas',2900,3,3,20),(386,'Pernas','Elevação de panturrilhas',2900,3,3,20),(387,'Pernas','Elevação de panturrilhas',2900,3,3,20),(388,'Pernas','Elevação de panturrilhas',2900,3,3,20),(389,'Pernas','Elevação de panturrilhas',2900,3,3,20),(390,'Pernas','Elevação de panturrilhas',2900,3,3,20),(391,'Pernas','Elevação de panturrilhas',2900,3,3,20),(392,'Pernas','Elevação de panturrilhas',2900,3,3,20),(393,'Pernas','Elevação de panturrilhas',2900,3,3,20),(394,'Pernas','Elevação de panturrilhas',2900,3,3,20),(395,'Pernas','Elevação de panturrilhas',2900,3,3,20),(396,'Pernas','Elevação de panturrilhas',2900,3,3,20),(397,'Pernas','Elevação de panturrilhas',2900,3,3,20),(398,'Pernas','Elevação de panturrilhas',2900,3,3,20),(399,'Pernas','Elevação de panturrilhas',2900,3,3,20),(400,'Pernas','Elevação de panturrilhas',2900,3,3,20),(401,'Pernas','Elevação de panturrilhas',2900,3,3,20),(402,'Pernas','Elevação de panturrilhas',2900,3,3,20),(403,'Pernas','Elevação de panturrilhas',2900,3,3,20),(404,'Pernas','Elevação de panturrilhas',2900,3,3,20),(405,'Pernas','Elevação de panturrilhas',2900,3,3,20),(406,'Pernas','Elevação de panturrilhas',2900,3,3,20),(407,'Pernas','Elevação de panturrilhas',2900,3,3,20),(408,'Pernas','Elevação de panturrilhas',2900,3,3,20),(409,'Pernas','Elevação de panturrilhas',2900,3,3,20),(410,'Pernas','Elevação de panturrilhas',2900,3,3,20),(411,'Pernas','Elevação de panturrilhas',2900,3,3,20),(418,'Pernas','Elevação de panturrilhas',2,3,3,23),(423,'Perna','Perna 5',190909,2,3,34),(424,'Perna','Perna 5',1,2,3,36),(425,'Perna','Perna 5',1,2,3,38),(427,'Perna','Perna 5',1,2,3,39),(428,'Perna','Perna 5',1,2,3,41),(429,'Perna','Perna 5',1,2,3,44);
/*!40000 ALTER TABLE `exercicios_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `senha`
--

DROP TABLE IF EXISTS `senha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `senha` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `senha`
--

LOCK TABLES `senha` WRITE;
/*!40000 ALTER TABLE `senha` DISABLE KEYS */;
INSERT INTO `senha` VALUES (1,'345');
/*!40000 ALTER TABLE `senha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT '../img/fotos_de_perfil/profile.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (4,'kjsksks','jmnfei@gmail.com','2','2023-07-05','masculino','../img/fotos_de_perfil/profile.png'),(6,'jjjjfjf','jdjdjdj@gmail.com','1','1999-02-01','masculino','../img/fotos_de_perfil/profile.png'),(7,'nfnffn','ndnnd@gmail.com','1','2000-02-01','masculino','../img/fotos_de_perfil/profile.png'),(8,'jsjsjsjsjs','jdjdjdj2dj@gmail.com','1','2023-07-20','masculino','../img/fotos_de_perfil/profile.png'),(9,'hhhch','djdjdj@gmail.com','1','2023-07-24','masculino','../img/fotos_de_perfil/profile.png'),(10,'dnjdndndn','ndndndnd@gmail.com','1','2023-07-14','masculino','../img/fotos_de_perfil/profile.png'),(11,'dnjdndndn','ndndndnd@gmail.com','1','2023-07-14','masculino','../img/fotos_de_perfil/profile.png'),(12,'dnjdndndn','ndndndnd@gmail.com','1','2023-07-14','masculino','../img/fotos_de_perfil/profile.png'),(13,'ndndndnd','nndndndnndn@gmail.com','1','2023-07-08','masculino','../img/fotos_de_perfil/profile.png'),(14,'Vanessa Moares','vmoares@gmail.com','1','2001-03-15','feminino','../img/fotos_de_perfil/profile.png'),(15,'djdjjdjd','skksks@gmail.com','$2y$10$xfBR0HYj9AJH0VEntA8v8u8sgVYSe4Hd.BgOFAsa4lgGRWjtjWaLe','2000-01-26','feminino','../img/fotos_de_perfil/profile.png'),(16,'kksksks','dkkdkdk@gmail.com','$2y$10$3rXPT9fn0ocoztYyE9hy5.iTudnp1qH8fMdKIS3qEUODRPlLPB0Pm','2023-07-19','masculino','../img/fotos_de_perfil/profile.png'),(17,'Hely','hlsjdie@gmail.com','$2y$10$ZVwNOpmUpIybD2IW7yObIu2rtLOeQaPTY9/nuTrH6m6B1w4ohWO.6','2023-07-12','masculino','../img/fotos_de_perfil/profile.png'),(18,'djdjdjdjjd','jdjdjdjdjdjdj@gmail.com','$2y$10$efP0VwHceGOq.EC9BzWJIedMO56KCjMgFdUNn7wEV80jkSxiERMP6','2023-07-19','masculino','../img/fotos_de_perfil/profile.png'),(19,'Maria Ribeiro','maria@gmail.com','$2y$10$xoRCucR5A9fMjPvcE7HomOx5cOpXrnBq.T3A/o.vWKNonT3NqDd9S','2000-01-18','feminino','../img/fotos_de_perfil/profile.png'),(20,'Elevação de panturrilhas','jmartinez2@gmail.com','$2y$10$hZjVeexrBX8CDwcy7eYwSezfR9LLpkd9TkGPLeUKrMkFxBoRbghXa','1999-06-17','feminino','../img/fotos_de_perfil/profile.png'),(21,'jdjdjdjdj','jdjdjdj@gmail.com','$2y$10$9AWZAxrlnQkNBr8x7sT84OXp4k5ZC9j/6xZONbZfNZXLrIlS688jC','2023-07-26','masculino','../img/fotos_de_perfil/profile.png'),(32,'jjddjdj','jjddjdj@gmail.com','$2y$10$4NUGi94mHCiyytQr6vZjpuxRujD5SDzXIkRN3Qn8Dfuk30e07hThW','1111-11-11','masculino','../img/fotos_de_perfil/profile.png'),(33,'sjsjssjs','sjsjssjs@gmail.com','$2y$10$ZBavZje9Xqat/tSqbp7uh.rAKEFlJLWC9zF8Q8kEJGT6NuZjyCnoO','1995-02-16','feminino','../img/fotos_de_perfil/Captura de tela de 2023-01-26 23-40-15.png'),(36,'jdjdj','djdjnjdnjd@gmail.com','$2y$10$sY8qUIXEdW4atlQqBjxYeehszZvCnnpUvZzdUdfKp7ez8BkaIDGE6','1999-01-22','masculino','../img/fotos_de_perfil/remada invertida.gif'),(37,'sdijsisjds','sdijsisjds@gmail.com','$2y$10$oqhebFSXdSRhXskCk8OrjeghB7T9ChAtcKn1l0ny6YEzHB50MI5NK','1999-02-01','masculino','../img/fotos_de_perfil/profile.png'),(38,'djdjjddjjs','djdjjddjjs@gmail.com','$2y$10$pSQOhmXrRIQfoLzXQM5cOe1cD5hvVzJocKVOcY2mWirnUYJf5WXKm','1999-02-01','masculino','../img/fotos_de_perfil/profile.png'),(39,'ndsnjdnsjdn','njndcjncjdn@gmail.com','$2y$10$gRfVU8MydVaaN/ChpSOW.uqy2O7oCWpX2rrzRzjUp7YnOzuFjBQzS','1999-03-01','masculino','../img/fotos_de_perfil/profile.png'),(40,'sdisjdisj','sdisjdisj@gmail.com','$2y$10$F4HING7YIK7YTduGABdTjezSMozu0P0G78pcnlt5n6sPydfOfllmS','1999-01-01','masculino','../img/fotos_de_perfil/profile.png'),(41,'djkdkdk','djkdkdk@gmail.com','$2y$10$lUS2aYGZQPxlqCB/uKPFY.b875TbaIg36rj64npIcKoG0G7dJ5UHG','1999-02-01','masculino','../img/fotos_de_perfil/profile.png'),(42,'jidjfidjdfi','jidjfidjdfi@gmail.com','$2y$10$zPEXeYTCjgZqlDBgAk1eOO8h66xM7YCp/H5zhlQv6dthOFQ0Op/LC','1999-02-01','masculino','../img/fotos_de_perfil/profile.png'),(43,'dndjndj','ekfkd@gmail.com','$2y$10$cFwAjb41BXks88aRqbcqjuA2xmGLwKyw9c4QGePStp8Kj.JQqpOF6','1999-02-01','masculino','../img/fotos_de_perfil/profile.png'),(44,'joao','fmdkmd@gmail.com','$2y$10$gEkc4DaVR1rPtylCxiWD3e2JzbEBS1Ohs5afijshEbxoao90bJB6a','2023-07-12','masculino','../img/fotos_de_perfil/profile.png'),(46,'Mario Rodrigues Farias','mrf2023@gmail.com','$2y$10$zzkQzhdkMyZVmGKUZUTqc.UPIRDAhrz5w3QUYskX110tsNWVj0xaW','2023-07-20','masculino','../img/fotos_de_perfil/profile.png'),(47,'Mario Rodrigues Farias','emrf2023@gmail.com','$2y$10$6cCswRzmWw8iUwvMS/VbpuoafCtFi6DJBxQFs/5ZK6l1KARh3o.Pm','1990-02-10','masculino','../img/fotos_de_perfil/profile.png');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-12 15:43:50
