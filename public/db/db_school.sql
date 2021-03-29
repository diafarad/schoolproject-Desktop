-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 nov. 2020 à 01:16
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_school`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `libelle` varchar(10) NOT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `montantInscription` int(11) NOT NULL,
  `serie` varchar(5) DEFAULT NULL,
  `mensualite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `libelle`, `niveau`, `montantInscription`, `serie`, `mensualite`) VALUES
(1, '1S1A', 'Première', 20000, 'S1', 15000),
(2, 'TL2C', 'Terminale', 20000, 'L2', 15000),
(3, '2SD', 'Seconde', 10000, 'S', 10000),
(4, '2LB', 'Seconde', 10000, 'L', 10000),
(6, '1L1B', 'Première', 15000, 'L1', 15000),
(7, 'TL2B', 'Terminale', 20000, 'L2', 15000),
(8, 'TS1A', 'Terminale', 20000, 'S1', 15000),
(9, '2LC', 'Seconde', 10000, 'L', 10000),
(10, 'TS1B', 'Terminale', 20000, 'S1', 15000),
(11, '2SA', 'Seconde', 12000, 'S', 10000),
(12, '2LA', 'Seconde', 12000, 'L', 10000),
(13, '1L1A', 'Première', 12000, 'L1', 10000),
(14, 'TS2A', 'Terminale', 20000, 'S2', 15000),
(15, 'TS2B', 'Terminale', 20000, 'S2', 15000),
(16, '2SB', 'Seconde', 20000, 'S', 15000),
(17, 'TL2A', 'Terminale', 20000, 'L2', 15000),
(18, 'TS2C', 'Terminale', 20000, 'S2', 15000),
(19, '1S2A', 'Première', 15000, 'S2', 10000),
(20, '2SC', 'Seconde', 12000, 'S', 10000);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idC` int(11) NOT NULL,
  `coef` int(11) NOT NULL,
  `matiere` int(11) NOT NULL,
  `professeur` varchar(10) CHARACTER SET latin1 NOT NULL,
  `classe` int(11) NOT NULL,
  `anneeAcad` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idC`, `coef`, `matiere`, `professeur`, `classe`, `anneeAcad`) VALUES
