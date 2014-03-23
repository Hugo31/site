-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 23 Mars 2014 à 09:55
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `idCategory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorydesignpattern`
--

CREATE TABLE IF NOT EXISTS `categorydesignpattern` (
  `idDesignPattern` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`,`idCategory`),
  KEY `fk_DesignPattern_has_Categorie_Categorie1_idx` (`idCategory`),
  KEY `fk_DesignPattern_has_Categorie_DesignPattern1_idx` (`idDesignPattern`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentconflict`
--

CREATE TABLE IF NOT EXISTS `commentconflict` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `idConflict` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idComment`),
  KEY `fk_User_has_Conflit_Conflit1_idx` (`idConflict`),
  KEY `fk_User_has_Conflit_User1_idx` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentdesignpattern`
--

CREATE TABLE IF NOT EXISTS `commentdesignpattern` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `idDesignPattern` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idComment`),
  KEY `fk_User_has_DesignPattern_DesignPattern2_idx` (`idDesignPattern`),
  KEY `fk_User_has_DesignPattern_User2_idx` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commentdesignpattern`
--

INSERT INTO `commentdesignpattern` (`idComment`, `login`, `idDesignPattern`, `date`, `comment`) VALUES
(1, 'lolo', 1, '2014-03-01 00:00:00', 'I don''t know what I write...');

-- --------------------------------------------------------

--
-- Structure de la table `commentsolution`
--

CREATE TABLE IF NOT EXISTS `commentsolution` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `idSolution` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idComment`),
  KEY `fk_User_has_Solution_Solution1_idx` (`idSolution`),
  KEY `fk_User_has_Solution_User1_idx` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `component`
--

CREATE TABLE IF NOT EXISTS `component` (
  `idComponent` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idComponent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `componentdesignpattern`
--

CREATE TABLE IF NOT EXISTS `componentdesignpattern` (
  `idDesignPattern` int(11) NOT NULL,
  `idComponent` int(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`,`idComponent`),
  KEY `fk_DesignPattern_has_Component_Component1_idx` (`idComponent`),
  KEY `fk_DesignPattern_has_Component_DesignPattern1_idx` (`idDesignPattern`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `componentrelateddesignpattern`
--

CREATE TABLE IF NOT EXISTS `componentrelateddesignpattern` (
  `idDesignPattern` int(11) NOT NULL,
  `idComponentRelated` int(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`,`idComponentRelated`),
  KEY `fk_ComponentRelatedDesignPattern_DesignPattern1_idx` (`idDesignPattern`),
  KEY `fk_ComponentRelatedDesignPattern_Component1_idx` (`idComponentRelated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `conflict`
--

CREATE TABLE IF NOT EXISTS `conflict` (
  `idConflict` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text,
  `date` datetime DEFAULT NULL,
  `nbComments` int(11) DEFAULT NULL,
  `login` varchar(30) NOT NULL,
  `idTypeConflict` int(11) NOT NULL,
  PRIMARY KEY (`idConflict`),
  KEY `fk_Conflit_User1_idx` (`login`),
  KEY `fk_Conflict_TypeConflict1_idx` (`idTypeConflict`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `conflict`
--

INSERT INTO `conflict` (`idConflict`, `name`, `description`, `date`, `nbComments`, `login`, `idTypeConflict`) VALUES
(1, 'Conflict between 2 design pattern', 'This is signaled because there is a conflict between design ppatern 1 and 2.', '2014-03-27 00:00:00', 0, 'lolo', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conflictdesignpattern`
--

CREATE TABLE IF NOT EXISTS `conflictdesignpattern` (
  `idConflict` int(11) NOT NULL,
  `idDesignPattern` int(11) NOT NULL,
  PRIMARY KEY (`idConflict`,`idDesignPattern`),
  KEY `fk_ConflictDesignPattern_Conflict1_idx` (`idConflict`),
  KEY `fk_ConflictDesignPattern_DesignPattern1_idx` (`idDesignPattern`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `conflictdesignpattern`
--

INSERT INTO `conflictdesignpattern` (`idConflict`, `idDesignPattern`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `designpattern`
--

CREATE TABLE IF NOT EXISTS `designpattern` (
  `idDesignPattern` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `what` text NOT NULL,
  `whenAndHow` text,
  `layout` text,
  `copy` text,
  `implementation` text,
  `descriptionImage` text,
  `nbUsage` int(11) DEFAULT NULL,
  `nbComments` int(11) DEFAULT NULL,
  `nbRates` int(11) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `target` enum('Designer','Evaluator') NOT NULL,
  `login` varchar(30) NOT NULL,
  PRIMARY KEY (`idDesignPattern`),
  KEY `fk_DesignPattern_User1_idx` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `designpattern`
--

INSERT INTO `designpattern` (`idDesignPattern`, `name`, `what`, `whenAndHow`, `layout`, `copy`, `implementation`, `descriptionImage`, `nbUsage`, `nbComments`, `nbRates`, `rate`, `date`, `target`, `login`) VALUES
(1, 'Advancement Box', 'Display the user its current position in the procedure: where he is, what he has done, what is left to be done.', 'Must be used in multi-step wizard procedures holding three or more steps.', '1. Use 2 shades of 1 colour for the background of the box places, the deeper one signalizing the current step, the lighter for thesteps done or to be done.2. Use three icons to show the state of a step. 3. Recall the step number in the header of the page. 4. Dont use checkboxes to indicate (completed) steps as this can give a false impression users can click on them.', 'Give each step a number.', 'Put the box in the rigth-hand part of the screen, just as any non-critical information that can be missed by people holding a low screen resolution.', NULL, 0, 0, 0, 0, '2014-03-23 10:08:12', 'Designer', 'undefined'),
(2, 'Multi-Step Wizard', 'The goal of the procedure is reached through the accomplishment of a sequence of activites. This sequence of activities is guided by the sequence of screens but also by the navigation proposed which is limited to "next step" and "previous step" (eventually "cancell all").', 'Should be used when users are novice.\nShouldnt be used when the procedure.', '1. Use an advancement box to indicate the procedure advancement.\n2. Remove unnecessary links and content so focus is on the wizard, while reinforcing the brand.', 'Give you step a clear title, whose formulation is user-centred and contains a verb corresponding to the activity of the step.', '1. Make sure the back button always works.\n2. When going back to a previous step, auto complete the previous imput.', NULL, 0, 0, 0, 0, '2014-03-23 10:08:12', 'Designer', 'undefined');

-- --------------------------------------------------------

--
-- Structure de la table `imagedesignpattern`
--

CREATE TABLE IF NOT EXISTS `imagedesignpattern` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `idDesignPattern` int(11) NOT NULL,
  `link` varchar(250) NOT NULL,
  `description` text,
  PRIMARY KEY (`idImage`),
  KEY `fk_ImageDesignPattern_DesignPattern_idx` (`idDesignPattern`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `imagedesignpattern`
--

INSERT INTO `imagedesignpattern` (`idImage`, `idDesignPattern`, `link`, `description`) VALUES
(1, 1, '/site/img/designPattern/advancement_box1.png', NULL),
(2, 2, '/site/img/designPattern/multi-step_wizard1.png', NULL),
(3, 2, '/site/img/designPattern/multi-step_wizard2.png', NULL),
(4, 2, '/site/img/designPattern/multi-step_wizard3.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notedesignpattern`
--

CREATE TABLE IF NOT EXISTS `notedesignpattern` (
  `login` varchar(30) NOT NULL,
  `idDesignPattern` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`login`,`idDesignPattern`),
  KEY `fk_User_has_DesignPattern_DesignPattern1_idx` (`idDesignPattern`),
  KEY `fk_User_has_DesignPattern_User1_idx` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notedesignpattern`
--

INSERT INTO `notedesignpattern` (`login`, `idDesignPattern`, `note`) VALUES
('lolo', 1, 4),
('undefined', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `notesolution`
--

CREATE TABLE IF NOT EXISTS `notesolution` (
  `login` varchar(30) NOT NULL,
  `idSolution` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL,
  PRIMARY KEY (`login`,`idSolution`),
  KEY `fk_User_has_Solution_Solution2_idx` (`idSolution`),
  KEY `fk_User_has_Solution_User2_idx` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `platform`
--

CREATE TABLE IF NOT EXISTS `platform` (
  `idPlatform` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `icon` varchar(45) NOT NULL,
  PRIMARY KEY (`idPlatform`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `platform`
--

INSERT INTO `platform` (`idPlatform`, `name`, `description`, `icon`) VALUES
(1, 'Windows', 'This is a platform.', '/site/img/vrac/windows.png'),
(2, 'Linux', 'No description', '/site/img/vrac/linux.png'),
(3, 'Apple', 'Apple is fun !', '/site/img/vrac/apple.png'),
(4, 'Android', 'Android is more bettern than Apple', '/site/img/vrac/android.png');

-- --------------------------------------------------------

--
-- Structure de la table `platformdesignpattern`
--

CREATE TABLE IF NOT EXISTS `platformdesignpattern` (
  `idDesignPattern` int(11) NOT NULL,
  `idPlatform` int(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`,`idPlatform`),
  KEY `fk_DesignPattern_has_Plateforme_Plateforme1_idx` (`idPlatform`),
  KEY `fk_DesignPattern_has_Plateforme_DesignPattern1_idx` (`idDesignPattern`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `platformdesignpattern`
--

INSERT INTO `platformdesignpattern` (`idDesignPattern`, `idPlatform`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `idProject` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `login` varchar(30) NOT NULL,
  `current` tinyint(1) NOT NULL,
  PRIMARY KEY (`idProject`),
  KEY `fk_Projet_User1_idx` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`idProject`, `name`, `description`, `date`, `login`, `current`) VALUES
(1, 'My first project', 'I didn''t want to give a description about this project.', '2014-03-03 00:00:00', 'lolo', 0);

-- --------------------------------------------------------

--
-- Structure de la table `projectdesignpattern`
--

CREATE TABLE IF NOT EXISTS `projectdesignpattern` (
  `idProject` int(11) NOT NULL,
  `idDesignPattern` int(11) NOT NULL,
  PRIMARY KEY (`idProject`,`idDesignPattern`),
  KEY `fk_Projet_has_DesignPattern_DesignPattern1_idx` (`idDesignPattern`),
  KEY `fk_Projet_has_DesignPattern_Projet1_idx` (`idProject`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projectdesignpattern`
--

INSERT INTO `projectdesignpattern` (`idProject`, `idDesignPattern`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `idProperty` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idProperty`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `propertydesignpattern`
--

CREATE TABLE IF NOT EXISTS `propertydesignpattern` (
  `idDesignPattern` int(11) NOT NULL,
  `idProperty` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDesignPattern`,`idProperty`),
  KEY `fk_DesignPattern_has_Propertie_Propertie1_idx` (`idProperty`),
  KEY `fk_DesignPattern_has_Propertie_DesignPattern1_idx` (`idDesignPattern`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `solution`
--

CREATE TABLE IF NOT EXISTS `solution` (
  `idSolution` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `comment` text,
  `codeSolution` text,
  `nbComments` int(11) DEFAULT NULL,
  `nbRates` int(11) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `date` datetime NOT NULL,
  `idConflict` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  PRIMARY KEY (`idSolution`),
  KEY `fk_Solution_Conflit1_idx` (`idConflict`),
  KEY `fk_Solution_User1_idx` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `solution`
--

INSERT INTO `solution` (`idSolution`, `name`, `comment`, `codeSolution`, `nbComments`, `nbRates`, `rate`, `date`, `idConflict`, `login`) VALUES
(1, 'Solution', 'I propose this solution to this conflict.', NULL, 0, 0, 0, '2014-03-19 00:00:00', 1, 'lolo');

-- --------------------------------------------------------

--
-- Structure de la table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `idSource` int(11) NOT NULL AUTO_INCREMENT,
  `idDesignPattern` int(11) NOT NULL,
  `author` varchar(30) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idSource`),
  KEY `fk_Source_DesignPattern1_idx` (`idDesignPattern`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `source`
--

INSERT INTO `source` (`idSource`, `idDesignPattern`, `author`, `link`) VALUES
(1, 1, 'Van Welie', 'http://www.welie.com/patterns/showPattern.php?patternID=purchase-process'),
(2, 2, 'Undefined', 'http://www.designofsites.com/about_the_book/patternh1.pdf'),
(3, 2, 'Undefined', 'http://harbinger.sims.berkeley.edu/ui_designpatterns/webpatterns2/webpatterns/pattern.php?id=7');

-- --------------------------------------------------------

--
-- Structure de la table `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `idSystem` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `icon` varchar(45) NOT NULL,
  PRIMARY KEY (`idSystem`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `system`
--

INSERT INTO `system` (`idSystem`, `name`, `description`, `icon`) VALUES
(1, 'Tablet', 'No description.', '/site/img/vrac/tablet.png'),
(2, 'Phone', 'This design pattern can be used on phone.', '/site/img/vrac/tel.png'),
(3, 'Computer', 'Computer is one of system where design pattern are installed.', '/site/img/vrac/ordi.png');

-- --------------------------------------------------------

--
-- Structure de la table `systemdesignpattern`
--

CREATE TABLE IF NOT EXISTS `systemdesignpattern` (
  `idDesignPattern` int(11) NOT NULL,
  `idSystem` int(11) NOT NULL,
  PRIMARY KEY (`idDesignPattern`,`idSystem`),
  KEY `fk_DesignPattern_has_Systeme_Systeme1_idx` (`idSystem`),
  KEY `fk_DesignPattern_has_Systeme_DesignPattern1_idx` (`idDesignPattern`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `systemdesignpattern`
--

INSERT INTO `systemdesignpattern` (`idDesignPattern`, `idSystem`) VALUES
(1, 1),
(1, 2),
(2, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `typeconflict`
--

CREATE TABLE IF NOT EXISTS `typeconflict` (
  `idTypeConflict` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`idTypeConflict`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typeconflict`
--

INSERT INTO `typeconflict` (`idTypeConflict`, `name`, `description`) VALUES
(1, 'Conflict type', 'This conflict type is an example to test database.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `login` varchar(30) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `mail` varchar(80) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `typeUser` enum('Classic','Admin') NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`login`, `pwd`, `lastname`, `firstname`, `mail`, `logo`, `typeUser`) VALUES
('lolo', 'd6581d542c7eaf801284f084478b5fcc', 'marmisse', 'laurine', 'laurine.marmisse@gmail.com', '/site/img/user/laurineMarmisse.jpg', 'Admin'),
('undefined', '5e543256c480ac577d30f76f9120eb74', 'undefined', 'undefined', 'undefined@undefined.com', '/site/img/user/user.png', 'Classic');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categorydesignpattern`
--
ALTER TABLE `categorydesignpattern`
  ADD CONSTRAINT `fk_DesignPattern_has_Categorie_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DesignPattern_has_Categorie_Categorie1` FOREIGN KEY (`idCategory`) REFERENCES `category` (`idCategory`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commentconflict`
--
ALTER TABLE `commentconflict`
  ADD CONSTRAINT `fk_User_has_Conflit_User1` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Conflit_Conflit1` FOREIGN KEY (`idConflict`) REFERENCES `conflict` (`idConflict`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commentdesignpattern`
--
ALTER TABLE `commentdesignpattern`
  ADD CONSTRAINT `fk_User_has_DesignPattern_User2` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_DesignPattern_DesignPattern2` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commentsolution`
--
ALTER TABLE `commentsolution`
  ADD CONSTRAINT `fk_User_has_Solution_User1` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Solution_Solution1` FOREIGN KEY (`idSolution`) REFERENCES `solution` (`idSolution`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `componentdesignpattern`
--
ALTER TABLE `componentdesignpattern`
  ADD CONSTRAINT `fk_DesignPattern_has_Component_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DesignPattern_has_Component_Component1` FOREIGN KEY (`idComponent`) REFERENCES `component` (`idComponent`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `componentrelateddesignpattern`
--
ALTER TABLE `componentrelateddesignpattern`
  ADD CONSTRAINT `fk_ComponentRelatedDesignPattern_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ComponentRelatedDesignPattern_Component1` FOREIGN KEY (`idComponentRelated`) REFERENCES `component` (`idComponent`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `conflict`
--
ALTER TABLE `conflict`
  ADD CONSTRAINT `fk_Conflit_User1` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Conflict_TypeConflict1` FOREIGN KEY (`idTypeConflict`) REFERENCES `typeconflict` (`idTypeConflict`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `conflictdesignpattern`
--
ALTER TABLE `conflictdesignpattern`
  ADD CONSTRAINT `fk_ConflictDesignPattern_Conflict1` FOREIGN KEY (`idConflict`) REFERENCES `conflict` (`idConflict`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ConflictDesignPattern_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `designpattern`
--
ALTER TABLE `designpattern`
  ADD CONSTRAINT `fk_DesignPattern_User1` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `imagedesignpattern`
--
ALTER TABLE `imagedesignpattern`
  ADD CONSTRAINT `fk_ImageDesignPattern_DesignPattern` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notedesignpattern`
--
ALTER TABLE `notedesignpattern`
  ADD CONSTRAINT `fk_User_has_DesignPattern_User1` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_DesignPattern_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notesolution`
--
ALTER TABLE `notesolution`
  ADD CONSTRAINT `fk_User_has_Solution_User2` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Solution_Solution2` FOREIGN KEY (`idSolution`) REFERENCES `solution` (`idSolution`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `platformdesignpattern`
--
ALTER TABLE `platformdesignpattern`
  ADD CONSTRAINT `fk_DesignPattern_has_Plateforme_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DesignPattern_has_Plateforme_Plateforme1` FOREIGN KEY (`idPlatform`) REFERENCES `platform` (`idPlatform`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_Projet_User1` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `projectdesignpattern`
--
ALTER TABLE `projectdesignpattern`
  ADD CONSTRAINT `fk_Projet_has_DesignPattern_Projet1` FOREIGN KEY (`idProject`) REFERENCES `project` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Projet_has_DesignPattern_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `propertydesignpattern`
--
ALTER TABLE `propertydesignpattern`
  ADD CONSTRAINT `fk_DesignPattern_has_Propertie_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DesignPattern_has_Propertie_Propertie1` FOREIGN KEY (`idProperty`) REFERENCES `property` (`idProperty`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `solution`
--
ALTER TABLE `solution`
  ADD CONSTRAINT `fk_Solution_Conflit1` FOREIGN KEY (`idConflict`) REFERENCES `conflict` (`idConflict`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Solution_User1` FOREIGN KEY (`login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `source`
--
ALTER TABLE `source`
  ADD CONSTRAINT `fk_Source_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `systemdesignpattern`
--
ALTER TABLE `systemdesignpattern`
  ADD CONSTRAINT `fk_DesignPattern_has_Systeme_DesignPattern1` FOREIGN KEY (`idDesignPattern`) REFERENCES `designpattern` (`idDesignPattern`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DesignPattern_has_Systeme_Systeme1` FOREIGN KEY (`idSystem`) REFERENCES `system` (`idSystem`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
