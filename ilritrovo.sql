-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Lug 08, 2025 alle 00:34
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ilRitrovo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `creditcard`
--

CREATE TABLE `creditcard` (
  `idCreditCard` int(11) NOT NULL,
  `holder` varchar(128) NOT NULL,
  `number` varchar(19) NOT NULL,
  `cvv` int(3) NOT NULL,
  `expiration` date NOT NULL,
  `type` varchar(16) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `creditcard`
--

INSERT INTO `creditcard` (`idCreditCard`, `holder`, `number`, `cvv`, `expiration`, `type`, `idUser`) VALUES
(1, 'Marco Cipriani', '1234567890121212', 123, '2027-12-31', 'Visa', 1),
(2, 'Marco Cipriani', '1234567890232323', 345, '2026-12-31', 'Mastercard', 1),
(3, 'Mario Rossi', '1234567890343434', 567, '2027-12-31', 'Visa', 3),
(4, 'Mario Rossi', '1234567890454545', 789, '2028-12-31', 'American Express', 3),
(5, 'Luigi Verdi', '1234567890565656', 98, '2029-12-31', 'Visa', 4),
(6, 'Luna Neri', '1234567890676767', 765, '2026-12-31', 'Mastercard', 5),
(7, 'Stephen Strange', '1234567890787878', 432, '2027-12-31', 'American Express', 6);

--
-- Trigger `creditcard`
--
DELIMITER $$
CREATE TRIGGER `typeCreditCard` BEFORE INSERT ON `creditcard` FOR EACH ROW BEGIN
    IF LOWER(NEW.type) NOT IN ('Visa', 'Mastercard', 'American Express', 'Maestro', 'V-Pay', 'PagoBANCOMAT') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid credit card type';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `extra`
--

CREATE TABLE `extra` (
  `idExtra` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `extra`
--

INSERT INTO `extra` (`idExtra`, `name`, `price`) VALUES
(1, 'Small flower bouquet', 20),
(2, 'Large flower bouquet', 50),
(3, 'Floral decoration for the room', 100),
(4, 'Balloon centerpiece', 15),
(5, 'Balloon decoration for the room', 40),
(6, 'Live music', 150),
(7, 'Private bartender', 70),
(8, 'Children’s entertainment', 70),
(9, 'Cake (up to 20 people)', 30),
(10, 'Cake (up to 50 people)', 60),
(11, 'Cake (up to 100 people)', 120),
(12, 'Projector rental', 10),
(13, 'Place cards', 25);

-- --------------------------------------------------------

--
-- Struttura della tabella `extrainreservation`
--

CREATE TABLE `extrainreservation` (
  `idExtra` int(11) NOT NULL,
  `idReservation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `extrainreservation`
--

INSERT INTO `extrainreservation` (`idExtra`, `idReservation`) VALUES
(1, 3),
(10, 3),
(2, 7),
(12, 7),
(13, 7),
(7, 9),
(10, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `payment`
--

CREATE TABLE `payment` (
  `idPayment` int(11) NOT NULL,
  `total` int(4) NOT NULL,
  `creationTime` date NOT NULL,
  `state` enum('pending','completed','failed','canceled') NOT NULL,
  `idCreditCard` int(11) NOT NULL,
  `idReservation` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `payment`
--

INSERT INTO `payment` (`idPayment`, `total`, `creationTime`, `state`, `idCreditCard`, `idReservation`) VALUES
(1, 130, '2025-04-10', 'completed', 5, 3),
(2, 105, '2025-05-20', 'completed', 7, 7),
(3, 180, '2025-07-01', 'completed', 5, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `reply`
--

CREATE TABLE `reply` (
  `idReply` int(11) NOT NULL,
  `dateReply` date NOT NULL,
  `body` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `reply`
--

INSERT INTO `reply` (`idReply`, `dateReply`, `body`) VALUES
(1, '2025-03-18', 'Thank you! Hope we see  you back soon!'),
(2, '2025-04-17', 'Thank you! Hope we see  you back soon!'),
(3, '2025-05-05', 'Thank you! Hope we see  you back soon!'),
(4, '2025-05-26', 'This is disrespectful');

-- --------------------------------------------------------

--
-- Struttura della tabella `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` int(11) NOT NULL,
  `timeFrame` enum('lunch','dinner') NOT NULL,
  `reservationDate` date NOT NULL,
  `comment` varchar(256) NOT NULL,
  `people` int(3) NOT NULL,
  `totPrice` int(4) NOT NULL,
  `state` varchar(16) NOT NULL,
  `creationTime` date NOT NULL,
  `idUser` int(11) NOT NULL,
  `idRoom` int(11) DEFAULT NULL,
  `idTable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `reservation`
--

INSERT INTO `reservation` (`idReservation`, `timeFrame`, `reservationDate`, `comment`, `people`, `totPrice`, `state`, `creationTime`, `idUser`, `idRoom`, `idTable`) VALUES
(1, 'dinner', '2025-02-20', 'a celiac is dining with us', 5, 0, 'confirmed', '2025-02-15', 1, NULL, 1),
(2, 'dinner', '2025-03-15', '', 4, 0, 'confirmed', '2025-03-12', 3, NULL, 3),
(3, 'dinner', '2025-04-12', 'a lactose intollerant is dining with us', 45, 130, 'confirmed', '2025-04-10', 4, 3, NULL),
(4, 'lunch', '2025-04-25', 'we need an high chair', 9, 0, 'confirmed', '2025-04-20', 1, NULL, 13),
(5, 'lunch', '2025-04-30', '', 3, 0, 'confirmed', '2025-04-29', 5, NULL, 2),
(6, 'lunch', '2025-05-10', '', 4, 0, 'confirmed', '2025-05-05', 1, NULL, 5),
(7, 'dinner', '2025-05-24', 'a lactose intollerant is dining with us', 15, 105, 'confirmed', '2025-05-20', 6, 1, NULL),
(8, 'dinner', '2025-05-30', 'a celiac is dining with us', 4, 0, 'confirmed', '2025-05-28', 3, NULL, 14),
(9, 'dinner', '2025-07-23', 'a lactose intollerant is dining with us', 50, 180, 'confirmed', '2025-07-01', 4, 3, NULL),
(10, 'lunch', '2025-07-23', '', 4, 0, 'confirmed', '2025-07-02', 5, NULL, 5),
(11, 'lunch', '2025-07-23', 'a celiac is dining with us', 4, 0, 'confirmed', '2025-07-03', 1, NULL, 11),
(12, 'dinner', '2025-07-23', 'we need an high chair', 4, 0, 'confirmed', '2025-07-04', 3, NULL, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `review`
--

CREATE TABLE `review` (
  `idUser` int(11) NOT NULL,
  `idReview` int(11) NOT NULL,
  `stars` int(1) NOT NULL,
  `creationTime` date NOT NULL,
  `body` varchar(512) NOT NULL,
  `idReply` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `review`
--

INSERT INTO `review` (`idUser`, `idReview`, `stars`, `creationTime`, `body`, `idReply`) VALUES
(3, 1, 5, '2025-03-17', 'A wonderful experience in a wonderful place', 1),
(4, 2, 4, '2025-04-15', 'Such a nice place. The food in incredible and the staff is amazing', 2),
(5, 3, 4, '2025-05-01', 'First time here, i had a very nice dinner', 3),
(6, 4, 2, '2025-05-25', 'This place is awful', 4);

--
-- Trigger `review`
--
DELIMITER $$
CREATE TRIGGER `starsReview` BEFORE INSERT ON `review` FOR EACH ROW BEGIN
  IF NEW.stars NOT IN (1, 2, 3, 4, 5) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid number of stars';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `room`
--

CREATE TABLE `room` (
  `idRoom` int(11) NOT NULL,
  `areaName` varchar(64) NOT NULL,
  `maxGuests` int(3) NOT NULL,
  `tax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `room`
--

INSERT INTO `room` (`idRoom`, `areaName`, `maxGuests`, `tax`) VALUES
(1, 'The Rustic Retreat', 20, 20),
(2, 'The Grand Hall', 100, 100),
(3, 'The Wine Cellar', 50, 50);

-- --------------------------------------------------------

--
-- Struttura della tabella `tables`
--

CREATE TABLE `tables` (
  `idTable` int(11) NOT NULL,
  `areaName` varchar(64) NOT NULL,
  `maxGuests` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tables`
--

INSERT INTO `tables` (`idTable`, `areaName`, `maxGuests`) VALUES
(1, 'Table 1', 6),
(2, 'Table 2', 3),
(3, 'Table 3', 4),
(4, 'Table 4', 4),
(5, 'Table 5', 4),
(6, 'Table 6', 10),
(7, 'Table 7', 4),
(8, 'Table 8', 4),
(9, 'Table 9', 4),
(10, 'Table 10', 4),
(11, 'Table 11', 4),
(12, 'Table 12', 5),
(13, 'Table 13', 10),
(14, 'Table 14', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `idReview` int(11) DEFAULT NULL,
  `username` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `birthDate` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ban` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`idUser`, `idReview`, `username`, `name`, `surname`, `birthDate`, `phone`, `role`, `email`, `password`, `ban`) VALUES
(1, NULL, 'eepySnorlax00', 'Marco', 'Cipriani', '2000-02-20', '1234567890', 'user', 'marcociprianituna2000@gmail.com', '$2y$10$acxtqCubAsOfBSzZTRqTV.HMp/gYO9k28BwadTAcIwyRv.TzuqB7W', 0),
(2, NULL, 'sivi0115', 'Silvia', 'Di G', '2001-01-15', '1234567890', 'admin', 'sidigiu01@gmail.com', '$2y$10$acxtqCubAsOfBSzZTRqTV.HMp/gYO9k28BwadTAcIwyRv.TzuqB7W', 0),
(3, 1, 'superMario', 'Mario', 'Rossi', '1980-02-16', '0987654321', 'user', 'marioRossi@gmail.com', '$2y$10$acxtqCubAsOfBSzZTRqTV.HMp/gYO9k28BwadTAcIwyRv.TzuqB7W', 0),
(4, 2, 'Luigi95', 'Luigi', 'Verdi', '1995-03-17', '0987654321', 'user', 'luigiVerdi@gmail.com', '$2y$10$acxtqCubAsOfBSzZTRqTV.HMp/gYO9k28BwadTAcIwyRv.TzuqB7W', 0),
(5, 3, 'Moon', 'Luna', 'Neri', '1998-04-18', '1234567890', 'user', 'lunaNeri@gmail.com', '$2y$10$acxtqCubAsOfBSzZTRqTV.HMp/gYO9k28BwadTAcIwyRv.TzuqB7W', 0),
(6, 4, 'Magician', 'Stephen', 'Strange', '1970-05-20', '1234567890', 'user', 'stephenStrange@gmail.com', '$2y$10$acxtqCubAsOfBSzZTRqTV.HMp/gYO9k28BwadTAcIwyRv.TzuqB7W', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`idCreditCard`),
  ADD UNIQUE KEY `number` (`number`,`idUser`) USING BTREE,
  ADD UNIQUE KEY `number_2` (`number`),
  ADD KEY `idUser` (`idUser`);

--
-- Indici per le tabelle `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`idExtra`);

--
-- Indici per le tabelle `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idPayment`),
  ADD KEY `idCreditCard` (`idCreditCard`),
  ADD KEY `idRservation` (`idReservation`);

--
-- Indici per le tabelle `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`idReply`);

--
-- Indici per le tabelle `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idReservation`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idRoom` (`idRoom`),
  ADD KEY `idEvent` (`idTable`);

--
-- Indici per le tabelle `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idReview`),
  ADD UNIQUE KEY `idReply` (`idReply`);

--
-- Indici per le tabelle `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`idRoom`);

--
-- Indici per le tabelle `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`idTable`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `idCreditCard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `extra`
--
ALTER TABLE `extra`
  MODIFY `idExtra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `payment`
--
ALTER TABLE `payment`
  MODIFY `idPayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `reply`
--
ALTER TABLE `reply`
  MODIFY `idReply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `review`
--
ALTER TABLE `review`
  MODIFY `idReview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `room`
--
ALTER TABLE `room`
  MODIFY `idRoom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tables`
--
ALTER TABLE `tables`
  MODIFY `idTable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `creditcard`
--
ALTER TABLE `creditcard`
  ADD CONSTRAINT `creditcard_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `idRservation` FOREIGN KEY (`idReservation`) REFERENCES `reservation` (`idReservation`),
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`idCreditCard`) REFERENCES `creditcard` (`idCreditCard`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
