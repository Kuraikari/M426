-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Feb 2018 um 11:45
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `boss`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userFk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `cart`
--

INSERT INTO `cart` (`id`, `userFk`) VALUES
(2, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart_product`
--

CREATE TABLE `cart_product` (
  `productFk` int(11) NOT NULL,
  `cartFk` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `cart_product`
--

INSERT INTO `cart_product` (`productFk`, `cartFk`, `amount`) VALUES
(2, 1, 0),
(2, 1, 0),
(2, 1, 0),
(4, 1, 0),
(1, 1, 0),
(1, 2, 1),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(1, 'Electronic'),
(2, 'Clothes'),
(3, 'Vehicle'),
(4, 'Accessoires');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `cartFk` int(11) NOT NULL,
  `userFk` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `reviewFk` int(11) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(64) NOT NULL,
  `description` varchar(5024) NOT NULL,
  `date` date NOT NULL,
  `userFk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`id`, `reviewFk`, `name`, `price`, `image`, `description`, `date`, `userFk`, `quantity`) VALUES
(1, NULL, 'Rolex', 7000, 'rolexSubmariner.jpg', 'Rolex - Submariner Date\r\nIt&#039;s been used. In good conditon. It&#039;s 10 years old.', '2018-01-28', 1, 10),
(2, NULL, 'Audemars Piguet', 150000, 'APRoyalOak.jpg', 'Audemars Piguet Tourbillon Concept GMT Titanium 26560IO.OO.D002CA.01.Titanium case with a black rubber strap, ( The watch is pictured with the black Croc strap which I will be keeping - or can sell to you for an extra $1000) The watch is in 100% perfect working condition - absolutely no marks on the case whatsoever... imperceptible from new. Includes Box, Key and all papers and booklets.', '2018-01-28', 1, 0),
(3, NULL, 'Lamborghini', 300000, 'lambo.jpg', 'Nice car', '2018-01-29', 6, 0),
(4, NULL, 'Louis Vuittion Supreme', 1250, 'louisvuittonSupreme.jpg', 'Louis Vuittion Supreme Jacket. Rare and new.', '2018-02-01', 6, 5),
(5, NULL, 'Rolex submariner', 0, 'rolexSubmariner.jpg', '', '2018-02-01', 5, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_categorie`
--

CREATE TABLE `product_categorie` (
  `categorieFk` int(11) NOT NULL,
  `productFk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `product_categorie`
--

INSERT INTO `product_categorie` (`categorieFk`, `productFk`) VALUES
(4, 1),
(4, 2),
(3, 3),
(2, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `userFk` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stars`
--

CREATE TABLE `stars` (
  `id` int(11) NOT NULL,
  `userFk` int(11) NOT NULL,
  `starrReview` enum('1','2','3','4','5') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `roleFk` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `cityname` varchar(64) DEFAULT NULL,
  `postcode` varchar(16) DEFAULT NULL,
  `streetname` varchar(64) DEFAULT NULL,
  `streetnumber` int(11) DEFAULT NULL,
  `telefon` int(11) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `image` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `roleFk`, `username`, `password`, `firstname`, `lastname`, `cityname`, `postcode`, `streetname`, `streetnumber`, `telefon`, `email`, `image`) VALUES
(1, 1, 'jerom.r', '$2y$10$KInv7q8OMC.dqzrrhZfBVuJhOn5zzGEOj5ijW97Sjm3Y3br1RMG6W', 'Jerom', 'Rajan', NULL, NULL, NULL, NULL, NULL, 'jeromrajan@hotmail.com', 'jerom.r.jpg'),
(2, 2, 'MuellerA', '$2y$10$KInv7q8OMC.dqzrrhZfBVuJhOn5zzGEOj5ijW97Sjm3Y3br1RMG6W', 'Alfred', 'Mueller', NULL, NULL, NULL, NULL, NULL, 'alfred.mueller@gmx.com', NULL),
(3, 2, 'Peter', '$2y$10$KInv7q8OMC.dqzrrhZfBVuJhOn5zzGEOj5ijW97Sjm3Y3br1RMG6W', 'Peter', 'Griffin', NULL, NULL, NULL, NULL, NULL, 'peter.griffin@gmail.com', NULL),
(4, 2, 'Homie', '$2y$10$KInv7q8OMC.dqzrrhZfBVuJhOn5zzGEOj5ijW97Sjm3Y3br1RMG6W', 'Homer', 'Simpson', NULL, NULL, NULL, NULL, NULL, 'homerS@gmail.com', NULL),
(5, 2, 'JeromR', '$2y$10$Z1HShuz779mCA3IPpq5WdOccIh2kjEFL/zgmB0snSPO4x3nnpBwIK', 'Jerom', 'Rajan', NULL, NULL, NULL, NULL, NULL, 'jeromrajan@hotmail.com', NULL),
(6, 2, 'FelixG', '$2y$10$/FUaya3F6ZpA27m9hFkwPOdCXXCtKAdomaEW5CwFGoSYraRMqVRry', 'Felix', 'GrÃ¼ner', 'Bern', '36068', 'Hallerstrasse', 30, 333367890, 'felix', 'FelixG.jpg');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userFk` (`userFk`);

--
-- Indizes für die Tabelle `cart_product`
--
ALTER TABLE `cart_product`
  ADD KEY `productFk` (`productFk`),
  ADD KEY `cartFk` (`cartFk`);

--
-- Indizes für die Tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartFk` (`cartFk`),
  ADD KEY `userFk` (`userFk`);

--
-- Indizes für die Tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewFk` (`reviewFk`),
  ADD KEY `userFk` (`userFk`);

--
-- Indizes für die Tabelle `product_categorie`
--
ALTER TABLE `product_categorie`
  ADD KEY `categorieFk` (`categorieFk`),
  ADD KEY `productFk` (`productFk`);

--
-- Indizes für die Tabelle `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userFk` (`userFk`);

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userFk` (`userFk`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleFk` (`roleFk`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `stars`
--
ALTER TABLE `stars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userFk`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`productFk`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`cartFk`) REFERENCES `cart` (`id`);

--
-- Constraints der Tabelle `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`cartFk`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`userFk`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`reviewFk`) REFERENCES `review` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`userFk`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `product_categorie`
--
ALTER TABLE `product_categorie`
  ADD CONSTRAINT `product_categorie_ibfk_1` FOREIGN KEY (`categorieFk`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `product_categorie_ibfk_2` FOREIGN KEY (`productFk`) REFERENCES `product` (`id`);

--
-- Constraints der Tabelle `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`userFk`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `stars`
--
ALTER TABLE `stars`
  ADD CONSTRAINT `stars_ibfk_1` FOREIGN KEY (`userFk`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleFk`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
