-- MySQL Workbench Synchronization
-- Generated: 2016-12-03 21:00
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Davide

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER SCHEMA `tiroamichevole`  DEFAULT COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Licenze` (
  `idLicenza` INT(11) NOT NULL,
  `Nome` VARCHAR(45) NULL DEFAULT NULL,
  `Cognome` VARCHAR(45) NULL DEFAULT NULL,
  `Via` VARCHAR(255) NULL DEFAULT NULL,
  `ViaNo` VARCHAR(45) NULL DEFAULT NULL,
  `CAP` VARCHAR(45) NULL DEFAULT NULL,
  `Luogo` VARCHAR(45) NULL DEFAULT NULL,
  `Societa` INT(11) NULL DEFAULT NULL,
  `DataNascita` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`idLicenza`),
  UNIQUE INDEX `idLicenze_UNIQUE` (`idLicenza` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Inscrizioni` (
  `Licenze_idLicenza` INT(11) NOT NULL,
  `CategoriaArmi_idCategoria` INT(11) NOT NULL,
  `CategoriaEta_idCategoriaEta` INT(11) NOT NULL,
  PRIMARY KEY (`Licenze_idLicenza`, `CategoriaArmi_idCategoria`, `CategoriaEta_idCategoriaEta`),
  INDEX `fk_Inscrizioni_CategoriaArmi1_idx` (`CategoriaArmi_idCategoria` ASC),
  INDEX `fk_Inscrizioni_CategoriaEta1_idx` (`CategoriaEta_idCategoriaEta` ASC),
  CONSTRAINT `fk_Inscrizioni_Licenze1`
    FOREIGN KEY (`Licenze_idLicenza`)
    REFERENCES `tiroamichevole`.`Licenze` (`idLicenza`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscrizioni_CategoriaArmi1`
    FOREIGN KEY (`CategoriaArmi_idCategoria`)
    REFERENCES `tiroamichevole`.`CategoriaArmi` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscrizioni_CategoriaEta1`
    FOREIGN KEY (`CategoriaEta_idCategoriaEta`)
    REFERENCES `tiroamichevole`.`CategoriaEta` (`idCategoriaEta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Gruppi` (
  `idGruppo` INT(11) NOT NULL,
  `Nome` VARCHAR(45) NULL DEFAULT NULL,
  `CategoriaArmi_idCategoria` INT(11) NOT NULL,
  PRIMARY KEY (`idGruppo`, `CategoriaArmi_idCategoria`),
  INDEX `fk_Gruppi_CategoriaArmi1_idx` (`CategoriaArmi_idCategoria` ASC),
  CONSTRAINT `fk_Gruppi_CategoriaArmi1`
    FOREIGN KEY (`CategoriaArmi_idCategoria`)
    REFERENCES `tiroamichevole`.`CategoriaArmi` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`CategoriaArmi` (
  `idCategoria` INT(11) NOT NULL,
  `CodiceCat` VARCHAR(45) NULL DEFAULT NULL,
  `Descrizione` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Gruppi_has_Inscrizioni` (
  `Gruppi_idGruppo` INT(11) NOT NULL,
  `Gruppi_Categorie_idCategoria` INT(11) NOT NULL,
  `Inscrizioni_Licenze_idLicenza` INT(11) NOT NULL,
  PRIMARY KEY (`Gruppi_idGruppo`, `Gruppi_Categorie_idCategoria`, `Inscrizioni_Licenze_idLicenza`),
  INDEX `fk_Gruppi_has_Inscrizioni_Inscrizioni1_idx` (`Inscrizioni_Licenze_idLicenza` ASC),
  INDEX `fk_Gruppi_has_Inscrizioni_Gruppi1_idx` (`Gruppi_idGruppo` ASC, `Gruppi_Categorie_idCategoria` ASC),
  CONSTRAINT `fk_Gruppi_has_Inscrizioni_Gruppi1`
    FOREIGN KEY (`Gruppi_idGruppo`)
    REFERENCES `tiroamichevole`.`Gruppi` (`idGruppo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Gruppi_has_Inscrizioni_Inscrizioni1`
    FOREIGN KEY (`Inscrizioni_Licenze_idLicenza`)
    REFERENCES `tiroamichevole`.`Inscrizioni` (`Licenze_idLicenza`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Colpiti` (
  `idColpito` INT(11) NOT NULL,
  `colpito` INT(11) NULL DEFAULT NULL,
  `Inscrizioni_Licenze_idLicenza` INT(11) NOT NULL,
  `Serie_idSerie` INT(11) NOT NULL,
  `Programmi_idProgramma` INT(11) NOT NULL,
  PRIMARY KEY (`idColpito`, `Inscrizioni_Licenze_idLicenza`, `Serie_idSerie`, `Programmi_idProgramma`),
  INDEX `fk_Risultati_Inscrizioni1_idx` (`Inscrizioni_Licenze_idLicenza` ASC),
  INDEX `fk_Colpiti_Serie1_idx` (`Serie_idSerie` ASC),
  CONSTRAINT `fk_Risultati_Inscrizioni1`
    FOREIGN KEY (`Inscrizioni_Licenze_idLicenza`)
    REFERENCES `tiroamichevole`.`Inscrizioni` (`Licenze_idLicenza`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Colpiti_Serie1`
    FOREIGN KEY (`Serie_idSerie`)
    REFERENCES `tiroamichevole`.`Serie` (`idSerie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Premi` (
  `idPremio` INT(11) NOT NULL,
  `descrizione` VARCHAR(45) NULL DEFAULT NULL,
  `valore` DOUBLE NULL DEFAULT NULL,
  `costo` DOUBLE NULL DEFAULT NULL,
  PRIMARY KEY (`idPremio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Serie` (
  `idSerie` INT(11) NOT NULL,
  `codice` INT(11) NULL DEFAULT NULL,
  `noColpi` INT(11) NULL DEFAULT NULL,
  `Bersagli_idBersaglio` INT(11) NOT NULL,
  PRIMARY KEY (`idSerie`, `Bersagli_idBersaglio`),
  INDEX `fk_Serie_Bersagli1_idx` (`Bersagli_idBersaglio` ASC),
  CONSTRAINT `fk_Serie_Bersagli1`
    FOREIGN KEY (`Bersagli_idBersaglio`)
    REFERENCES `tiroamichevole`.`Bersagli` (`idBersaglio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Bersagli` (
  `idBersaglio` INT(11) NOT NULL,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  `maxPti` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idBersaglio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`Categoria_Serie_Premio` (
  `categoria` INT(11) NOT NULL,
  `minPti` INT(11) NULL DEFAULT NULL,
  `CategoriaArmi_idCategoria` INT(11) NOT NULL,
  `CategoriaEta_idCategoriaEta` INT(11) NOT NULL,
  `CategoriaEta_idCategoriaEta1` INT(11) NOT NULL,
  `Premi_idPremio` INT(11) NOT NULL,
  PRIMARY KEY (`categoria`, `CategoriaArmi_idCategoria`, `CategoriaEta_idCategoriaEta`, `CategoriaEta_idCategoriaEta1`, `Premi_idPremio`),
  INDEX `fk_Categoria_Serie_Premio_CategoriaArmi1_idx` (`CategoriaArmi_idCategoria` ASC),
  INDEX `fk_Categoria_Serie_Premio_CategoriaEta1_idx` (`CategoriaEta_idCategoriaEta` ASC),
  INDEX `fk_Categoria_Serie_Premio_CategoriaEta2_idx` (`CategoriaEta_idCategoriaEta1` ASC),
  INDEX `fk_Categoria_Serie_Premio_Premi1_idx` (`Premi_idPremio` ASC),
  CONSTRAINT `fk_Categoria_Serie_Premio_CategoriaArmi1`
    FOREIGN KEY (`CategoriaArmi_idCategoria`)
    REFERENCES `tiroamichevole`.`CategoriaArmi` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Categoria_Serie_Premio_CategoriaEta1`
    FOREIGN KEY (`CategoriaEta_idCategoriaEta`)
    REFERENCES `tiroamichevole`.`CategoriaEta` (`idCategoriaEta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Categoria_Serie_Premio_CategoriaEta2`
    FOREIGN KEY (`CategoriaEta_idCategoriaEta1`)
    REFERENCES `tiroamichevole`.`CategoriaEta` (`idCategoriaEta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Categoria_Serie_Premio_Premi1`
    FOREIGN KEY (`Premi_idPremio`)
    REFERENCES `tiroamichevole`.`Premi` (`idPremio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tiroamichevole`.`CategoriaEta` (
  `idCategoriaEta` INT(11) NOT NULL,
  `Descrizione` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idCategoriaEta`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
