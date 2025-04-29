-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 28 avr. 2025 à 18:42
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cosdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'core', '$2y$10$h/3rz59Lekamlt.gC8Tk5eA8ZTbWD1rYCRbLar3/RD1uSnClPwg/i'),
(2, 'younes', '$2y$10$bYfDtiByHkM9orQZkvzXNOeUwCkaEaSLpR5LZ7iiPmKXRQ2j4xswi');

-- --------------------------------------------------------

--
-- Structure de la table `annee_scolaire`
--

CREATE TABLE `annee_scolaire` (
  `id` int(11) NOT NULL,
  `lib_as` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annee_scolaire`
--

INSERT INTO `annee_scolaire` (`id`, `lib_as`) VALUES
(1, '2024_2025');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `nom_etd` varchar(100) NOT NULL,
  `prenom_etd` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_etd` varchar(255) NOT NULL,
  `matricule_etd` varchar(50) NOT NULL,
  `sexe_etd` enum('M','F') NOT NULL,
  `photo_etd` varchar(255) DEFAULT NULL,
  `filiere_id` int(11) NOT NULL,
  `niveau_id` int(11) NOT NULL,
  `annee_scolaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom_etd`, `prenom_etd`, `login`, `password`, `email_etd`, `matricule_etd`, `sexe_etd`, `photo_etd`, `filiere_id`, `niveau_id`, `annee_scolaire_id`) VALUES
(41, 'DARIF', 'YASSINE', 'test', '$2y$10$HUKbeY3fMQF2TnEJFda0guui1rhv1hqDeXRwA1xw3S6f4ZD11EVV6', 'yassinedarif2003@gmail.com', 'ipiopo', 'M', '../uploads/ipiopo_DARIF_YASSINE.jpg', 4, 2, 1),
(42, 'ouchake', 'younes', 'touchake', '$2y$10$/xvlT4ut6I9VjwVtwvCN0eGImSupFJCbV7mrHEYxldbUKL7JNFNzy', 'taklalw@gmail.com', 'C123546888', 'M', '../uploads/C123546888_ouchake_younes.jpg', 7, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `lib_fil` varchar(100) NOT NULL,
  `abr_fil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id`, `lib_fil`, `abr_fil`) VALUES
(1, 'Actuariat-Finance', 'AF'),
(2, 'Biostatistique, Démographie et Big Data', 'BDDB'),
(3, 'Data and Software Engineering', 'DSE'),
(4, 'Data Science', 'DS'),
(5, 'Économie Appliquée, Statistique et Big Data', 'EASBD'),
(6, 'Sciences de la Décision et Recherche Opérationnelle', 'SDRO'),
(7, 'Master de Recherche en Systèmes d\'Information et Systèmes Intelligents', 'M2SI');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `lib_niv` varchar(100) NOT NULL,
  `abr_niv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id`, `lib_niv`, `abr_niv`) VALUES
(1, '1ère Année', 'L1'),
(2, '2ème Année', 'L2'),
(3, '3ème Année', 'L3'),
(4, 'Master 1', 'M1'),
(5, 'Master 2', 'M2');

-- --------------------------------------------------------

--
-- Structure de la table `qcm`
--

CREATE TABLE `qcm` (
  `id_qcm` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `filiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `qcm`
--

INSERT INTO `qcm` (`id_qcm`, `niveau`, `titre`, `filiere`) VALUES
(24, 5, 'mathematique', 7),
(25, 5, 'finance', 7),
(26, 2, 'gestion de données', 4),
(28, 5, 'Les bases de l\'informatique', 7);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `id_qcm` int(11) NOT NULL,
  `texte_question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `id_qcm`, `texte_question`) VALUES
