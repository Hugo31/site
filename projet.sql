SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `db_dpi` ;
CREATE SCHEMA IF NOT EXISTS `db_dpi` DEFAULT CHARACTER SET utf8 ;
USE `db_dpi` ;

-- -----------------------------------------------------
-- Table `db_dpi`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`User` (
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
-- Table `db_dpi`.`Category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Category` (
  `idCategory` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idCategory`),
  INDEX `fk_category_login` (`login` ASC),
  CONSTRAINT `Category_ibfk_1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`DesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`DesignPattern` (
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
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`CategoryDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`CategoryDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idCategory` INT(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idCategory`),
  INDEX `fk_DesignPattern_has_Categorie_Categorie1_idx` (`idCategory` ASC),
  INDEX `fk_DesignPattern_has_Categorie_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Categorie_Categorie1`
    FOREIGN KEY (`idCategory`)
    REFERENCES `db_dpi`.`Category` (`idCategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Categorie_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`TypeConflict`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`TypeConflict` (
  `idTypeConflict` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idTypeConflict`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`Conflict`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Conflict` (
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
    REFERENCES `db_dpi`.`TypeConflict` (`idTypeConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Conflit_User1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`CommentConflict`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`CommentConflict` (
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
    REFERENCES `db_dpi`.`Conflict` (`idConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Conflit_User1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`CommentDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`CommentDesignPattern` (
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
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_DesignPattern_User2`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`Solution`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Solution` (
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
    REFERENCES `db_dpi`.`Conflict` (`idConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Solution_User1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`CommentSolution`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`CommentSolution` (
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
    REFERENCES `db_dpi`.`Solution` (`idSolution`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Solution_User1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`Component`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Component` (
  `idComponent` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idComponent`),
  INDEX `fk_component_login` (`login` ASC),
  CONSTRAINT `Component_ibfk_1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`ComponentDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`ComponentDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idComponent` INT(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idComponent`),
  INDEX `fk_DesignPattern_has_Component_Component1_idx` (`idComponent` ASC),
  INDEX `fk_DesignPattern_has_Component_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Component_Component1`
    FOREIGN KEY (`idComponent`)
    REFERENCES `db_dpi`.`Component` (`idComponent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Component_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`ComponentRelatedDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`ComponentRelatedDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idComponentRelated` INT(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idComponentRelated`),
  INDEX `fk_ComponentRelatedDesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_ComponentRelatedDesignPattern_Component1_idx` (`idComponentRelated` ASC),
  CONSTRAINT `fk_ComponentRelatedDesignPattern_Component1`
    FOREIGN KEY (`idComponentRelated`)
    REFERENCES `db_dpi`.`Component` (`idComponent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ComponentRelatedDesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`ConflictDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`ConflictDesignPattern` (
  `idConflict` INT(11) NOT NULL,
  `idDesignPattern` INT(11) NOT NULL,
  PRIMARY KEY (`idConflict`, `idDesignPattern`),
  INDEX `fk_ConflictDesignPattern_Conflict1_idx` (`idConflict` ASC),
  INDEX `fk_ConflictDesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_ConflictDesignPattern_Conflict1`
    FOREIGN KEY (`idConflict`)
    REFERENCES `db_dpi`.`Conflict` (`idConflict`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ConflictDesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`ImageDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`ImageDesignPattern` (
  `idImage` INT(11) NOT NULL AUTO_INCREMENT,
  `idDesignPattern` INT(11) NOT NULL,
  `link` VARCHAR(250) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idImage`),
  INDEX `fk_ImageDesignPattern_DesignPattern_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_ImageDesignPattern_DesignPattern`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`NoteDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`NoteDesignPattern` (
  `login` VARCHAR(30) NOT NULL,
  `idDesignPattern` INT(11) NOT NULL,
  `note` INT(11) NOT NULL,
  PRIMARY KEY (`login`, `idDesignPattern`),
  INDEX `fk_User_has_DesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_User_has_DesignPattern_User1_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_DesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_DesignPattern_User1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`NoteSolution`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`NoteSolution` (
  `login` VARCHAR(30) NOT NULL,
  `idSolution` INT(11) NOT NULL,
  `note` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`login`, `idSolution`),
  INDEX `fk_User_has_Solution_Solution2_idx` (`idSolution` ASC),
  INDEX `fk_User_has_Solution_User2_idx` (`login` ASC),
  CONSTRAINT `fk_User_has_Solution_Solution2`
    FOREIGN KEY (`idSolution`)
    REFERENCES `db_dpi`.`Solution` (`idSolution`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Solution_User2`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`Platform`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Platform` (
  `idPlatform` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `icon` VARCHAR(45) NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idPlatform`),
  INDEX `fk_platform_login` (`login` ASC),
  CONSTRAINT `Platform_ibfk_1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`PlatformDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`PlatformDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idPlatform` INT(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idPlatform`),
  INDEX `fk_DesignPattern_has_Plateforme_Plateforme1_idx` (`idPlatform` ASC),
  INDEX `fk_DesignPattern_has_Plateforme_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Plateforme_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Plateforme_Plateforme1`
    FOREIGN KEY (`idPlatform`)
    REFERENCES `db_dpi`.`Platform` (`idPlatform`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`Project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Project` (
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
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`ProjectDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`ProjectDesignPattern` (
  `idProject` INT(11) NOT NULL,
  `idDesignPattern` INT(11) NOT NULL,
  PRIMARY KEY (`idProject`, `idDesignPattern`),
  INDEX `fk_Projet_has_DesignPattern_DesignPattern1_idx` (`idDesignPattern` ASC),
  INDEX `fk_Projet_has_DesignPattern_Projet1_idx` (`idProject` ASC),
  CONSTRAINT `fk_Projet_has_DesignPattern_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Projet_has_DesignPattern_Projet1`
    FOREIGN KEY (`idProject`)
    REFERENCES `db_dpi`.`Project` (`idProject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`Property`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Property` (
  `idProperty` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idProperty`),
  INDEX `fk_property_login` (`login` ASC),
  CONSTRAINT `Property_ibfk_1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`PropertyDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`PropertyDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idProperty` INT(11) NOT NULL,
  `note` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idDesignPattern`, `idProperty`),
  INDEX `fk_DesignPattern_has_Propertie_Propertie1_idx` (`idProperty` ASC),
  INDEX `fk_DesignPattern_has_Propertie_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Propertie_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Propertie_Propertie1`
    FOREIGN KEY (`idProperty`)
    REFERENCES `db_dpi`.`Property` (`idProperty`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`Reporting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Reporting` (
  `idReporting` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `message` TEXT NULL DEFAULT NULL,
  `typeReported` ENUM('DesignPattern','Solution','Conflict','CommentConflict','CommentDesignPattern','CommentSolution','User') NOT NULL,
  `idReported` INT(11) NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`idReporting`),
  INDEX `fk_Reporting_User1_idx` (`login` ASC),
  CONSTRAINT `fk_Reporting_User1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`Source`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`Source` (
  `idSource` INT(11) NOT NULL AUTO_INCREMENT,
  `idDesignPattern` INT(11) NOT NULL,
  `author` VARCHAR(30) NULL DEFAULT NULL,
  `link` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`idSource`),
  INDEX `fk_Source_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_Source_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`System`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`System` (
  `idSystem` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `icon` VARCHAR(45) NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idSystem`),
  INDEX `fk_system_login` (`login` ASC),
  CONSTRAINT `System_ibfk_1`
    FOREIGN KEY (`login`)
    REFERENCES `db_dpi`.`User` (`login`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_dpi`.`SystemDesignPattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_dpi`.`SystemDesignPattern` (
  `idDesignPattern` INT(11) NOT NULL,
  `idSystem` INT(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`, `idSystem`),
  INDEX `fk_DesignPattern_has_Systeme_Systeme1_idx` (`idSystem` ASC),
  INDEX `fk_DesignPattern_has_Systeme_DesignPattern1_idx` (`idDesignPattern` ASC),
  CONSTRAINT `fk_DesignPattern_has_Systeme_DesignPattern1`
    FOREIGN KEY (`idDesignPattern`)
    REFERENCES `db_dpi`.`DesignPattern` (`idDesignPattern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DesignPattern_has_Systeme_Systeme1`
    FOREIGN KEY (`idSystem`)
    REFERENCES `db_dpi`.`System` (`idSystem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
