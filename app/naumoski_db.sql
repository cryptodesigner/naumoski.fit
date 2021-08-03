-- MySQL Script generated by MySQL Workbench
-- Thu Apr 29 12:31:40 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema naumoski_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema naumoski_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `naumoski_db` DEFAULT CHARACTER SET utf8 ;
USE `naumoski_db` ;

-- -----------------------------------------------------
-- Table `naumoski_db`.`managers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`managers` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`managers` (
  `manager_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`manager_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`clients` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`clients` (
  `client_id` INT NOT NULL AUTO_INCREMENT,
  `managers_manager_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`client_id`),
    FOREIGN KEY (`managers_manager_id`)
    REFERENCES `naumoski_db`.`managers` (`manager_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`recepts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`recepts` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`recepts` (
  `recept_id` INT NOT NULL AUTO_INCREMENT,
  `managers_manager_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `link` VARCHAR(100) NULL,
  PRIMARY KEY (`recept_id`),
    FOREIGN KEY (`managers_manager_id`)
    REFERENCES `naumoski_db`.`managers` (`manager_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`basics`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`basics` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`basics` (
  `basic_id` INT NOT NULL AUTO_INCREMENT,
  `clients_client_id` INT NOT NULL,
  `pol` VARCHAR(45) NOT NULL,
  `godini` VARCHAR(45) NOT NULL,
  `visina` VARCHAR(45) NOT NULL,
  `tezina` VARCHAR(45) NOT NULL,
  `alergija` VARCHAR(300) NULL,
  `netolerantnost` VARCHAR(300) NULL,
  `odbivnost` VARCHAR(300) NULL,
  `zaboluvanja` VARCHAR(300) NULL,
  `iskustvo` VARCHAR(200) NULL,
  `suplement` VARCHAR(200) NULL,
  PRIMARY KEY (`basic_id`, `clients_client_id`),
    FOREIGN KEY (`clients_client_id`)
    REFERENCES `naumoski_db`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`schedules`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`schedules` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`schedules` (
  `schedule_id` INT NOT NULL AUTO_INCREMENT,
  `clients_client_id` INT NOT NULL,
  `stanuvanje` VARCHAR(100) NULL,
  `legnuvanje` VARCHAR(100) NULL,
  `rabota` VARCHAR(300) NULL,
  `pauzi` VARCHAR(200) NULL,
  `trening` VARCHAR(300) NULL,
  `cardio` VARCHAR(200) NULL,
  `description` VARCHAR(500) NULL,
  PRIMARY KEY (`schedule_id`, `clients_client_id`),
    FOREIGN KEY (`clients_client_id`)
    REFERENCES `naumoski_db`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`measurements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`measurements` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`measurements` (
  `measurement_id` INT NOT NULL AUTO_INCREMENT,
  `clients_client_id` INT NOT NULL,
  `tezina` VARCHAR(45) NULL,
  `vrat` VARCHAR(45) NULL,
  `gradi` VARCHAR(45) NULL,
  `pod_gradi` VARCHAR(45) NULL,
  `papok` VARCHAR(45) NULL,
  `kolk` VARCHAR(45) NULL,
  `raka` VARCHAR(45) NULL,
  `but` VARCHAR(45) NULL,
  `cur_date` VARCHAR(45) NULL,
  PRIMARY KEY (`measurement_id`, `clients_client_id`),
    FOREIGN KEY (`clients_client_id`)
    REFERENCES `naumoski_db`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`trainings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`trainings` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`trainings` (
  `training_id` INT NOT NULL AUTO_INCREMENT,
  `clients_client_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `vreme` VARCHAR(50) NOT NULL,
  `vezba` INT NULL,
  `serii_povt` VARCHAR(100) NULL,
  `tech` INT NULL,
  `date` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`training_id`),
    FOREIGN KEY (`clients_client_id`)
    REFERENCES `naumoski_db`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`meals`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`meals` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`meals` (
  `meal_id` INT NOT NULL AUTO_INCREMENT,
  `clients_client_id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `vreme` VARCHAR(45) NOT NULL,
  `option1` INT NULL,
  `option2` INT NULL,
  `option3` INT NULL,
  `date` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`meal_id`),
    FOREIGN KEY (`clients_client_id`)
    REFERENCES `naumoski_db`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`options`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`options` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`options` (
  `option_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `sostojki` VARCHAR(500) NOT NULL,
  `proteins` VARCHAR(45) NOT NULL,
  `carbohydrates` VARCHAR(45) NOT NULL,
  `fats` VARCHAR(45) NOT NULL,
  `description` VARCHAR(500) NULL,
  PRIMARY KEY (`option_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`tehniki`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`tehniki` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`tehniki` (
  `tehnika_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `link` VARCHAR(100) NULL,
  `description` VARCHAR(200) NULL,
  PRIMARY KEY (`tehnika_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `naumoski_db`.`vezbi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naumoski_db`.`vezbi` ;

CREATE TABLE IF NOT EXISTS `naumoski_db`.`vezbi` (
  `vezba_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `link_vezba` VARCHAR(200) NULL,
  `muskulna_grupa` VARCHAR(100) NULL,
  `description` VARCHAR(500) NULL,
  PRIMARY KEY (`vezba_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
