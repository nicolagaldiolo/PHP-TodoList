-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mar 31, 2018 alle 17:36
-- Versione del server: 5.7.20
-- Versione PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phptodolist`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `todo` text NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `todo`
--

INSERT INTO `todo` (`id`, `todo`, `completed`, `created`) VALUES
(1, 'Comprare il latte', 0, '2018-03-31 17:35:21'),
(2, 'Lavare la moto', 0, '2018-03-31 17:36:05'),
(3, 'Fare la lavatrice', 0, '2018-03-31 17:36:05'),
(4, 'Portare fuori il cane', 0, '2018-03-31 17:36:21');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
