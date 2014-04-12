SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Category` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Category` (
  `idCategory` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idCategory`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`User` ;

CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `login` VARCHAR(30) NOT NULL,
  `pwd` VARCHAR(32) NOT NULL,
  `lastname` VARCHAR(30) NULL DEFAULT NULL,
  `firstname` VARCHAR(30) NULL DEFAULT NULL,
  `mail` VARCHAR(30) NOT NULL,
  `logo` VARCHAR(60) NULL DEFAULT NULL,
  `typeUser` ENUM('Classic','Admin') NOT NULL,
  PRIMARY KEY (`login`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`DesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`DesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`DesignPattern` (
  `idDesignPattern` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `what` TEXT NOT NULL,
  `whenAndHow` TEXT NULL DEFAULT NULL,
  `layout` TEXT NULL DEFAULT NULL,
  `copy` TEXT NULL DEFAULT NULL,
  `implementation` TEXT NULL DEFAULT NULL,
  `descriptionImage` TEXT NULL DEFAULT NULL,
  `nbUsage` INT(11) NULL DEFAULT NULL,
  `nbComments` INT(11) NULL DEFAULT NULL,
  `nbRates` INT(11) NULL DEFAULT NULL,
  `rate` DOUBLE NULL DEFAULT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  `target` ENUM('Designer','Evaluator') NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idDesignPattern`),
  INDEX `fk_DesignPattern_User1_idx` (`login` ASC),
  CONSTRAINT `fk_DesignPattern_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`CategoryDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CategoryDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`CategoryDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idCategory` INT(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idCategory`),
  INDEX `fk_DesignPattern_has_Categorie_Categorie1_idx` (`idCategory` ASC),
  INDEX `fk_DesignPattern_has_Categorie_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Categorie_Categorie1`
    FOREIGN KEY (`idCategory`)
    REFERENCES `mydb`.`Category` (`idCategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Categorie_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`TypeConflict`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`TypeConflict` ;

CREATE TABLE IF NOT EXISTS `mydb`.`TypeConflict` (
  `idTypeConflict` INT(11) NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idTypeConflict`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Conflict`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Conflict` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Conflict` (
  `idConflict` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  `nbComments` INT(11) NULL DEFAULT NULL,
  `login` VARCHAR(30) NOT NULL,
  `idTypeConflict` INT(11) NOT NULL,
  PRIMARY KEY (`idConflict`),
  INDEX `fk_Conflit_User1_idx` (`login` ASC),
  INDEX `fk_Conflict_TypeConflict1_idx` (`idTypeConflict` ASC),
  CONSTRAINT `fk_Conflict_TypeConflict1`
    FOREIGN KEY (`idTypeConflict`)
    REFERENCES `mydb`.`TypeConflict` (`idTypeConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Conflit_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`CommentConflict`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CommentConflict` ;

CREATE TABLE IF NOT EXISTS `mydb`.`CommentConflict` (
  `idComment` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(30) NOT NULL,
  `idConflict` INT(11) NOT NULL,
  `date` DATETIME NOT NULL,
  `comment` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idComment`),
  INDEX `fk_User_has_Conflit_Conflit1_idx` (`idConflict` ASC),
  INDEX `fk_User_has_Conflit_User1_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_Conflit_Conflit1`
    FOREIGN KEY (`idConflict`)
    REFERENCES `mydb`.`Conflict` (`idConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Conflit_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`CommentDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CommentDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`CommentDesignPattern` (
  `idComment` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(30) NOT NULL,
  `idDesignPattern` INT(11) NOT NULL,
  `date` DATETIME NOT NULL,
  `comment` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idComment`),
  INDEX `fk_User_has_DesignPattern_DesignPattern2_idx` (`idDesignPattern` ASC),
  INDEX `fk_User_has_DesignPattern_User2_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_DesignPattern_DesignPattern2`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_DesignPattern_User2`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Solution`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Solution` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Solution` (
  `idSolution` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `comment` TEXT NULL DEFAULT NULL,
  `codeSolution` TEXT NULL DEFAULT NULL,
  `nbComments` INT(11) NULL DEFAULT NULL,
  `nbRates` INT(11) NULL DEFAULT NULL,
  `rate` DOUBLE NULL DEFAULT NULL,
  `date` DATETIME NOT NULL,
  `idConflict` INT(11) NOT NULL,
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
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`CommentSolution`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CommentSolution` ;

CREATE TABLE IF NOT EXISTS `mydb`.`CommentSolution` (
  `idComment` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(30) NOT NULL,
  `idSolution` INT(11) NOT NULL,
  `date` DATETIME NOT NULL,
  `comment` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idComment`),
  INDEX `fk_User_has_Solution_Solution1_idx` (`idSolution` ASC),
  INDEX `fk_User_has_Solution_User1_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_Solution_Solution1`
    FOREIGN KEY (`idSolution`)
    REFERENCES `mydb`.`Solution` (`idSolution`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Solution_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Component`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Component` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Component` (
  `idComponent` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idComponent`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`ComponentDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ComponentDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ComponentDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idComponent` INT(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idComponent`),
  INDEX `fk_DesignPattern_has_Component_Component1_idx` (`idComponent` ASC),
  INDEX `fk_DesignPattern_has_Component_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Component_Component1`
    FOREIGN KEY (`idComponent`)
    REFERENCES `mydb`.`Component` (`idComponent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Component_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`ComponentRelatedDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ComponentRelatedDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ComponentRelatedDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idComponentRelated` INT(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idComponentRelated`),
  INDEX `fk_ComponentRelatedDesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_ComponentRelatedDesignPattern_Component1_idx` (`idComponentRelated` ASC),
  CONSTRAINT `fk_ComponentRelatedDesignPattern_Component1`
    FOREIGN KEY (`idComponentRelated`)
    REFERENCES `mydb`.`Component` (`idComponent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ComponentRelatedDesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`ConflictDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ConflictDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ConflictDesignPattern` (
  `idConflict` INT(11) NOT NULL,
  `idDesignPattern` INT(11) NOT NULL,
  PRIMARY KEY (`idConflict`, `idDesignPattern`),
  INDEX `fk_ConflictDesignPattern_Conflict1_idx` (`idConflict` ASC),
  INDEX `fk_ConflictDesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`ImageDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ImageDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ImageDesignPattern` (
  `idImage` INT(11) NOT NULL AUTO_INCREMENT,
  `idDesignPattern` INT(11) NOT NULL,
  `link` VARCHAR(250) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idImage`),
  INDEX `fk_ImageDesignPattern_DesignPattern_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_ImageDesignPattern_DesignPattern`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`NoteDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`NoteDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`NoteDesignPattern` (
  `login` VARCHAR(30) NOT NULL,
  `idDesignPattern` INT(11) NOT NULL,
  `note` INT(11) NOT NULL,
  PRIMARY KEY (`login`, `idDesignPattern`),
  INDEX `fk_User_has_DesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_User_has_DesignPattern_User1_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_DesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_DesignPattern_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`NoteSolution`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`NoteSolution` ;

CREATE TABLE IF NOT EXISTS `mydb`.`NoteSolution` (
  `login` VARCHAR(30) NOT NULL,
  `idSolution` INT(11) NOT NULL,
  `note` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`login`, `idSolution`),
  INDEX `fk_User_has_Solution_Solution2_idx` (`idSolution` ASC),
  INDEX `fk_User_has_Solution_User2_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_Solution_Solution2`
    FOREIGN KEY (`idSolution`)
    REFERENCES `mydb`.`Solution` (`idSolution`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Solution_User2`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Platform`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Platform` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Platform` (
  `idPlatform` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `icon` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPlatform`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`PlatformDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PlatformDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`PlatformDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idPlatform` INT(11) NOT NULL,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Project` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Project` (
  `idProject` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  `login` VARCHAR(30) NOT NULL,
  `current` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idProject`),
  INDEX `fk_Projet_User1_idx` (`login` ASC),
  CONSTRAINT `fk_Projet_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`ProjectDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ProjectDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ProjectDesignPattern` (
  `idProject` INT(11) NOT NULL,
  `idDesignPattern` INT(11) NOT NULL,
  PRIMARY KEY (`idProject`, `idDesignPattern`),
  INDEX `fk_Projet_has_DesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_Projet_has_DesignPattern_Projet1_idx` (`idProject` ASC),
  CONSTRAINT `fk_Projet_has_DesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Projet_has_DesignPattern_Projet1`
    FOREIGN KEY (`idProject`)
    REFERENCES `mydb`.`Project` (`idProject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Property`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Property` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Property` (
  `idProperty` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idProperty`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`PropertyDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PropertyDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`PropertyDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idProperty` INT(11) NOT NULL,
  `note` INT(11) NULL DEFAULT NULL,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Source`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Source` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Source` (
  `idSource` INT(11) NOT NULL AUTO_INCREMENT,
  `idDesignPattern` INT(11) NOT NULL,
  `author` VARCHAR(30) NULL DEFAULT NULL,
  `link` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`idSource`),
  INDEX `fk_Source_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_Source_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `mydb`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`System`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`System` ;

CREATE TABLE IF NOT EXISTS `mydb`.`System` (
  `idSystem` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `icon` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSystem`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`SystemDesignPattern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SystemDesignPattern` ;

CREATE TABLE IF NOT EXISTS `mydb`.`SystemDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idSystem` INT(11) NOT NULL,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Reporting`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Reporting` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Reporting` (
  `idReporting` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `message` TEXT NULL,
  `typeReported` ENUM('DesignPattern', 'Solution', 'Conflict', 'CommentConflict', 'CommentDesignPattern', 'CommentSolution', 'User') NOT NULL,
  `idReported` INT NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`idReporting`),
  INDEX `fk_Reporting_User1_idx` (`login` ASC),
  CONSTRAINT `fk_Reporting_User1`
    FOREIGN KEY (`login`)
    REFERENCES `mydb`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
