-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Mai 2022 um 11:14
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
-- Datenbank: `malerei_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_einsatz`
--

CREATE TABLE `tbl_einsatz` (
  `IDein` int(10) UNSIGNED NOT NULL,
  `FIDmit` int(10) UNSIGNED NOT NULL,
  `FIDkunde` int(10) UNSIGNED NOT NULL,
  `StartPunkt` datetime NOT NULL,
  `EndPunkt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kat`
--

CREATE TABLE `tbl_kat` (
  `IDkat` int(11) NOT NULL,
  `isprivat` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kunde`
--

CREATE TABLE `tbl_kunde` (
  `IDKunde` int(10) UNSIGNED NOT NULL,
  `NKunde` varchar(64) NOT NULL,
  `FNKunde` varchar(64) NOT NULL,
  `adressKunde` varchar(64) NOT NULL,
  `PLZKunde` int(11) NOT NULL,
  `ortKunde` varchar(64) NOT NULL,
  `telKunde` varchar(64) NOT NULL,
  `MailKunde` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_mitarbeiter`
--

CREATE TABLE `tbl_mitarbeiter` (
  `mitID` int(11) NOT NULL,
  `mitName` varchar(64) NOT NULL,
  `mitFN` varchar(64) NOT NULL,
  `mitSosial` int(11) NOT NULL,
  `mitGeb` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_tel`
--

CREATE TABLE `tbl_tel` (
  `IDTel` int(10) UNSIGNED NOT NULL,
  `FMDmit` int(11) NOT NULL,
  `Telno` varchar(64) NOT NULL,
  `FMTKat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_einsatz`
--
ALTER TABLE `tbl_einsatz`
  ADD PRIMARY KEY (`IDein`),
  ADD KEY `FIDmit` (`FIDmit`),
  ADD KEY `FIDkunde` (`FIDkunde`);

--
-- Indizes für die Tabelle `tbl_kat`
--
ALTER TABLE `tbl_kat`
  ADD PRIMARY KEY (`IDkat`);

--
-- Indizes für die Tabelle `tbl_kunde`
--
ALTER TABLE `tbl_kunde`
  ADD PRIMARY KEY (`IDKunde`);

--
-- Indizes für die Tabelle `tbl_mitarbeiter`
--
ALTER TABLE `tbl_mitarbeiter`
  ADD PRIMARY KEY (`mitID`);

--
-- Indizes für die Tabelle `tbl_tel`
--
ALTER TABLE `tbl_tel`
  ADD PRIMARY KEY (`IDTel`),
  ADD KEY `IDTel` (`IDTel`,`FMDmit`),
  ADD KEY `FMTKat` (`FMTKat`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_einsatz`
--
ALTER TABLE `tbl_einsatz`
  MODIFY `IDein` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbl_kat`
--
ALTER TABLE `tbl_kat`
  MODIFY `IDkat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbl_kunde`
--
ALTER TABLE `tbl_kunde`
  MODIFY `IDKunde` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbl_mitarbeiter`
--
ALTER TABLE `tbl_mitarbeiter`
  MODIFY `mitID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbl_tel`
--
ALTER TABLE `tbl_tel`
  MODIFY `IDTel` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_kat`
--
ALTER TABLE `tbl_kat`
  ADD CONSTRAINT `tbl_kat_ibfk_1` FOREIGN KEY (`IDkat`) REFERENCES `tbl_tel` (`FMTKat`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
