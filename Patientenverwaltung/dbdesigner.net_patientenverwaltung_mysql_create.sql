CREATE TABLE `arztpraxis` (
	`PraxisID` INT NOT NULL AUTO_INCREMENT,
	`Vorname` varchar(50) NOT NULL,
	`Nachname` varchar(50) NOT NULL,
	`SozVersNr` varchar(20) NOT NULL UNIQUE,
	`Anrede` varchar(20),
	`Titel` varchar(50),
	`Adresse` varchar(100),
	`PLZ` varchar(10),
	`Ort` varchar(100),
	PRIMARY KEY (`PraxisID`)
);

CREATE TABLE `patient` (
	`PatientID` INT NOT NULL AUTO_INCREMENT,
	`PraxisID` INT NOT NULL,
	`Vorname` varchar(50) NOT NULL,
	`Nachname` varchar(100) NOT NULL,
	`Adresse` varchar(100),
	`PLZ` varchar(10),
	`Ort` varchar(100),
	`VersID` INT,
	`SozVersNr` varchar(30) NOT NULL UNIQUE,
	PRIMARY KEY (`PatientID`)
);

CREATE TABLE `sozialversicherung` (
	`VersID` INT NOT NULL AUTO_INCREMENT,
	`VersName` varchar(100) NOT NULL UNIQUE,
	PRIMARY KEY (`VersID`)
);

CREATE TABLE `befund` (
	`BefundID` INT NOT NULL AUTO_INCREMENT,
	`PatientID` INT NOT NULL,
	`TerminID` INT NOT NULL,
	`Fachgebiet` varchar(50),
	`FachArztID` VARCHAR(20),
	`FachArztName` varchar(50),
	`BefundTxt` blob,
	PRIMARY KEY (`BefundID`)
);

CREATE TABLE `terminbuch` (
	`TerminID` INT NOT NULL AUTO_INCREMENT,
	`PatientID` INT NOT NULL,
	`Termin` DATETIME NOT NULL UNIQUE,
	`Bemerkung` varchar(100),
	PRIMARY KEY (`TerminID`)
);

CREATE TABLE `verordnung` (
	`VerordnungID` INT NOT NULL AUTO_INCREMENT,
	`BefundID` INT NOT NULL,
	`MedID` INT NOT NULL,
	`Dosierung` varchar(200) NOT NULL,
	PRIMARY KEY (`VerordnungID`)
);

CREATE TABLE `medikament` (
	`MedID` INT NOT NULL AUTO_INCREMENT,
	`Hersteller` varchar(100) NOT NULL,
	`Name` varchar(200) NOT NULL,
	`Inhalt` INT NOT NULL,
	`Einheit` varchar(10) NOT NULL,
	PRIMARY KEY (`MedID`)
);

ALTER TABLE `patient` ADD CONSTRAINT `patient_fk0` FOREIGN KEY (`PraxisID`) REFERENCES `arztpraxis`(`PraxisID`);

ALTER TABLE `patient` ADD CONSTRAINT `patient_fk1` FOREIGN KEY (`VersID`) REFERENCES `sozialversicherung`(`VersID`);

ALTER TABLE `befund` ADD CONSTRAINT `befund_fk0` FOREIGN KEY (`PatientID`) REFERENCES `patient`(`PatientID`);

ALTER TABLE `befund` ADD CONSTRAINT `befund_fk1` FOREIGN KEY (`TerminID`) REFERENCES `terminbuch`(`TerminID`);

ALTER TABLE `terminbuch` ADD CONSTRAINT `terminbuch_fk0` FOREIGN KEY (`PatientID`) REFERENCES `patient`(`PatientID`);

ALTER TABLE `verordnung` ADD CONSTRAINT `verordnung_fk0` FOREIGN KEY (`BefundID`) REFERENCES `befund`(`BefundID`);

ALTER TABLE `verordnung` ADD CONSTRAINT `verordnung_fk1` FOREIGN KEY (`MedID`) REFERENCES `medikament`(`MedID`);

