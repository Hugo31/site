DELETE FROM `ComponentDesignPattern` ;
DELETE FROM `PropertyDesignPattern` ;
DELETE FROM `CategoryDesignPattern` ;
DELETE FROM `PlatformDesignPattern` ;
DELETE FROM `SystemDesignPattern` ;
DELETE FROM `ConflictDesignPattern` ;
DELETE FROM `ComponentRelatedDesignPattern` ;

DELETE FROM `Platform` ;
DELETE FROM `System` ;
DELETE FROM `Category` ;
DELETE FROM `Property` ;
DELETE FROM `Component` ;

DELETE FROM `CommentSolution` ;
DELETE FROM `NoteSolution` ;
DELETE FROM `CommentConflit` ;
DELETE FROM `ProjectDesignPattern` ;
DELETE FROM `ImageDesignPattern` ;
DELETE FROM `NoteDesignPattern` ;
DELETE FROM `Source` ;
DELETE FROM `CommentDesignPattern` ;

DELETE FROM `Project` ;

DELETE FROM `Conflict` ;

DELETE FROM `Solution` ;

DELETE FROM `DesignPattern` ;

DELETE FROM `User` ;






INSERT INTO `user`(`login`, `pwd`, `lastname`, `firstname`, `mail`, `logo`) VALUES ('undefined','ip3hgopE47ig01','undefined','undefined','nomail','nologo');

INSERT INTO `user`(`login`, `pwd`, `lastname`, `firstname`, `mail`, `logo`) VALUES ('hugo','mdp','Guignard','Hugo','mail','logo');
INSERT INTO `user`(`login`, `pwd`, `lastname`, `firstname`, `mail`, `logo`) VALUES ('loicv','mdp','Viguier','Loic','mail','logo');
INSERT INTO `user`(`login`, `pwd`, `lastname`, `firstname`, `mail`, `logo`) VALUES ('loicf','mdp','Faure','Loic','mail','logo');
INSERT INTO `user`(`login`, `pwd`, `lastname`, `firstname`, `mail`, `logo`) VALUES ('blondie','mdp','Marmisse','Laurine','mail','logo');

INSERT INTO `designpattern`(`name`, `what`, `whenAndHow`, `layout`, `copy`, `implementation`, `target`, `login`) VALUES ('design1','dp de test','when and how','layout','copy','implementation','target', 'blondie');

INSERT INTO `imagedesignpattern`(`idDesignPattern`, `link`) VALUES (2,'link...');

INSERT INTO `conflict`(`name`, `description`, `type`, `login`) VALUES ('conflit 1','1er conflit de test','type?','blondie');

INSERT INTO `solution`(`comment`, `codeSolution`, `date`, `idConflict`, `login`) VALUES ('voici une solution','code de ma solution','09-01-2014',1,'blondie');

INSERT INTO `notedesignpattern`(`login`, `idDesignPattern`, `note`) VALUES ('blondie',4,4);

INSERT INTO `commentdesignpattern`(`login`, `idDesignPattern`, `date`, `comment`) VALUES ('blondie',4,'09-01-2014','youhou trop bien ofet');

INSERT INTO `project`(`name`, `description`, `login`) VALUES ('my project','mon 1er projet youhou','blondie');

INSERT INTO `commentconflit`(`login`, `idConflict`, `date`, `comment`) VALUES ('blondie',1,'09-01-2014','youhou ce conflit est trop cool');

INSERT INTO `commentsolution`(`login`, `idSolution`, `date`, `comment`) VALUES ('blondie',1,'09-01-2014','youhou cette solution est trop chouette');

INSERT INTO `notesolution`(`login`, `idSolution`, `note`) VALUES ('blondie',1,3);


