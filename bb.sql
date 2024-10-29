-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour sunu_annonce_db
CREATE DATABASE IF NOT EXISTS `sunu_annonce_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sunu_annonce_db`;

-- Listage de la structure de table sunu_annonce_db. annonces
CREATE TABLE IF NOT EXISTS `annonces` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `etat` enum('EN_COURS_VALIDATION','PUBLIEE','REJETEE') DEFAULT NULL,
  `validate` tinyint(1) NOT NULL DEFAULT '0',
  `date_creation` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sunu_annonce_db. annonces_utilisateurs
CREATE TABLE IF NOT EXISTS `annonces_utilisateurs` (
  `annonce_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`annonce_id`,`user_id`) USING BTREE,
  KEY `FK_annonces_utilisateurs_utilisateurs` (`user_id`) USING BTREE,
  CONSTRAINT `FK_annonces_utilisateurs_annonces` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`),
  CONSTRAINT `FK_annonces_utilisateurs_utilisateurs` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sunu_annonce_db. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sunu_annonce_db. profils
CREATE TABLE IF NOT EXISTS `profils` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sunu_annonce_db. utilisateurs
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tel` varchar(15) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `profil_id` int DEFAULT NULL,
  `blocked` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_utilisateurs_profils` (`profil_id`),
  CONSTRAINT `FK_utilisateurs_profils` FOREIGN KEY (`profil_id`) REFERENCES `profils` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
