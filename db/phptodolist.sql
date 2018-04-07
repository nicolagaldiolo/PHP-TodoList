-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Apr 07, 2018 alle 11:11
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
(1, 'Buy the milk', 1, '2018-04-07 11:08:16'),
(2, 'Wash the car', 1, '2018-04-07 11:08:18'),
(3, 'Do the laundry', 1, '2018-04-07 11:08:36'),
(4, 'Wash the dishes', 1, '2018-04-07 11:08:50'),
(5, 'Adjust the bicycle', 0, '2018-04-07 11:09:28'),
(6, 'Do the shopping', 0, '2018-04-07 11:10:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