(31, 24, '1+8'),
(32, 25, 'c&#039;est est quoi le marketing'),
(33, 25, 'Que représente le ratio de liquidité d&#039;une entreprise ?'),
(34, 25, 'Qu;est-ce qu&#039;un dividende ?'),
(35, 26, 'ihedfvil jnklermi mljknmefvn'),
(36, 26, 'gtfdrdfs hhcnd krfkcdklh kbkcrfbjlhioj'),
(38, 28, 'Quel composant est considéré comme le cerveau de l’ordinateur ?'),
(39, 28, 'Quelle unité mesure la vitesse d’un processeur ?'),
(40, 28, 'Lequel des éléments suivants est un système d’exploitation ?'),
(41, 28, 'Qu’est-ce qu’un logiciel libre ?'),
(42, 28, 'Que signifie l’acronyme HTML ?');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `texte_reponse` text NOT NULL,
  `est_correct` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id`, `question_id`, `texte_reponse`, `est_correct`) VALUES
(59, 31, 'g', 0),
(60, 31, '58', 1),
(61, 31, 'g', 0),
(62, 31, '451', 0),
(63, 32, 'je ne sais pas ', 1),
(64, 32, 'est est la base des ventes', 0),
(65, 32, 'est comment gestioner d&#039;argent', 0),
(66, 32, 'taklalw ', 0),
(67, 33, 'Sa capacité à rembourser ses dettes à court terme', 1),
(68, 33, 'Sa rentabilité sur le long terme', 0),
(69, 33, 'Son endettement total', 0),
(70, 33, 'Son bénéfice net', 0),
(71, 34, ' Un impôt sur les bénéfices', 0),
(72, 34, 'Une prime versée aux employés', 0),
(73, 34, 'Une part des bénéfices distribuée aux actionnaires', 1),
(74, 34, 'Un type d’obligation', 0),
(75, 35, 'jnkncd', 1),
(76, 35, 'kefv', 0),
(77, 35, 'jkce', 0),
(78, 35, '5548', 0),
(79, 36, 'kqsl', 0),
(80, 36, 'kqsl', 1),
(81, 36, 'dddddddddd', 0),
(82, 36, '1', 0),
(87, 38, 'Le disque dur', 0),
(88, 38, 'le RAM', 0),
(89, 38, ' Le processeur (CPU)', 1),
(90, 38, 'L’écran', 0),
(91, 39, ' Hertz (Hz)', 1),
(92, 39, 'octet ', 0),
(93, 39, 'pixel', 0),
(94, 39, 'volt', 0),
(95, 40, 'Microsoft Excel', 0),
(96, 40, 'Google Chrome', 0),
(97, 40, 'Windows 10', 1),
(98, 40, 'Intel Core i5', 0),
(99, 41, 'Un logiciel sans interface graphique', 0),
(100, 41, 'Un logiciel dont le code source est accessible et modifiable', 1),
(101, 41, 'Un logiciel gratuit pour toujours', 0),
(102, 41, 'Un logiciel en ligne uniquement', 0),
(103, 42, 'HighText Machine Language', 0),
(104, 42, ' HyperText Markup Language', 1),
(105, 42, 'HyperText Management Language', 0),
(106, 42, 'Hyperlink and Text Markup Language', 0);

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `id_qcm` int(11) NOT NULL,
  `valeur` float DEFAULT NULL,
  `date_passage` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`id`, `id_etudiant`, `id_qcm`, `valeur`, `date_passage`) VALUES
(8, 42, 25, 0, '2025-03-17 11:16:04'),
(9, 42, 24, 2, '2025-03-17 12:23:50');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lib_as` (`lib_as`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_etd` (`login`),
  ADD UNIQUE KEY `email_etd` (`email_etd`),
  ADD UNIQUE KEY `matricule_etd` (`matricule_etd`),
  ADD KEY `filiere_id` (`filiere_id`),
  ADD KEY `niveau_id` (`niveau_id`),
  ADD KEY `annee_scolaire_id` (`annee_scolaire_id`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lib_fil` (`lib_fil`),
  ADD UNIQUE KEY `abr_fil` (`abr_fil`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lib_niv` (`lib_niv`),
  ADD UNIQUE KEY `abr_niv` (`abr_niv`);

--
-- Index pour la table `qcm`
--
ALTER TABLE `qcm`
  ADD PRIMARY KEY (`id_qcm`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_qcm` (`id_qcm`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_qcm` (`id_qcm`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `qcm`
--
ALTER TABLE `qcm`
  MODIFY `id_qcm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT pour la table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`filiere_id`) REFERENCES `filiere` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `etudiant_ibfk_2` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `etudiant_ibfk_3` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaire` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`id_qcm`) REFERENCES `qcm` (`id_qcm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`id_qcm`) REFERENCES `qcm` (`id_qcm`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
