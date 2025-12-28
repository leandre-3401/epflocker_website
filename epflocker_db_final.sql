-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 03:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epflocker_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `casier`
--

CREATE TABLE `casier` (
  `ID_Casier` varchar(4) NOT NULL,
  `Fonction` varchar(20) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `casier`
--

INSERT INTO `casier` (`ID_Casier`, `Fonction`, `Status`) VALUES
('A1', 'Work', 1),
('A2', 'Work', 0),
('A3', 'Work', 0),
('A4', 'Test', 0),
('B1', 'Work', 0),
('B2', 'Work', 0),
('B3', 'Work', 0),
('B4', 'Work', 0),
('C1', 'Work', 0),
('C2', 'Work', 0),
('C3', 'Work', 0),
('C4', 'Work', 0),
('D1', 'Work', 1),
('D2', 'Work', 1),
('D3', 'Work', 1),
('D4', 'Work', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emprunt`
--

CREATE TABLE `emprunt` (
  `ID_Casier` varchar(4) NOT NULL,
  `Date_emprunt` date NOT NULL,
  `Code_acces` varchar(50) NOT NULL,
  `Date_retour` date DEFAULT NULL,
  `Adresse_email` varchar(50) NOT NULL,
  `nombre_actions` int(11) NOT NULL DEFAULT 2,
  `id_produit` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emprunt`
--

INSERT INTO `emprunt` (`ID_Casier`, `Date_emprunt`, `Code_acces`, `Date_retour`, `Adresse_email`, `nombre_actions`, `id_produit`, `type`, `quantite`) VALUES
('A1', '2024-05-11', 'mcjOswaPJG', '2024-05-18', '', 2, 3, 'Emprunt', 1),
('A1', '2024-05-18', 'b3zAKDAucH', '2024-05-18', 'loic@gmail.com', 2, 3, 'Emprunt', 1),
('A1', '2024-05-18', 'spHcnP2KJA', '2024-05-18', 'loic@gmail.com', 2, 3, 'Emprunt', 4),
('A1', '2024-05-18', 'BtLhG0MPlX', '2024-05-18', 'loic@gmail.com', 2, 5, 'Emprunt', 4),
('A1', '2024-05-18', 'ZJebyQf42h', '2024-05-22', 'loic@gmail.com', 2, 4, 'Emprunt', 1),
('A1', '2024-05-18', 'wNrY7HWJQp', '2024-05-22', 'loic@gmail.com', 2, 3, 'Emprunt', 3),
('A1', '2024-05-18', 'iPH5ruL2TF', '2024-05-22', 'loic@gmail.com', 2, 6, 'Emprunt', 2),
('A1', '2024-05-18', 'K7mbjSDpcB', '2024-05-22', 'loic@gmail.com', 2, 3, 'Emprunt', 2),
('C3', '2024-05-18', '1qj6EjVbgd', '2024-05-22', 'loic@gmail.com', 0, 0, '', 0),
('B2', '2024-05-22', 'pY3WZ0gBRn', '2024-05-23', 'loic@gmail.com', 0, 0, '', 0),
('A1', '2024-05-22', 'kDygo0JmOO', '2024-05-22', 'loic@gmail.com', 2, 5, 'Emprunt', 1),
('C2', '2024-05-22', 'zCiCeEqny1', NULL, 'loic@gmail.com', 0, 0, '', 0),
('B3', '2024-05-22', 'n7nvySma7B', NULL, 'loic@gmail.com', 0, 0, 'Reservation', 0),
('C4', '2024-05-22', 'SkOybDsTlw', NULL, 'loic@gmail.com', 0, 0, 'Reservation', 0),
('A1', '2024-05-22', 'Uwkh7zIVdQ', '2024-05-22', 'loic@gmail.com', 2, 4, 'Emprunt', 3),
('A1', '2024-05-22', 'LcH57rxBRt', '2024-05-22', 'loic@gmail.com', 2, 0, 'Emprunt', 1),
('A1', '2024-05-22', 'mTWd7yyiwr', '2024-05-22', 'loic@gmail.com', 2, 0, 'Emprunt', -11),
('A1', '2024-05-22', '0D7xmpmT9y', '2024-05-22', 'loic@gmail.com', 2, 0, 'Emprunt', 1),
('A1', '2024-05-22', '2tXEjBgR5j', '2024-05-22', 'loic@gmail.com', 2, 0, 'Emprunt', 1),
('A1', '2024-05-22', 'OdVbPwW4OM', '2024-05-22', 'loic@gmail.com', 2, 0, 'Emprunt', 2),
('A1', '2024-05-22', 's893ewmXhk', '2024-05-22', 'loic@gmail.com', 2, 4, 'Emprunt', 0),
('A1', '2024-05-22', '', '2024-05-22', 'loic@gmail.com', 2, 1, 'Emprunt', 1),
('A1', '2024-05-22', '', '2024-05-22', 'loic@gmail.com', 2, 1, 'Emprunt', 1),
('A1', '2024-05-22', 't4GbhrBZOb', '2024-05-22', 'loic@gmail.com', 2, 1, 'Emprunt', 1),
('A1', '2024-05-22', 'X6oCgNtnUZ', '2024-05-22', 'loic@gmail.com', 2, 1, 'Emprunt', 1),
('A1', '2024-05-22', '', '2024-05-22', 'loic@gmail.com', 2, 4, 'Emprunt', 1),
('A1', '2024-05-22', 'iGWbiKJUTTyKAJzSnfCC', '2024-05-22', 'loic@gmail.com', 2, 4, 'Emprunt', 2),
('A1', '2024-05-22', 'uqFnEMLjxdABeVYixXAY', NULL, 'loic@gmail.com', 2, 1, 'Emprunt', 1),
('A1', '2024-05-22', 'Pc9L3gd70l44CgZ1qGV2', NULL, 'loic@gmail.com', 2, 4, 'Emprunt', 1),
('B1', '2024-05-23', 'zY3LWJ5IE0', '2024-05-23', 'loic@gmail.com', 0, 0, 'Reservation', 0),
('B4', '2024-05-26', '9AOqwK1W3z', NULL, 'leandre@epfedu.fr', 0, 0, 'Reservation', 0),
('A1', '2024-05-26', 'vdx9wGKsKxkPnR5XXEiA', NULL, 'leandre@epfedu.fr', 2, 4, 'Emprunt', 1),
('C1', '2024-05-26', 'a64vGDz9CX', '2024-05-26', 'leandre@epfedu.fr', 0, 0, 'Reservation', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `quantite` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `quantite`) VALUES
(1, 'PC', 1),
(3, 'Rallonge', 0),
(4, 'Cable HDMI', 2),
(5, 'Souris', 0),
(6, 'Clavier', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblauthsessions`
--

CREATE TABLE `tblauthsessions` (
  `intAuthID` int(11) NOT NULL,
  `txtSessionKey` varchar(255) DEFAULT NULL,
  `dtExpires` datetime DEFAULT NULL,
  `txtRedir` varchar(255) DEFAULT NULL,
  `txtRefreshToken` text DEFAULT NULL,
  `txtCodeVerifier` varchar(255) DEFAULT NULL,
  `txtToken` text DEFAULT NULL,
  `txtIDToken` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Adresse_mail` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Adresse_mail`, `Password`, `Level`) VALUES
('loic@gmail.com', 'Akal', 1),
('leandre@epfedu.fr', 'leandre', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casier`
--
ALTER TABLE `casier`
  ADD PRIMARY KEY (`ID_Casier`);

--
-- Indexes for table `emprunt`
--
ALTER TABLE `emprunt`
  ADD KEY `fk_emprunt_casier` (`ID_Casier`),
  ADD KEY `fk_emprunt_email` (`Adresse_email`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblauthsessions`
--
ALTER TABLE `tblauthsessions`
  ADD PRIMARY KEY (`intAuthID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Adresse_mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblauthsessions`
--
ALTER TABLE `tblauthsessions`
  MODIFY `intAuthID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
