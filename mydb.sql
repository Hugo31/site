INSERT INTO `User` (`login`, `pwd`, `lastname`, `firstname`, `mail`, `logo`, `typeUser`) VALUES
('laurineM', 'd6581d542c7eaf801284f084478b5fcc', 'marmisse', 'laurine', 'laurine.marmisse@gmail.com', '/site/img/user/laurineMarmisse.jpg', 'Admin'),
('undefined', '5e543256c480ac577d30f76f9120eb74', 'undefined', 'undefined', 'undefined@undefined.com', '/site/img/user/user.png', 'Classic');


INSERT INTO `DesignPattern` (`idDesignPattern`, `name`, `what`, `whenAndHow`, `layout`, `copy`, `implementation`, `descriptionImage`, `nbUsage`, `nbComments`, `nbRates`, `rate`, `date`, `target`, `login`) VALUES
(1, 'Advancement Box', 'Display the user its current position in the procedure: where he is, what he has done, what is left to be done.', 'Must be used in multi-step wizard procedures holding three or more steps.', '1. Use 2 shades of 1 colour for the background of the box places, the deeper one signalizing the current step, the lighter for thesteps done or to be done.2. Use three icons to show the state of a step. 3. Recall the step number in the header of the page. 4. Dont use checkboxes to indicate (completed) steps as this can give a false impression users can click on them.', 'Give each step a number.', 'Put the box in the rigth-hand part of the screen, just as any non-critical information that can be missed by people holding a low screen resolution.', NULL, 2, 1, 2, 3.5, '2014-03-23 10:08:12', 'Designer', 'undefined'),
(2, 'Multi-Step Wizard', 'The goal of the procedure is reached through the accomplishment of a sequence of activites. This sequence of activities is guided by the sequence of screens but also by the navigation proposed which is limited to "next step" and "previous step" (eventually "cancell all").', 'Should be used when users are novice.\nShouldnt be used when the procedure.', '1. Use an advancement box to indicate the procedure advancement.\n2. Remove unnecessary links and content so focus is on the wizard, while reinforcing the brand.', 'Give you step a clear title, whose formulation is user-centred and contains a verb corresponding to the activity of the step.', '1. Make sure the back button always works.\n2. When going back to a previous step, auto complete the previous imput.', NULL, 0, 0, 0, 0, '2014-03-23 10:08:12', 'Designer', 'undefined');

INSERT INTO `TypeConflict` (`idTypeConflict`, `name`, `description`) VALUES
(1, 'View conflict', 'This conflict type is an example to test database.');

INSERT INTO `Conflict` (`idConflict`, `name`, `description`, `date`, `nbComments`, `login`, `idTypeConflict`) VALUES
(1, 'Conflict between 2 design pattern', 'This is signaled because there is a conflict between design pattern 1 and 2.', '2014-03-27 00:00:00', 0, 'laurineM', 1);



INSERT INTO `ConflictDesignPattern` (`idConflict`, `idDesignPattern`) VALUES
(1, 1),
(1, 2);
INSERT INTO `CommentDesignPattern` (`idComment`, `login`, `idDesignPattern`, `date`, `comment`) VALUES
(1, 'laurineM', 1, '2014-03-01 00:00:00', 'I think there might be a problem with this one');



INSERT INTO `ImageDesignPattern` (`idImage`, `idDesignPattern`, `link`, `description`) VALUES
(1, 1, '/site/img/designPattern/advancement_box1.png', NULL),
(2, 2, '/site/img/designPattern/multi-step_wizard1.png', NULL),
(3, 2, '/site/img/designPattern/multi-step_wizard2.png', NULL),
(4, 2, '/site/img/designPattern/multi-step_wizard3.png', NULL);

INSERT INTO `Source` (`idSource`, `idDesignPattern`, `author`, `link`) VALUES
(1, 1, 'Van Welie', 'http://www.welie.com/patterns/showPattern.php?patternID=purchase-process'),
(2, 2, 'Undefined', 'http://www.designofsites.com/about_the_book/patternh1.pdf'),
(3, 2, 'Undefined', 'http://harbinger.sims.berkeley.edu/ui_designpatterns/webpatterns2/webpatterns/pattern.php?id=7');

INSERT INTO `NoteDesignPattern` (`login`, `idDesignPattern`, `note`) VALUES
('laurineM', 1, 4),
('undefined', 1, 3);

INSERT INTO `Platform` (`idPlatform`, `name`, `description`, `icon`) VALUES
(1, 'Windows', 'Windows Platform', '/site/img/vrac/windows.png'),
(2, 'Linux', 'Linux Platform', '/site/img/vrac/linux.png'),
(3, 'Apple', 'Apple Platform', '/site/img/vrac/apple.png'),
(4, 'Android', 'Android Platform', '/site/img/vrac/android.png');

INSERT INTO `PlatformDesignPattern` (`idDesignPattern`, `idPlatform`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4);

INSERT INTO `System` (`idSystem`, `name`, `description`, `icon`) VALUES
(1, 'Tablet', 'Tablet device', '/site/img/vrac/tablet.png'),
(2, 'Phone', 'Phone device', '/site/img/vrac/tel.png'),
(3, 'Computer', 'Computer device', '/site/img/vrac/ordi.png');

INSERT INTO `SystemDesignPattern` (`idDesignPattern`, `idSystem`) VALUES
(1, 1),
(1, 2),
(2, 2),
(1, 3);


INSERT INTO `Project` (`idProject`, `name`, `description`, `date`, `login`, `current`) VALUES
(1, 'LaurineM project', 'I didn''t want to give a description about this project.', '2014-03-03 00:00:00', 'laurineM', 0),
(2, 'Current Cart', '', '2014-03-03 00:00:00', 'laurineM', 1),
(3, 'Current Cart', '', '2014-03-03 00:00:00', 'undefined', 1);

INSERT INTO `ProjectDesignPattern` (`idProject`, `idDesignPattern`) VALUES
(1, 1),
(1, 2);

INSERT INTO `Solution` (`idSolution`, `name`, `comment`, `codeSolution`, `nbComments`, `nbRates`, `rate`, `date`, `idConflict`, `login`) VALUES
(1, 'Solution', 'I propose this solution to this conflict.', 'vue = new Vue();vue.setVisible(false);', 0, 0, 0, '2014-03-19 00:00:00', 1, 'laurineM');
