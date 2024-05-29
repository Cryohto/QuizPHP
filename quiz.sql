-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 29 mai 2024 à 02:04
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id` int(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `user`, `password`) VALUES
(1, 'max', '$2y$10$mtwXzNADNRnowdUa9U9AJ.kZ3ny4sU4z2QNbxTKGwMjiWq5NmMBYu'),
(2, 'dorian', '$2y$10$JXxVwN9c7e4Nms3xui5zg.BJZZJaQCqKYNsJjr16tuH1glceQs..K');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`) VALUES
(1, 1, 'a', 'a', 'a', 'a', 'a', 'a'),
(2, 1, 'a', 'a', 'a', 'a', 'a', 'a'),
(3, 1, 'a', 'a', 'a', 'a', 'a', 'a'),
(4, 1, 'a', 'a', 'a', 'a', 'a', 'a'),
(5, 1, 'a', 'a', 'a', 'a', 'a', 'a'),
(6, 2, '1+2', '2', '3', '4', '5', 'b'),
(7, 2, '2x2', '9', '8', '7', '4', 'd'),
(8, 2, '4+5', '9', '57', '8', '4', 'a'),
(9, 2, '7+4', '12', '13', '11', '10', 'c'),
(10, 2, '8+9', '14', '15', '16', '17', 'd');

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(255) NOT NULL,
  `titrequiz` varchar(255) NOT NULL,
  `question1` varchar(255) NOT NULL,
  `reponse1a` varchar(255) NOT NULL,
  `reponse1b` varchar(255) NOT NULL,
  `reponse1c` varchar(255) NOT NULL,
  `reponse1d` varchar(255) NOT NULL,
  `reponsevrai1` varchar(255) NOT NULL,
  `question2` varchar(255) NOT NULL,
  `reponse2a` varchar(255) NOT NULL,
  `reponse2b` varchar(255) NOT NULL,
  `reponse2c` varchar(255) NOT NULL,
  `reponse2d` varchar(255) NOT NULL,
  `reponsevrai2` varchar(255) NOT NULL,
  `question3` varchar(255) NOT NULL,
  `reponse3a` varchar(255) NOT NULL,
  `reponse3b` varchar(255) NOT NULL,
  `reponse3c` varchar(255) NOT NULL,
  `reponse3d` varchar(255) NOT NULL,
  `reponsevrai3` varchar(255) NOT NULL,
  `question4` varchar(255) NOT NULL,
  `reponse4a` varchar(255) NOT NULL,
  `reponse4b` varchar(255) NOT NULL,
  `reponse4c` varchar(255) NOT NULL,
  `reponse4d` varchar(255) NOT NULL,
  `reponsevrai4` varchar(255) NOT NULL,
  `question5` varchar(255) NOT NULL,
  `reponse5a` varchar(255) NOT NULL,
  `reponse5b` varchar(255) NOT NULL,
  `reponse5c` varchar(255) NOT NULL,
  `reponse5d` varchar(255) NOT NULL,
  `reponsevrai5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`) VALUES
(1, 'a'),
(2, 'Calcul');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
