-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 15 juil. 2024 à 09:37
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jpo`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `jpo_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `jpo_id` (`jpo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jpo`
--

DROP TABLE IF EXISTS `jpo`;
CREATE TABLE IF NOT EXISTS `jpo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `capacity` int NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `jpo`
--

INSERT INTO `jpo` (`id`, `name`, `location`, `date`, `capacity`, `description`, `created_at`, `updated_at`) VALUES
(1, 'JPO Marseille', 'marseille', '2024-08-01', 100, 'Journée Portes Ouvertes à Marseille', '2024-07-15 08:44:27', '2024-07-15 08:44:27'),
(2, 'JPO Cannes', 'cannes', '2024-08-15', 100, 'Journée Portes Ouvertes à Cannes', '2024-07-15 08:44:27', '2024-07-15 08:44:27'),
(3, 'JPO Toulon', 'toulon', '2024-08-20', 100, 'Journée Portes Ouvertes à Toulon', '2024-07-15 08:44:27', '2024-07-15 08:44:27'),
(4, 'JPO Martigues', 'martigues', '2024-08-25', 100, 'Journée Portes Ouvertes à Martigues', '2024-07-15 08:44:27', '2024-07-15 08:44:27');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `jpo_id` int NOT NULL,
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('envoyé','non envoyé') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `jpo_id` (`jpo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `jpo_id` int NOT NULL,
  `registered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('inscrit','désinscrit') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `jpo_id` (`jpo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `registrations`
--

INSERT INTO `registrations` (`id`, `user_id`, `jpo_id`, `registered_at`, `status`) VALUES
(1, 5, 4, '2024-07-15 08:44:57', 'inscrit'),
(2, 5, 4, '2024-07-15 08:50:00', 'inscrit'),
(3, 6, 3, '2024-07-15 08:51:40', 'inscrit');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('directeur','responsable','salarié') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Alex', '', 'alex@laplateforme.io', 'salarié', '2024-07-15 08:35:48', '2024-07-15 08:35:48'),
(2, 'Alex', '', 'alexandre.imbernon@laplateforme.io', 'salarié', '2024-07-15 08:36:34', '2024-07-15 08:36:34'),
(3, 'Tom', '', 'tom@laplteforme.io', 'salarié', '2024-07-15 08:37:20', '2024-07-15 08:37:20'),
(4, 'Asmaa', '', 'asmaa@laplateforme.Io', 'salarié', '2024-07-15 08:41:10', '2024-07-15 08:41:10'),
(5, 'Alex', '', 'alex@alex.fr', 'salarié', '2024-07-15 08:44:57', '2024-07-15 08:44:57'),
(6, 'Alex', '', 'Alex@ooo.fr', 'salarié', '2024-07-15 08:51:40', '2024-07-15 08:51:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
