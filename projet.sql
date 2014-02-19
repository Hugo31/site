SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`User` ;

CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `login` VARCHAR(30) NOT NULL,
  `pwd` VARCHAR(20) NOT NULL,
  `lastname` VARCHAR(30) NULL,
  `firstname` VARCHAR(30) NULL,
  `mail` VARCHAR(30) NOT NULL,
  `logo` VARCHAR(60) NULL,
  PRIMARY KEY (`login`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`DesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`DesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`DesignPattern` (
  `idDesignPattern` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `what` TEXT NOT NULL,
  `whenAndHow` TEXT NULL,
  `layout` TEXT NULL,
  `copy` TEXT NULL,
  `implementation` TEXT NULL,
  `nbUsage` INT NULL,
  `nbComments` INT NULL,
  `nbRates` INT NULL,
  `rate` DOUBLE NULL,
  `target` ENUM('Designer','Evaluator') NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idDesignPattern`),
  INDEX `fk_DesignPattern_User1_idx` (`login` ASC),
  CONSTRAINT `fk_DesignPattern_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ImageDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ImageDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ImageDesignPattern` (
  `idImage` INT NOT NULL AUTO_INCREMENT,
  `idDesignPattern` INT NOT NULL,
  `link` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idImage`),
  INDEX `fk_ImageDesignPattern_DesignPattern_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_ImageDesignPattern_DesignPattern`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`NoteDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`NoteDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`NoteDesignPattern` (
  `login` VARCHAR(30) NOT NULL,
  `idDesignPattern` INT NOT NULL,
  `note` INT NOT NULL,
  PRIMARY KEY (`login`, `idDesignPattern`),
  INDEX `fk_User_has_DesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_User_has_DesignPattern_User1_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_DesignPattern_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_DesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Source`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Source` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Source` (
  `idSource` INT NOT NULL AUTO_INCREMENT,
  `idDesignPattern` INT NOT NULL,
  `author` VARCHAR(30) NULL,
  `link` VARCHAR(50) NULL,
  PRIMARY KEY (`idSource`),
  INDEX `fk_Source_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_Source_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`CommentDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CommentDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`CommentDesignPattern` (
  `idComment` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(30) NOT NULL,
  `idDesignPattern` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `comment` VARCHAR(100) NULL,
  INDEX `fk_User_has_DesignPattern_DesignPattern2_idx` (`idDesignPattern` ASC),
  INDEX `fk_User_has_DesignPattern_User2_idx` (`login` ASC),
  PRIMARY KEY (`idComment`),
  CONSTRAINT `fk_User_has_DesignPattern_User2`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_DesignPattern_DesignPattern2`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Project` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Project` (
  `idProject` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idProject`),
  INDEX `fk_Projet_User1_idx` (`login` ASC),
  CONSTRAINT `fk_Projet_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ProjectDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ProjectDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ProjectDesignPattern` (
  `idProject` INT NOT NULL,
  `idDesignPattern` INT NOT NULL,
  PRIMARY KEY (`idProject`, `idDesignPattern`),
  INDEX `fk_Projet_has_DesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_Projet_has_DesignPattern_Projet1_idx` (`idProject` ASC),
  CONSTRAINT `fk_Projet_has_DesignPattern_Projet1`
    FOREIGN KEY (`idProject`)
    REFERENCES `mydb`.`Project` (`idProject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Projet_has_DesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Conflict`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Conflict` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Conflict` (
  `idConflict` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` TEXT NULL,
  `type` VARCHAR(45) NULL,
  `date` DATETIME NULL,
  `nbComments` INT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idConflict`),
  INDEX `fk_Conflit_User1_idx` (`login` ASC),
  CONSTRAINT `fk_Conflit_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`CommentConflit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CommentConflit` ;

CREATE TABLE IF NOT EXISTS `mydb`.`CommentConflit` (
  `idComment` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(30) NOT NULL,
  `idConflict` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `comment` VARCHAR(100) NULL,
  PRIMARY KEY (`idComment`),
  INDEX `fk_User_has_Conflit_Conflit1_idx` (`idConflict` ASC),
  INDEX `fk_User_has_Conflit_User1_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_Conflit_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Conflit_Conflit1`
    FOREIGN KEY (`idConflict`)
    REFERENCES `mydb`.`Conflict` (`idConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Solution`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Solution` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Solution` (
  `idSolution` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `comment` TEXT NULL,
  `codeSolution` TEXT NULL,
  `nbComments` INT NULL,
  `nbRates` INT NULL,
  `rate` DOUBLE NULL,
  `date` DATETIME NOT NULL,
  `idConflict` INT NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idSolution`),
  INDEX `fk_Solution_Conflit1_idx` (`idConflict` ASC),
  INDEX `fk_Solution_User1_idx` (`login` ASC),
  CONSTRAINT `fk_Solution_Conflit1`
    FOREIGN KEY (`idConflict`)
    REFERENCES `mydb`.`Conflict` (`idConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Solution_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`CommentSolution`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CommentSolution` ;

CREATE TABLE IF NOT EXISTS `mydb`.`CommentSolution` (
  `idComment` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(30) NOT NULL,
  `idSolution` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `comment` VARCHAR(100) NULL,
  PRIMARY KEY (`idComment`),
  INDEX `fk_User_has_Solution_Solution1_idx` (`idSolution` ASC),
  INDEX `fk_User_has_Solution_User1_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_Solution_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Solution_Solution1`
    FOREIGN KEY (`idSolution`)
    REFERENCES `mydb`.`Solution` (`idSolution`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`NoteSolution`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`NoteSolution` ;

CREATE TABLE IF NOT EXISTS `mydb`.`NoteSolution` (
  `login` VARCHAR(30) NOT NULL,
  `idSolution` INT NOT NULL,
  `note` INT NULL,
  PRIMARY KEY (`login`, `idSolution`),
  INDEX `fk_User_has_Solution_Solution2_idx` (`idSolution` ASC),
  INDEX `fk_User_has_Solution_User2_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_Solution_User2`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Solution_Solution2`
    FOREIGN KEY (`idSolution`)
    REFERENCES `mydb`.`Solution` (`idSolution`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Platform`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Platform` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Platform` (
  `idPlatform` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL,
  `icon` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPlatform`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`System`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`System` ;

CREATE TABLE IF NOT EXISTS `mydb`.`System` (
  `idSystem` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL,
  `icon` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSystem`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Category` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Category` (
  `idCategory` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`idCategory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Property`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Property` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Property` (
  `idProperty` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`idProperty`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Component`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Component` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Component` (
  `idComponent` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`idComponent`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ComponentDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ComponentDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ComponentDesignPattern` (
  `idDesignPattern` INT NOT NULL,
  `idComponent` INT NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idComponent`),
  INDEX `fk_DesignPattern_has_Component_Component1_idx` (`idComponent` ASC),
  INDEX `fk_DesignPattern_has_Component_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Component_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Component_Component1`
    FOREIGN KEY (`idComponent`)
    REFERENCES `mydb`.`Component` (`idComponent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PropertyDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PropertyDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`PropertyDesignPattern` (
  `idDesignPattern` INT NOT NULL,
  `idProperty` INT NOT NULL,
  `note` INT NULL,
  PRIMARY KEY (`idDesignPattern`, `idProperty`),
  INDEX `fk_DesignPattern_has_Propertie_Propertie1_idx` (`idProperty` ASC),
  INDEX `fk_DesignPattern_has_Propertie_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Propertie_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Propertie_Propertie1`
    FOREIGN KEY (`idProperty`)
    REFERENCES `mydb`.`Property` (`idProperty`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`CategoryDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CategoryDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`CategoryDesignPattern` (
  `idDesignPattern` INT NOT NULL,
  `idCategory` INT NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idCategory`),
  INDEX `fk_DesignPattern_has_Categorie_Categorie1_idx` (`idCategory` ASC),
  INDEX `fk_DesignPattern_has_Categorie_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Categorie_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Categorie_Categorie1`
    FOREIGN KEY (`idCategory`)
    REFERENCES `mydb`.`Category` (`idCategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PlatformDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PlatformDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`PlatformDesignPattern` (
  `idDesignPattern` INT NOT NULL,
  `idPlatform` INT NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idPlatform`),
  INDEX `fk_DesignPattern_has_Plateforme_Plateforme1_idx` (`idPlatform` ASC),
  INDEX `fk_DesignPattern_has_Plateforme_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Plateforme_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Plateforme_Plateforme1`
    FOREIGN KEY (`idPlatform`)
    REFERENCES `mydb`.`Platform` (`idPlatform`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`SystemDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SystemDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`SystemDesignPattern` (
  `idDesignPattern` INT NOT NULL,
  `idSystem` INT NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idSystem`),
  INDEX `fk_DesignPattern_has_Systeme_Systeme1_idx` (`idSystem` ASC),
  INDEX `fk_DesignPattern_has_Systeme_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Systeme_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Systeme_Systeme1`
    FOREIGN KEY (`idSystem`)
    REFERENCES `mydb`.`System` (`idSystem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ConflictDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ConflictDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ConflictDesignPattern` (
  `idConflict` INT NOT NULL,
  `idDesignPattern` INT NOT NULL,
  INDEX `fk_ConflictDesignPattern_Conflict1_idx` (`idConflict` ASC),
  INDEX `fk_ConflictDesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  PRIMARY KEY (`idConflict`, `idDesignPattern`),
  CONSTRAINT `fk_ConflictDesignPattern_Conflict1`
    FOREIGN KEY (`idConflict`)
    REFERENCES `mydb`.`Conflict` (`idConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ConflictDesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ComponentRelatedDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ComponentRelatedDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ComponentRelatedDesignPattern` (
  `idDesignPattern` INT NOT NULL,
  `idComponent` INT NOT NULL,
  INDEX `fk_ComponentRelatedDesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_ComponentRelatedDesignPattern_Component1_idx` (`idComponent` ASC),
  PRIMARY KEY (`idDesignPattern`, `idComponent`),
  CONSTRAINT `fk_ComponentRelatedDesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ComponentRelatedDesignPattern_Component1`
    FOREIGN KEY (`idComponent`)
    REFERENCES `mydb`.`Component` (`idComponent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
