DROP TABLE IF EXISTS `loggers`;
CREATE TABLE `loggers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `create_at` varchar(45) NOT NULL,
  `action` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `rols`;
CREATE TABLE `rols` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolUQ` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `rols` WRITE;
INSERT INTO `rols` VALUES (1,'Administrador','administrador','1'),(2,'Supervisor','supervisor','1'),(3,'Operador','operador','1');
UNLOCK TABLES;

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rucEmproy` varchar(18) NOT NULL,
  `nameEmproy` varchar(150) NOT NULL,
  `addrEmproy` varchar(255) DEFAULT NULL,
  `phoneEmproy` varchar(25) DEFAULT NULL,
  `otherPhoneEmproy` varchar(25) DEFAULT NULL,
  `emailEmproy` varchar(50) NOT NULL,
  `logoEmproy` blob,
  `tockenEmproy` varchar(255) DEFAULT NULL,
  `dbEmproy` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rucEmproyUQ` (`rucEmproy`),
  UNIQUE KEY `dbEmproyUQ` (`dbEmproy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (1,1,'admin','cb5e0fac75c921ae02487fad30c8d0a61eeb3d6c793126fa6e309db854cd3aa1','admin@mvcphp.com','Administrador','RekutuPHP','','d6f16a39010350657716ad8b8ecc47b4e6f862ac09c8fe448f',1);
UNLOCK TABLES;
