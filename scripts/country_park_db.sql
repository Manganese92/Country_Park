-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 28 août 2022 à 14:42
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `country_park_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `biens`
--

CREATE TABLE `biens` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `descriptions` text COLLATE utf8_unicode_ci NOT NULL,
  `capacite` int(11) NOT NULL,
  `typebien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `biens`
--

INSERT INTO `biens` (`id`, `libelle`, `datedebut`, `datefin`, `prix`, `descriptions`, `capacite`, `typebien`) VALUES
(2, 'Caravane pas chère (DB) au minicamping Zeeland', '2022-08-28', '2022-11-06', '35.00', 'Basecamp à IJmuiden est un Tiny House Eco Resort avec 33 Tiny Houses uniques. ÖÖD Suite est l&#039;une des premières maisons miroirs, caractérisée par le minimalisme scandinave. Ici, vous êtes un avec la nature. La maison est complètement immergée dans l&#039;environnement. Les oiseaux ne remarqueront même pas que vous êtes là et continueront leur chanson pendant que vous préparez le petit déjeuner. Visitez nos partenaires à la plage ou commandez votre nourriture en ligne car les ÖÖD Suites n&#039;ont pas de cuisine. Demandez-nous quelques suggestions savoureuses!\r\n\r\nLe logement\r\n- Le linge de maison et les serviettes d&#039;hôtel sont inclus.\r\n- Huile d&#039;olive, poivre et sel et un peu de café pour commencer sont fournis.\r\n- Les chiens ne sont pas autorisés.', 5, 2),
(3, 'Sleep Under The Stars, La Prairie Étoilée Glamping', '2022-08-27', '2022-09-22', '130.00', '', 2, 2),
(4, 'La Vue - les vues les plus incroyables !', '2022-08-27', '2022-10-21', '204.25', '', 2, 4),
(5, 'Chambre d\'hôtes caravane dans un charmant Moulin', '2022-08-01', '2022-09-30', '99.00', '', 0, 1),
(6, 'Suite ÖÖD avec vue sur le lac (pas de cuisine)', '2022-08-27', '2022-09-11', '100.65', '', 1, 3),
(7, 'Grange à bulles à Great Field Farm', '2022-08-27', '2022-09-11', '47.00', '', 2, 4),
(9, 'Séjour unique à Amsterdam The Crane by YAYS', '2022-09-10', '2022-09-30', '65.99', 'Comme si dormir dans une grue transformée n&#039;était pas assez exceptionnel, l&#039;intérieur de cet appartement unique de trois étages rend votre séjour encore plus spécial. De la vue spectaculaire sur la rivière IJ à la luxueuse salle de bain et cuisine, c&#039;est l&#039;endroit idéal pour échapper à l&#039;effervescence de la ville.\r\n\r\nLe logement\r\nCet appartement moderne, situé dans une grue portuaire monumentale, comprend une salle de bain, une baignoire et une douche séparée, une chambre avec un lit double et une vue fantastique sur la rivière IJ, un coin salon et une cuisine entièrement équipée avec lave-vaisselle.\r\n\r\nAutres remarques\r\nChaque voyageur recevra le guide de quartier YAYS lors de l&#039;enregistrement. Ce joli petit livret comprenant une carte, est rempli d&#039;endroits que les habitants visitent. Il sera certainement utile pendant votre séjour.\r\n\r\nVous cherchez à commander de la nourriture? Nos initiés sont prêts à vous aider avec les meilleures options de livraison de notre quartier\r\nNuméro d&#039;enregistrement\r\nDispensé', 6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `note` int(5) NOT NULL,
  `id` int(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `arrivee` date NOT NULL,
  `depart` date NOT NULL,
  `voyageurs` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `bienId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `arrivee`, `depart`, `voyageurs`, `prix`, `bienId`, `userId`) VALUES
(1, '2022-08-30', '2022-08-31', 3, '35.00', 2, 1),
(2, '2022-08-27', '2022-09-10', 4, '204.25', 4, 1),
(3, '2022-08-14', '2022-08-27', 1, '100.65', 6, 1),
(4, '2022-08-28', '2022-08-31', 5, '35.00', 2, 1),
(5, '2022-09-02', '2022-09-10', 2, '47.00', 7, 1),
(6, '2022-09-02', '2022-09-22', 2, '204.25', 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `typebiens`
--

CREATE TABLE `typebiens` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datecreation` datetime NOT NULL DEFAULT current_timestamp(),
  `datemiseajour` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `typebiens`
--

INSERT INTO `typebiens` (`id`, `libelle`, `datecreation`, `datemiseajour`) VALUES
(1, 'Terrain', '2022-08-22 18:37:42', '2022-08-22 18:37:42'),
(2, 'Camping car', '2022-08-22 18:37:42', '2022-08-22 18:37:42'),
(3, 'Mobil home', '2022-08-22 18:38:15', '2022-08-22 18:38:15'),
(4, 'Professionnel', '2022-08-25 22:29:49', '2022-08-25 22:29:49');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `motdepasse` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `datecreation` datetime NOT NULL DEFAULT current_timestamp(),
  `datemiseajour` datetime NOT NULL DEFAULT current_timestamp(),
  `cle` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `motdepasse`, `datecreation`, `datemiseajour`, `cle`, `statut`) VALUES
(1, 'WILLY', 'willyfkouadio@gmail.com', '$2y$10$xbZnMTSSowC2teQFJRASY.n1kwsbXNFotzKVSd8ThaJspI9.Flca6', '2022-08-21 20:44:29', '2022-08-21 20:44:29', NULL, 1),
(2, 'Morgane Regnaut', 'morgane.regnaut@numericable.com', '$2y$10$AnwwEtuqZMjC/55GQQA4HOSdFfnuEwnqS1CLMRy6ll2hQVfhCG9qu', '2022-08-28 12:51:16', '2022-08-28 12:51:16', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `biens`
--
ALTER TABLE `biens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biens_libelle_index` (`libelle`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typebiens`
--
ALTER TABLE `typebiens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typebiens_libelle_index` (`libelle`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `biens`
--
ALTER TABLE `biens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `typebiens`
--
ALTER TABLE `typebiens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
