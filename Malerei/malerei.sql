-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Mai 2022 um 11:17
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `malerei`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde_tbl`
--

CREATE TABLE `kunde_tbl` (
  `kundeID` int(10) UNSIGNED NOT NULL,
  `kundeName` varchar(64) NOT NULL,
  `kundeNachname` varchar(64) NOT NULL,
  `kundeAdresse` varchar(64) NOT NULL,
  `kundeTel` varchar(64) NOT NULL,
  `kundeMail` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `kunde_tbl`
--

INSERT INTO `kunde_tbl` (`kundeID`, `kundeName`, `kundeNachname`, `kundeAdresse`, `kundeTel`, `kundeMail`) VALUES
(1, 'jurgen', 'silber', 'Pupping 4', '123456789', 'jurgen@aol.com'),
(2, 'thomas', 'gruber', 'kellnering 53', '125425', 'thomas@aol.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter_tbl`
--

CREATE TABLE `mitarbeiter_tbl` (
  `MitarbeiterID` int(10) UNSIGNED NOT NULL,
  `MitarbeiterName` varchar(64) NOT NULL,
  `MitarbeiterNachname` varchar(64) NOT NULL,
  `MitarbeiterSosial` int(10) UNSIGNED NOT NULL,
  `MitarbeiterGeburtsdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tel_tbl`
--

CREATE TABLE `tel_tbl` (
  `telID` int(11) UNSIGNED NOT NULL,
  `tel` int(11) NOT NULL,
  `telPOG` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `kunde_tbl`
--
ALTER TABLE `kunde_tbl`
  ADD PRIMARY KEY (`kundeID`);

--
-- Indizes für die Tabelle `mitarbeiter_tbl`
--
ALTER TABLE `mitarbeiter_tbl`
  ADD UNIQUE KEY `MitarbeiterID` (`MitarbeiterID`);

--
-- Indizes für die Tabelle `tel_tbl`
--
ALTER TABLE `tel_tbl`
  ADD PRIMARY KEY (`telID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `kunde_tbl`
--
ALTER TABLE `kunde_tbl`
  MODIFY `kundeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `mitarbeiter_tbl`
--
ALTER TABLE `mitarbeiter_tbl`
  MODIFY `MitarbeiterID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tel_tbl`
--
ALTER TABLE `tel_tbl`
  MODIFY `telID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `mitarbeiter_tbl`
--
ALTER TABLE `mitarbeiter_tbl`
  ADD CONSTRAINT `mitarbeiter_tbl_ibfk_1` FOREIGN KEY (`MitarbeiterID`) REFERENCES `kunde_tbl` (`kundeID`);

--
-- Constraints der Tabelle `tel_tbl`
--
ALTER TABLE `tel_tbl`
  ADD CONSTRAINT `tel_tbl_ibfk_1` FOREIGN KEY (`telID`) REFERENCES `mitarbeiter_tbl` (`MitarbeiterID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
