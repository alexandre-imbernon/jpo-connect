-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 juil. 2024 à 14:28
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
(1, 'Journées Portes Ouvertes [La Plateforme_ Marseille]', 'Marseille', '2024-08-01', 100, 'Les métiers du numérique vous attirent ? 👨‍💻 Ça tombe bien, c’est un secteur en plein essor !\r\n\r\nPour vous former, rejoignez La Plateforme, le campus méditerranéen du numérique ! 🙌\r\n\r\n\r\n\r\nLe jeudi 1 août, nos équipes et étudiants seront présents de 14h à 17h pour vous faire découvrir l\'ensemble de nos cursus, au travers d’ateliers et de stands dédiés à nos différentes formations :\r\n\r\n✔️ Bachelor / Bac +3 (5 spécialités : Web & Web Mobile, Logiciel, IA, Cybersécurité, Systèmes Immersifs)\r\n\r\n✔️ Master of Science (MSc) / Bac +5 (2 spécialités : Web & Web Mobile, IA )\r\n\r\n✔️ Post-graduate / Bac +6 : sur l’intelligence artificielle avec l’École Centrale de Marseille, et sur le management d\'innovation.', '2024-07-15 08:44:27', '2024-07-16 08:47:32'),
(2, 'Journées Portes Ouvertes [La Plateforme_ Cannes]\r\n', 'Cannes', '2024-08-15', 100, 'Vous êtes passionné par les métiers du numérique ? 👨‍💻 Bonne nouvelle, c\'est un secteur en pleine croissance ! Rejoignez La Plateforme, le campus méditerranéen dédié au numérique ! 🙌 Le mercredi 15 août, nos équipes et étudiants seront là de 14h à 17h pour vous présenter tous nos cursus à travers des ateliers et des stands consacrés à nos formations :\r\n\r\n✔️ Bachelor / Bac +3 (5 spécialités : Web & Web Mobile)', '2024-07-15 08:44:27', '2024-07-16 08:51:19'),
(3, 'Journées Portes Ouvertes [La Plateforme_ Toulon]\r\n', 'Toulon', '2024-08-20', 100, 'Vous êtes intéressé par les métiers du numérique ? 👨‍💻 C\'est parfait, ce secteur est en plein essor ! Rejoignez La Plateforme, le campus méditerranéen dédié au numérique ! 🙌 Le mardi 20 août, nos équipes et étudiants seront présents de 14h à 17h pour vous faire découvrir l’ensemble de nos cursus à travers des ateliers et des stands dédiés à nos formations :\r\n\r\n✔️ Bachelor / Bac +3 (5 spécialités : Web & Web Mobile)\r\n✔️ Langage à la carte (formations au choix sur  Python // Java // JEE // C, C++// Javascript)', '2024-07-15 08:44:27', '2024-07-16 08:55:06'),
(4, 'Journées Portes Ouvertes [La Plateforme_ Martigues]\r\n', 'Martigues', '2024-08-25', 100, 'Vous êtes passionné par le numérique ? 👨‍💻 Excellente nouvelle, ce secteur est en pleine expansion ! Rejoignez La Plateforme, le campus méditerranéen du numérique ! 🙌 Le dimanche 25 août, nos équipes et étudiants seront là de 14h à 17h pour vous présenter tous nos cursus à travers des ateliers et des stands dédiés à nos formations :\r\n\r\n✔️ Bachelor / Bac +3 (5 spécialités : Web & Web Mobile)', '2024-07-15 08:44:27', '2024-07-16 08:56:20');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `registrations`
--

INSERT INTO `registrations` (`id`, `user_id`, `jpo_id`, `registered_at`, `status`) VALUES
(1, 5, 4, '2024-07-15 08:44:57', 'inscrit'),
(2, 5, 4, '2024-07-15 08:50:00', 'inscrit'),
(3, 6, 3, '2024-07-15 08:51:40', 'inscrit'),
(11, 2, 1, '2024-07-16 08:06:09', 'inscrit'),
(10, 2, 1, '2024-07-16 08:01:24', 'inscrit'),
(9, 2, 1, '2024-07-16 08:00:57', 'inscrit'),
(8, 2, 1, '2024-07-16 08:00:52', 'inscrit'),
(12, 2, 1, '2024-07-16 08:06:35', 'inscrit'),
(13, 2, 1, '2024-07-16 08:06:41', 'inscrit'),
(14, 2, 1, '2024-07-16 08:10:59', 'inscrit'),
(15, 2, 4, '2024-07-16 08:25:50', 'inscrit'),
(16, 7, 3, '2024-07-17 08:50:11', 'inscrit');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Alex', '', 'alex@laplateforme.io', 'salarié', '2024-07-15 08:35:48', '2024-07-15 08:35:48'),
(2, 'Alex', '', 'alexandre.imbernon@laplateforme.io', 'salarié', '2024-07-15 08:36:34', '2024-07-15 08:36:34'),
(3, 'Tom', '', 'tom@laplteforme.io', 'salarié', '2024-07-15 08:37:20', '2024-07-15 08:37:20'),
(4, 'Asmaa', '', 'asmaa@laplateforme.Io', 'salarié', '2024-07-15 08:41:10', '2024-07-15 08:41:10'),
(5, 'Alex', '', 'alex@alex.fr', 'salarié', '2024-07-15 08:44:57', '2024-07-15 08:44:57'),
(6, 'Alex', '', 'Alex@ooo.fr', 'salarié', '2024-07-15 08:51:40', '2024-07-15 08:51:40'),
(7, 'willy', '', 'willy@bg.fr', 'salarié', '2024-07-17 08:50:11', '2024-07-17 08:50:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
