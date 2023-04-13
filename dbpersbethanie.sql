-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 08 fév. 2023 à 21:24
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbpersbethanie`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_compte` int(11) NOT NULL,
  `login` varchar(40) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `mdp_crypted` text NOT NULL,
  `profil_compte` varchar(20) NOT NULL,
  `date_creation` date NOT NULL,
  `heure_creation` time NOT NULL,
  `statut_compte` varchar(25) NOT NULL,
  `date_suppression` date DEFAULT NULL,
  `heure_suppression` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `historiquepersonne`
--

CREATE TABLE `historiquepersonne` (
  `id_historique` int(11) NOT NULL,
  `texte` text NOT NULL,
  `date_historique` date NOT NULL,
  `heure_historique` time NOT NULL,
  `supprime` tinyint(1) NOT NULL,
  `personne_concerne` int(11) DEFAULT NULL,
  `compte_concerne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `lienparente`
--

CREATE TABLE `lienparente` (
  `id_lien` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `definition` text NOT NULL,
  `sexe_particulier` char(1) DEFAULT NULL
) ;

--
-- Déchargement des données de la table `lienparente`
--

INSERT INTO `lienparente` (`id_lien`, `libelle`, `definition`, `sexe_particulier`) VALUES
(1, 'Adutérin', 'Se dit d\'un enfant né d\'une union extraconjugale', NULL),
(2, 'Affinité', 'Parenté par alliance. C\'est le contraire de consanguin. Epouse, pour un veuf, une cousine de sa première femme nécessitait sous l\'Ancien régime d\'obtenir de l\'évêque une dispense d\'affinité.', NULL),
(3, 'Agnatique', 'Qui se rapporte aux agnats. Tous portent le même patronyme. Généalogie de père en fils. On ne s\'occupe que de la branche paternelle de chaque individu.', NULL),
(4, 'Aïeul(e)', 'Sous l\'ancien régime signifie. Grand-père ou grand-mère', NULL),
(5, 'Aïeux', 'Aujourd\'hui veut dire Ancêtres', NULL),
(6, 'Aîné(e)', 'Premier enfant d\'un couple ou d\'une famille', NULL),
(7, 'Allié(e)', 'Parent par alliance. Belle-famille, par opposition aux parents consanguins.', NULL),
(8, 'Ancêtre', 'Ascendant antérieur aux parents', NULL),
(9, 'Ancêtres', 'Ceux qui ont vécu avant nous, aïeux', NULL),
(10, 'Apparenté(e)', 'Allié, en particulier par le mariage', NULL),
(11, 'Arrière-cousin', 'Cousin à un degré éloigné', NULL),
(12, 'Arrière-grand-mère', 'Mère du grand-père ou de la grand-mère ou Bisaïeule', 'F'),
(13, 'Arrière-grand-oncle', 'Frère de l\'arrière-grand-père ou de l\'arrière-grand-mère', 'M'),
(14, 'Arrière-grand-père', 'Père du grand-père ou de la grand-mère ou Bisaïeul', 'M'),
(15, 'Arrière-grands-parents', 'Le père et la mère des grands-parents', NULL),
(16, 'Arrière-grand-tante', 'Soeur de l\'arrière-grand-père ou de l\'arrière-grand-mère', 'F'),
(17, 'Arrière-neveu, arrière-nièce', 'Fils, fille du neveu ou de la nièce. Synonyme petit-neveu, petite-nièce', NULL),
(18, 'Arrière-petit-fils, arrière-petite-fille', 'Fils, fille du petit-fils ou de la petite-fille', NULL),
(19, 'Arrière-petit-neveu, arrière-petite-nièce', 'Fils, fille d\'un petit-neveu, d\'une petite-nièce', NULL),
(20, 'Arrière-petits-enfants', 'Enfants du petit-fils, de la petite-fille', NULL),
(21, 'Ascendance', 'Ensemble des générations dont est issue une personne', NULL),
(22, 'Ascendant', 'Qui va en montant ou en progressant', NULL),
(23, 'Bâtard', 'Se dit d\'un enfant qui n\'est pas légitime. Né hors du mariage', NULL),
(24, 'Beau-fils', '1. Gendre.\r\n2. Celui dont on a épousé le père ou la mère', 'M'),
(25, 'Beau-frère', '1. Mari de la soeur ou de la belle-sœur.\r\n2. Frère du mari ou de la femme', 'M'),
(26, 'Beau-père', '1. Père de la femme par rapport au mari.\r\n2. Second marie de la mère par rapport aux enfants de celle-ci.', 'M'),
(27, 'Beaux-parents', 'Père et mère du conjoint', NULL),
(28, 'Belle-famille', 'Famille du mari ou de la femme', NULL),
(29, 'Belle-fille', '1. Femme du fils.\r\n2. Celle dont on a épouse le père ou la mère. ', 'F'),
(30, 'Belle-mère', '1. Mère du mari par rapport à la femme ou de la femme par rapport au mari.\r\n2. Seconde femme du père, par rapport aux enfants de celui-ci', 'F'),
(31, 'Belle-soeur', '1. Femme du frère ou du beau-frère.\r\n2. Sœur du mari ou de la femme', NULL),
(32, 'Benjamin(e)', 'Dernier enfant d\'un couple ou d\'une famille', NULL),
(33, 'Bisaïeul(e)', 'Un des 4 arrière-grands-pères ou grands-mères', NULL),
(34, 'Branche cadette', '1. Partie d\'une famille\r\n2. Lignée, famille issue du cadet des enfants.', NULL),
(35, 'Bru', 'Femme ou épouse du fils, belle-fille', 'F'),
(36, 'Cadet, cadette', '1. Enfant qui vient après l\'aîné ou qui est plus jeune qu\'un ou plusieurs enfants de la même famille.\r\n2. Personne moins âgée qu\'une autre.', NULL),
(37, 'Célibataire', 'Qui n\'est pas marié', NULL),
(38, 'Cognatique', 'Parent par les femmes. L\'ascendance cognatique est l\'ascendance par les femmes', NULL),
(39, 'Collatéral(e)(aux)', 'Qui est hors de la ligne directe de parenté. (Oncles, tantes, cousins sont des collatéraux)', NULL),
(40, 'Concubin', 'Qui vit avec quelqu\'un sans être marié', NULL),
(41, 'Conjoint(e)', 'Chacun des époux par rapport à l\'autre', NULL),
(42, 'Couple', 'Famille formée par deux conjoints ou concubins. Couple n\'induit pas le mariage', NULL),
(43, 'Cousin(e) germain(e)', 'Né(e) du frère ou de la soeur du père ou de la mère', NULL),
(44, 'Cousin(e)s issu(e)s de germain(e)s', 'Personnes nées de cousins germains', NULL),
(45, 'Cousin(e)', 'Personne issue de l\'oncle ou de la tante', NULL),
(46, 'Demi-frère', 'Frère par le père ou la mère seulement', 'M'),
(47, 'Demi-soeur', 'Sœur par le père ou la mère seulement', 'F'),
(48, 'Dispense de consanguinité', 'Acte par lequel le pape ou l\'évêque autorise un curé à marier deux promis malgré une parenté proche', NULL),
(49, 'Dynastie', '\"Grande\" famille', NULL),
(50, 'Enfant', 'Fils ou fils quel que soit l\'âge', NULL),
(51, 'Enfant adoptif', 'Enfant par l\'effet de l\'adoption ', NULL),
(52, 'Enfant adultérin', 'Se dit d\'un enfant né d\'une union extraconjugale. Si le père et la mère sont mariés chacun de leur côté, l\'enfant est \"doublement adultérin\"', NULL),
(53, 'Enfant du premier, du second lit', 'Enfant d\'un premier mariage, d\'un second mariage', NULL),
(54, 'Enfant illégitime', 'Enfant né hors mariage et qui n\'a pas été légitimé', NULL),
(55, 'Enfant légitime', 'Né de parents mariés (par opposition à enfant naturel)', NULL),
(56, 'Enfant naturel', 'Enfant né hors mariage (par opposition à enfant légitime)', NULL),
(57, 'Famille', 'Ensemble formé par le père, la mère et les enfants Les enfants d\'un couple Ensemble de personnes qui ont des liens de parenté par le sang ou par alliance', NULL),
(58, 'Filiation', 'Lien de parenté unissant ascendants et descendants. Une filiation peut être agnatique ou cognatique', NULL),
(59, 'Fille', 'Personne du sexe féminin considérée par rapport à ses parents (par opposition à fils)', 'F'),
(60, 'Filleul(e)', 'Celui, celle dont on est le parrain, la marraine', NULL),
(61, 'Fils', 'Personne du sexe masculin considérée par rapport à ses parents (par opposition à fille)', 'M'),
(62, 'Frère', 'Né du même père et de la même mère', 'M'),
(63, 'Frère consanguin', 'Qui est issu du même père mais pas de la même mère', 'M'),
(64, 'Frère germain', 'Qui est issu du même père et de la même mère', 'M'),
(65, 'Frère utérin', 'Qui est né de la même mère, mais pas du même père', 'M'),
(66, 'Gendre', 'Mari ou époux par rapport aux parents de celle-ci', 'M'),
(67, 'Grand-mère', 'Mère du père ou de la mère', 'F'),
(68, 'Grand-oncle', 'Frère du grand-père ou de la grand-mère', 'M'),
(69, 'Grand-père', 'Père du père ou de la mère', 'M'),
(70, 'Grands-parents', 'Le grand-père et la grand-mère', NULL),
(71, 'Grand-tante', 'Soeur du grand-père ou de la grand-mère', 'F'),
(72, 'Incestueux (Enfant)', 'Enfant né sous l\'Ancien Régime de parents qui ne pouvaient se marier sans dispense de consanguinité', NULL),
(73, 'Lignage', 'Ensemble de parents issus d\'une souche commune', NULL),
(74, 'Ligne', 'Suite des descendants d\'une même famille. Le premier aïeul est l\'auteur commun de la ligne. De lui à tous ses descendants, on parle de \"ligne directe\".', NULL),
(75, 'Mari', 'Époux, conjoint', 'M'),
(76, 'Marraine', 'Femme qui présente un enfant au baptême.', 'F'),
(77, 'Mère célibataire', 'Femme ayant un ou plusieurs enfants sans être mariée', 'F'),
(78, 'Mère', 'Femme qui a mis au monde un ou plusieurs enfants. Mère de famille', 'F'),
(79, 'Neveu', 'Fils du frère ou de la soeur', 'M'),
(80, 'Nièce', 'Fille du frère ou de la soeur', 'F'),
(81, 'Oncle', '1. Frère du père ou de la mère.\r\n2. époux de la tante', 'M'),
(82, 'Parent éloigné', 'Avec qui la personne considérée a des liens de parenté indirects', NULL),
(83, 'Parent proche', 'Qui a d\'étroites relations de parenté', NULL),
(84, 'Parenté', '1. Line de consanguinité ou d\'alliance.\r\n2. Ensemble de parents', NULL),
(85, 'Parentèle', 'Lien de parenté; consanguinité Ensemble des parents', NULL),
(86, 'Parents', '1. Personne qui a des liens familiaux plus ou moins étroits avec quelqu\'un\r\n2. Le père ou la mère', NULL),
(87, 'Parrain', 'Celui qui présente un enfant au baptême', 'M'),
(88, 'Père', 'Celui qui a un ou plusieurs enfants. Père de famille', 'M'),
(89, 'Petit-cousin', 'Enfant né de cousin(e) germain(e)', NULL),
(90, 'Petite-fille', 'Fille du fils ou de la fille, par rapport à un grand-père, à une grand-mère', 'F'),
(91, 'Petit-fils', 'Fils du fils ou de la fille, par rapport à un grand-père, à une grand-mère', 'M'),
(92, 'Petit-neveu, petite-nièce', 'Fils, fille du neveu ou de la nièce. Synonyme arrière-neveu, arrière-nièce', NULL),
(93, 'Petits-enfants', 'Enfants du fils ou de la fille', NULL),
(94, 'Rejeton', 'Descendant, enfant Le dernier rejeton d\'une famille', NULL),
(95, 'Soeur consanguine', 'Qui est issus du même père mais non de la même mère', 'F'),
(96, 'Soeur germaine', 'Qui est née même père et de la même mère', 'F'),
(97, 'Soeur utérine', 'Qui est nées de la même mère, mais non du même père', 'F'),
(98, 'Soeur', 'Née du même père et de la même mère', 'F'),
(99, 'Tante', '1. Soeur du père ou de la mère.\r\n2. femme de l\'oncle', 'F'),
(100, 'Trisaïeul, e', 'Un des 8 arrière-arrière-grands-pères ou grands-mères', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lienpersonne`
--

CREATE TABLE `lienpersonne` (
  `lien` int(11) NOT NULL,
  `personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id_personne` int(11) NOT NULL,
  `sexe` char(1) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `mel` varchar(100) DEFAULT NULL,
  `telfixe` varchar(50) DEFAULT NULL,
  `telportable` varchar(50) DEFAULT NULL,
  `telfax` varchar(50) DEFAULT NULL,
  `telfixepro` varchar(50) DEFAULT NULL,
  `telportablepro` varchar(20) DEFAULT NULL,
  `telfaxpro` varchar(50) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `adresse_comp` varchar(50) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `quartierville` varchar(50) DEFAULT NULL,
  `numboite_appt` varchar(30) DEFAULT NULL,
  `statut_personne` varchar(20) NOT NULL
) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_compte`);

--
-- Index pour la table `historiquepersonne`
--
ALTER TABLE `historiquepersonne`
  ADD PRIMARY KEY (`id_historique`),
  ADD KEY `fk_hp` (`personne_concerne`),
  ADD KEY `fk_hc` (`compte_concerne`);

--
-- Index pour la table `lienparente`
--
ALTER TABLE `lienparente`
  ADD PRIMARY KEY (`id_lien`),
  ADD UNIQUE KEY `uniquelien` (`libelle`);

--
-- Index pour la table `lienpersonne`
--
ALTER TABLE `lienpersonne`
  ADD PRIMARY KEY (`lien`,`personne`),
  ADD KEY `fk_lpp` (`personne`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id_personne`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historiquepersonne`
--
ALTER TABLE `historiquepersonne`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lienparente`
--
ALTER TABLE `lienparente`
  MODIFY `id_lien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id_personne` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historiquepersonne`
--
ALTER TABLE `historiquepersonne`
  ADD CONSTRAINT `fk_hc` FOREIGN KEY (`compte_concerne`) REFERENCES `compte` (`id_compte`),
  ADD CONSTRAINT `fk_hp` FOREIGN KEY (`personne_concerne`) REFERENCES `personne` (`id_personne`);

--
-- Contraintes pour la table `lienpersonne`
--
ALTER TABLE `lienpersonne`
  ADD CONSTRAINT `fk_lpl` FOREIGN KEY (`lien`) REFERENCES `lienparente` (`id_lien`),
  ADD CONSTRAINT `fk_lpp` FOREIGN KEY (`personne`) REFERENCES `personne` (`id_personne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