(1, 4, 5, 'pf_19885', 4, '2020-2021'),
(2, 3, 6, 'pf_19862', 4, '2020-2021'),
(3, 4, 3, 'pf_19833', 4, '2020-2021'),
(4, 3, 4, 'pf_19814', 4, '2020-2021'),
(5, 2, 1, 'pf_19821', 4, '2020-2021'),
(6, 2, 7, 'pf_19867', 4, '2020-2021'),
(7, 1, 9, 'pf_19879', 4, '2020-2021'),
(8, 2, 8, 'pf_19828', 4, '2020-2021'),
(9, 2, 2, 'pf_19826', 4, '2020-2021');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `mat` varchar(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `genre` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`mat`, `nom`, `prenom`, `date`, `lieu`, `mail`, `tel`, `genre`) VALUES
('mat_202010D', 'Dioum', 'Salif', '2000-12-24', 'Thiès', 'thierseck@mail.com', '784523010', 'm'),
('mat_202011D', 'Diagne', 'Mamy', '1999-01-31', 'Dakar', 'diagnemamy@mail.com', '786322010', 'f'),
('mat_202012D', 'Diouf', 'Penda Aissatou', '1995-07-18', 'Matam', 'penda@mail.com', '773021050', 'f'),
('mat_202013G', 'Gaye', 'Sokhna', '1998-02-15', 'Dakar', 'sokhnag@mail.com', '701308594', 'f'),
('mat_202014K', 'Kane', 'Kiné', '1996-10-14', 'Diourbel', 'kine@mail.com', '777523078', 'f'),
('mat_202015B', 'Bah', 'Gando', '2001-05-16', 'Podor', 'gando@mail.com', '789632045', 'm'),
('mat_202016D', 'Diouf', 'Pierre', '1999-11-11', 'matam', 'diafaradiallo@gmail.com', '778633314', 'm'),
('mat_202017S', 'Seck', 'Bamba', '2010-10-10', 'Louga', 'bamba@gmail.com', '767416584', 'm'),
('mat_20201D', 'Diallo', 'Diafara', '2010-10-10', 'Dakar', 'diafaradiallo@gmail.com', '778633314', 'm'),
('mat_20202D', 'Diallo', 'Karim', '1999-02-20', 'Thiaroye', 'diafaradiallo@gmail.com', '777777777', 'm'),
('mat_20203G', 'Gueye', 'Malick', '2000-02-02', 'Kedougou', 'diafaradiallo@gmail.com', '0789652030', 'm'),
('mat_20204S', 'Sene', 'Thiané', '1995-12-14', 'Matam', 'thiane@mail.com', '705423010', 'f'),
('mat_20205D', 'Diallo', 'Karim', '2000-02-20', 'Dakar', 'diafaradiallo@gmail.com', '777777777', 'm'),
('mat_20206S', 'Sene', 'Sophie', '1999-08-30', 'Thiès', 'sofia@mail.com', '785632010', 'f'),
('mat_20207G', 'Gueye', 'Modou', '2001-10-10', 'Bambey', 'modougueye@mail.org', '789652030', 'm'),
('mat_20208B', 'Balde', 'Fatima', '1999-10-10', 'Dakar', 'fatimebalde@mail.com', '776542010', 'f'),
('mat_20209S', 'Seck', 'Hamidou', '1999-04-30', 'Louga', 'hamseck@mail.com', '785632010', 'm');

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE `evaluation` (
  `idEv` int(11) NOT NULL,
  `libelleEv` varchar(100) NOT NULL,
  `typeEv` varchar(50) NOT NULL,
  `semestre` int(11) NOT NULL,
  `anneeAcad` varchar(10) NOT NULL,
  `classe` int(11) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evaluation`
--

INSERT INTO `evaluation` (`idEv`, `libelleEv`, `typeEv`, `semestre`, `anneeAcad`, `classe`, `idMatiere`, `statut`) VALUES
(1, 'Devoir de Mathématiques N°1', 'devoir', 1, '2020-2021', 1, 1, 1),
(2, 'Devoir de HG N°1', 'devoir', 1, '2020-2021', 1, 4, 1),
(3, 'Devoir de Mathématiques N°2', 'devoir', 1, '2020-2021', 1, 1, 1),
(4, 'Examen de Mathématiques 1', 'examen', 1, '2020-2021', 1, 1, 1),
(5, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 3, 3, 1),
(6, 'Devoir de PC N°1', 'devoir', 1, '2020-2021', 3, 2, 1),
(7, 'Devoir de Anglais N°1', 'devoir', 1, '2020-2021', 3, 5, 1),
(8, 'Devoir de Espagnol N°1', 'devoir', 1, '2020-2021', 6, 6, 1),
(9, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 6, 3, 1),
(10, 'Devoir de Français N°2', 'devoir', 1, '2020-2021', 6, 3, 1),
(11, 'Devoir Anglais N°1', 'devoir', 1, '2020-2021', 4, 5, 1),
(12, 'Devoir Espanol N°1', 'devoir', 1, '2020-2021', 4, 6, 1),
(13, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 7, 3, 1),
(14, 'Devoir de Mathématiques N°1', 'devoir', 1, '2020-2021', 7, 1, 1),
(15, 'Devoir de HG N°1', 'devoir', 1, '2020-2021', 7, 4, 1),
(16, 'Devoir de Français N°2', 'devoir', 1, '2020-2021', 7, 3, 1),
(17, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 4, 3, 1),
(18, 'Devoir de HG N°1', 'devoir', 1, '2020-2021', 4, 4, 1),
(19, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 2, 3, 1),
(20, 'Devoir de Mathématiques N°1', 'devoir', 1, '2020-2021', 2, 1, 1),
(21, 'Devoir de Mathématiques N°1', 'devoir', 1, '2020-2021', 8, 1, 0),
(22, 'Devoir de Mathématiques N°1', 'devoir', 1, '2020-2021', 6, 1, 1),
(23, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 1, 3, 1),
(24, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 8, 3, 0),
(25, 'Devoir de Mathématiques N°1', 'devoir', 1, '2020-2021', 4, 1, 1),
(26, 'Devoir de Français N°2', 'devoir', 1, '2020-2021', 4, 3, 1),
(27, 'Devoir de Mathématiques N°1', 'devoir', 1, '2020-2021', 3, 1, 0),
(28, 'Devoir Anglais N°1', 'devoir', 1, '2020-2021', 7, 5, 1),
(29, 'Devoir de Mathématiques N°2', 'devoir', 1, '2020-2021', 4, 1, 1),
(30, 'Devoir de HG N°2', 'devoir', 1, '2020-2021', 4, 4, 1),
(31, 'Devoir Anglais N°2', 'devoir', 1, '2020-2021', 4, 5, 1),
(32, 'Devoir Espagnol N°2', 'devoir', 1, '2020-2021', 4, 6, 1),
(33, 'Devoir de Français N°3', 'devoir', 1, '2020-2021', 4, 3, 1),
(34, 'Devoir Anglais N°3', 'devoir', 1, '2020-2021', 4, 5, 1),
(35, 'Examen Anglais N°1', 'examen', 1, '2020-2021', 4, 5, 1),
(36, 'Examen de Français N°1', 'examen', 1, '2020-2021', 4, 3, 1),
(37, 'Examen de HG N°1', 'examen', 1, '2020-2021', 4, 4, 1),
(38, 'Examen de Mathématiques N°1', 'examen', 1, '2020-2021', 4, 1, 1),
(39, 'Examen Espagnol N°1', 'examen', 1, '2020-2021', 4, 6, 1),
(40, 'Devoir Allemand N°1', 'devoir', 1, '2020-2021', 4, 7, 1),
(41, 'Devoir Allemand N°2', 'devoir', 1, '2020-2021', 4, 7, 1),
(42, 'Examen Allemand N°1', 'examen', 1, '2020-2021', 4, 7, 1),
(43, 'Devoir EPS N°1', 'devoir', 1, '2020-2021', 4, 9, 1),
(44, 'Devoir EPS N°2', 'devoir', 1, '2020-2021', 4, 9, 1),
(45, 'Examen EPS N°1', 'examen', 1, '2020-2021', 4, 9, 1),
(46, 'Devoir SVT N°1', 'devoir', 1, '2020-2021', 4, 8, 1),
(47, 'Devoir SVT N°2', 'devoir', 1, '2020-2021', 4, 8, 1),
(48, 'Examen SVT N°1', 'examen', 1, '2020-2021', 4, 8, 1),
(49, 'Devoir PC N°1', 'devoir', 1, '2020-2021', 4, 2, 1),
(50, 'Devoir PC N°2', 'devoir', 1, '2020-2021', 4, 2, 1),
(51, 'Examen PC N°1', 'examen', 1, '2020-2021', 4, 2, 1),
(52, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 6, 3, 0),
(53, 'Devoir de Français N°1', 'devoir', 1, '2020-2021', 9, 3, 0),
(54, 'Devoir de PC N°1', 'devoir', 1, '2020-2021', 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `anneeAcad` varchar(10) NOT NULL,
  `eleve` varchar(20) NOT NULL,
  `classe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id`, `date`, `anneeAcad`, `eleve`, `classe`) VALUES
(1, '2020-06-03', '2019-2020', 'mat_20201D', 3),
(2, '2020-06-03', '2020-2021', 'mat_20202D', 4),
(3, '0000-00-00', '2020-2021', 'mat_20203G', 2),
(4, '2020-06-03', '2020-2021', 'mat_20205D', 7),
(5, '2020-06-03', '2020-2021', 'mat_20206S', 4),
(6, '2020-06-04', '2020-2021', 'mat_20207G', 6),
(7, '2020-06-04', '2020-2021', 'mat_20208B', 3),
(8, '2020-06-04', '2020-2021', 'mat_20209S', 3),
(9, '2020-06-04', '2020-2021', 'mat_202010D', 3),
(10, '2020-06-04', '2020-2021', 'mat_202011D', 3),
(11, '2020-06-04', '2020-2021', 'mat_202012D', 3),
(12, '2020-06-04', '2020-2021', 'mat_202013G', 3),
(13, '2020-06-04', '2020-2021', 'mat_202014K', 2),
(14, '2020-06-04', '2020-2021', 'mat_202015B', 1),
(15, '2020-06-04', '2020-2021', 'mat_202016D', 2),
(16, '2020-06-05', '2020-2021', 'mat_202017S', 6),
(17, '2020-06-06', '2021-2022', 'mat_202010D', 1),
(18, '2020-06-07', '2021-2022', 'mat_202011D', 1),
(19, '2020-06-01', '2021-2022', 'mat_202012D', 1),
(20, '2020-06-09', '2021-2022', 'mat_202013G', 1),
(21, '2021-06-06', '2021-2022', 'mat_202010D', 8);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `libelle`) VALUES
(1, 'Mathématiques'),
(2, 'Sciences-Physiques'),
(3, 'Français'),
(4, 'Histoire-Géographie'),
(5, 'Anglais'),
(6, 'Espagnol'),
(7, 'Allemand'),
(8, 'SVT'),
(9, 'EPS'),
(10, 'Philosophie'),
(11, 'Informatique'),
(12, 'Arabe');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `idN` int(11) NOT NULL,
  `valeur` double DEFAULT NULL,
  `semestre` int(11) NOT NULL,
  `anneeAcad` varchar(10) CHARACTER SET latin1 NOT NULL,
  `eleve` varchar(20) CHARACTER SET latin1 NOT NULL,
  `evaluation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`idN`, `valeur`, `semestre`, `anneeAcad`, `eleve`, `evaluation`) VALUES
(1, 18, 1, '2020-2021', 'mat_20208B', 5),
(2, 12, 1, '2020-2021', 'mat_202011D', 5),
(3, 15, 1, '2020-2021', 'mat_202012D', 5),
(4, 17, 1, '2020-2021', 'mat_202010D', 5),
(5, 13, 1, '2020-2021', 'mat_202013G', 5),
(6, 16, 1, '2020-2021', 'mat_20209S', 5),
(7, 19, 1, '2020-2021', 'mat_20208B', 7),
(8, 16, 1, '2020-2021', 'mat_202011D', 7),
(9, 11, 1, '2020-2021', 'mat_202012D', 7),
(10, 13, 1, '2020-2021', 'mat_202010D', 7),
(11, 14, 1, '2020-2021', 'mat_202013G', 7),
(12, 12, 1, '2020-2021', 'mat_20209S', 7),
(13, 17, 1, '2020-2021', 'mat_20208B', 6),
(14, 12, 1, '2020-2021', 'mat_202011D', 6),
(15, 14, 1, '2020-2021', 'mat_202012D', 6),
(16, 16, 1, '2020-2021', 'mat_202010D', 6),
(17, 12, 1, '2020-2021', 'mat_202013G', 6),
(18, 13, 1, '2020-2021', 'mat_20209S', 6),
(19, 17, 1, '2020-2021', 'mat_202015B', 2),
(20, 18, 1, '2020-2021', 'mat_202015B', 1),
(21, 16, 1, '2020-2021', 'mat_202015B', 3),
(22, 16, 1, '2020-2021', 'mat_202015B', 4),
(23, 14, 1, '2020-2021', 'mat_20207G', 8),
(24, 13, 1, '2020-2021', 'mat_202017S', 8),
(25, 14, 1, '2020-2021', 'mat_20207G', 9),
(26, 15, 1, '2020-2021', 'mat_202017S', 9),
(27, 13, 1, '2020-2021', 'mat_20207G', 10),
(28, 15, 1, '2020-2021', 'mat_202017S', 10),
(29, 17, 1, '2020-2021', 'mat_20202D', 11),
(30, 16, 1, '2020-2021', 'mat_20206S', 11),
(31, 13, 1, '2020-2021', 'mat_20202D', 12),
(32, 16, 1, '2020-2021', 'mat_20206S', 12),
(33, 14, 1, '2020-2021', 'mat_20205D', 13),
(34, 12, 1, '2020-2021', 'mat_20205D', 14),
(35, 15, 1, '2020-2021', 'mat_20205D', 15),
(36, 12, 1, '2020-2021', 'mat_20205D', 16),
(37, 13, 1, '2020-2021', 'mat_20202D', 17),
(38, 14.5, 1, '2020-2021', 'mat_20206S', 17),
(39, 15.5, 1, '2020-2021', 'mat_20202D', 18),
(40, 17.5, 1, '2020-2021', 'mat_20206S', 18),
(41, 14, 1, '2020-2021', 'mat_202016D', 19),
(42, 16, 1, '2020-2021', 'mat_20203G', 19),
(43, 12, 1, '2020-2021', 'mat_202014K', 19),
(44, 14, 1, '2020-2021', 'mat_202016D', 20),
(45, 10.5, 1, '2020-2021', 'mat_20203G', 20),
(46, 12.75, 1, '2020-2021', 'mat_202014K', 20),
(47, 12.5, 1, '2020-2021', 'mat_20207G', 22),
(48, 13.5, 1, '2020-2021', 'mat_202017S', 22),
(49, 17.5, 1, '2020-2021', 'mat_202015B', 23),
(50, 14, 1, '2020-2021', 'mat_20202D', 25),
(51, 16.5, 1, '2020-2021', 'mat_20206S', 25),
(52, 13.5, 1, '2020-2021', 'mat_20202D', 26),
(53, 16, 1, '2020-2021', 'mat_20206S', 26),
(54, 15, 1, '2020-2021', 'mat_20205D', 28),
(55, 17, 1, '2020-2021', 'mat_20202D', 29),
(56, 12, 1, '2020-2021', 'mat_20206S', 29),
(57, 15, 1, '2020-2021', 'mat_20202D', 30),
(58, 12, 1, '2020-2021', 'mat_20206S', 30),
(59, 14, 1, '2020-2021', 'mat_20202D', 31),
(60, 10, 1, '2020-2021', 'mat_20206S', 31),
(61, 13, 1, '2020-2021', 'mat_20202D', 32),
(62, 12, 1, '2020-2021', 'mat_20206S', 32),
(63, 17.5, 1, '2020-2021', 'mat_20202D', 33),
(64, 12, 1, '2020-2021', 'mat_20206S', 33),
(65, 15, 1, '2020-2021', 'mat_20202D', 34),
(66, 16, 1, '2020-2021', 'mat_20206S', 34),
(67, 17, 1, '2020-2021', 'mat_20202D', 35),
(68, 14.5, 1, '2020-2021', 'mat_20206S', 35),
(69, 13.5, 1, '2020-2021', 'mat_20202D', 36),
(70, 16, 1, '2020-2021', 'mat_20206S', 36),
(71, 15, 1, '2020-2021', 'mat_20202D', 37),
(72, 16, 1, '2020-2021', 'mat_20206S', 37),
(73, 13, 1, '2020-2021', 'mat_20202D', 38),
(74, 12, 1, '2020-2021', 'mat_20206S', 38),
(75, 16, 1, '2020-2021', 'mat_20202D', 39),
(76, 16, 1, '2020-2021', 'mat_20206S', 39),
(77, 12.5, 1, '2020-2021', 'mat_20202D', 40),
(78, 13.75, 1, '2020-2021', 'mat_20206S', 40),
(79, 13, 1, '2020-2021', 'mat_20202D', 41),
(80, 13.5, 1, '2020-2021', 'mat_20206S', 41),
(81, 15, 1, '2020-2021', 'mat_20202D', 43),
(82, 10, 1, '2020-2021', 'mat_20206S', 43),
(83, 12.5, 1, '2020-2021', 'mat_20202D', 44),
(84, 9.5, 1, '2020-2021', 'mat_20206S', 44),
(85, 10, 1, '2020-2021', 'mat_20202D', 45),
(86, 8.5, 1, '2020-2021', 'mat_20206S', 45),
(87, 8, 1, '2020-2021', 'mat_20202D', 49),
(88, 8.5, 1, '2020-2021', 'mat_20206S', 49),
(89, 10, 1, '2020-2021', 'mat_20202D', 50),
(90, 9.5, 1, '2020-2021', 'mat_20206S', 50),
(91, 11, 1, '2020-2021', 'mat_20202D', 51),
(92, 10, 1, '2020-2021', 'mat_20206S', 51),
(93, 10, 1, '2020-2021', 'mat_20202D', 42),
(94, 11.25, 1, '2020-2021', 'mat_20206S', 42),
(95, 7.5, 1, '2020-2021', 'mat_20202D', 46),
(96, 10, 1, '2020-2021', 'mat_20206S', 46),
(97, 10, 1, '2020-2021', 'mat_20202D', 47),
(98, 11.5, 1, '2020-2021', 'mat_20206S', 47),
(99, 9, 1, '2020-2021', 'mat_20202D', 48),
(100, 8.5, 1, '2020-2021', 'mat_20206S', 48),
(101, 15.5, 1, '2020-2021', 'mat_202015B', 54);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `mat` varchar(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(150) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `genre` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`mat`, `nom`, `prenom`, `date`, `lieu`, `mail`, `tel`, `genre`) VALUES
('pf_19814', 'Mbengue', 'Moustapha', '1981-11-30', 'Dakar', 'mbenguetapha@mail.com', '779286410', 'm'),
('pf_19821', 'Baldé', 'Malick', '1982-05-10', 'Dakar', 'baldemalick@mail.com', '779023547', 'm'),
('pf_19826', 'Bah', 'Khalifa', '1982-11-11', 'Louga', 'khalifaba@mail.org', '772030505', 'm'),
('pf_19828', 'Mane', 'Astou', '1982-07-05', 'Thiès', 'astoumane@mail.org', '776823042', 'f'),
('pf_19833', 'Sall', 'Maimouna', '1983-03-19', 'Dakar', 'sallmay@mail.com', '774527899', 'f'),
('pf_19862', 'Sagna', 'Ramatoulaye', '1986-07-08', 'Louga', 'sagnarama@mail.com', '776985320', 'f'),
('pf_19867', 'Diouf', 'Aminata', '1986-08-12', 'Dakar', 'aminadiouf@mail.org', '776503042', 'f'),
('pf_19879', 'Sarr', 'Boubacar', '1987-04-30', 'Dakar', 'boubacarsarr@mail.com', '774562030', 'm'),
('pf_19885', 'Sow', 'Diariatou', '1988-08-27', 'Dakar', 'diariatou@mail.com', '771456233', 'f');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idC`),
  ADD KEY `matiere` (`matiere`),
  ADD KEY `professeur` (`professeur`),
  ADD KEY `classe` (`classe`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`mat`);

--
-- Index pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`idEv`),
  ADD KEY `idMatiere` (`idMatiere`),
  ADD KEY `classe` (`classe`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eleve` (`eleve`),
  ADD KEY `classe` (`classe`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`idN`),
  ADD KEY `eleve` (`eleve`),
  ADD KEY `evaluation` (`evaluation`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`mat`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `idEv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `idN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`matiere`) REFERENCES `matiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cours_ibfk_2` FOREIGN KEY (`professeur`) REFERENCES `professeur` (`mat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cours_ibfk_3` FOREIGN KEY (`classe`) REFERENCES `classe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`idMatiere`) REFERENCES `matiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_ibfk_2` FOREIGN KEY (`classe`) REFERENCES `classe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`classe`) REFERENCES `classe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`mat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`mat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`evaluation`) REFERENCES `evaluation` (`idEv`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
