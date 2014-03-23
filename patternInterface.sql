INSERT INTO `mydb`.`DesignPattern` (`idDesignPattern`, `name`, `what`, `whenAndHow`, `layout`, `copy`, `implementation`, `nbUsage`, `nbComments`, `nbRates`, `rate`, `date`, `target`, `login`) 
VALUES (NULL, 'Advancement Box', 'Display the user its current position in the procedure: where he is, what he has done, what is left to be done.', 
'Must be used in multi-step wizard procedures holding three or more steps.', 
'1. Use 2 shades of 1 colour for the background of the box places, the deeper one signalizing the current step, the lighter for thesteps done or to be done.2. Use three icons to show the state of a step. 3. Recall the step number in the header of the page. 4. Dont use checkboxes to indicate (completed) steps as this can give a false impression users can click on them.',
'Give each step a number.', 
'Put the box in the rigth-hand part of the screen, just as any non-critical information that can be missed by people holding a low screen resolution.', 
'0', '0', '0', '0', NOW(), 'Designer', 'undefined');

INSERT INTO `mydb`.`Source` (`idSource`, `idDesignPattern`, `author`, `link`) 
(SELECT NULL, idDesignPattern, "Van Welie", "http://www.welie.com/patterns/showPattern.php?patternID=purchase-process" FROM DesignPattern WHERE name = 'Advancement Box');

INSERT INTO `mydb`.`ImageDesignPattern` (`idImage`, `idDesignPattern`, `link`) 
(SELECT NULL, idDesignPattern, "/site/img/designPattern/advancement_box1.png" FROM DesignPattern WHERE name = 'Advancement Box');


INSERT INTO `mydb`.`DesignPattern` (`idDesignPattern`, `name`, `what`, `whenAndHow`, `layout`, `copy`, `implementation`, `nbUsage`, `nbComments`, `nbRates`, `rate`, `date`, `target`, `login`) 
VALUES (NULL, 'Multi-Step Wizard', 'The goal of the procedure is reached through the accomplishment of a sequence of activites. This sequence of activities is guided by the sequence of screens but also by the navigation proposed which is limited to "next step" and "previous step" (eventually "cancell all").', 
'Should be used when users are novice.\nShouldnt be used when the procedure.', 
'1. Use an advancement box to indicate the procedure advancement.\n2. Remove unnecessary links and content so focus is on the wizard, while reinforcing the brand.',
'Give you step a clear title, whose formulation is user-centred and contains a verb corresponding to the activity of the step.', 
'1. Make sure the back button always works.\n2. When going back to a previous step, auto complete the previous imput.', 
'0', '0', '0', '0', NOW(), 'Designer', 'undefined');

INSERT INTO `mydb`.`Source` (`idSource`, `idDesignPattern`, `author`, `link`) 
(SELECT NULL, idDesignPattern, "", "http://www.designofsites.com/about_the_book/patternh1.pdf" FROM DesignPattern WHERE name = 'Multi-Step Wizard');
INSERT INTO `mydb`.`Source` (`idSource`, `idDesignPattern`, `author`, `link`) 
(SELECT NULL, idDesignPattern, "", "http://harbinger.sims.berkeley.edu/ui_designpatterns/webpatterns2/webpatterns/pattern.php?id=7" FROM DesignPattern WHERE name = 'Multi-Step Wizard');

INSERT INTO `mydb`.`ImageDesignPattern` (`idImage`, `idDesignPattern`, `link`) 
(SELECT NULL, idDesignPattern, "/site/img/designPattern/multi-step_wizard1.png" FROM DesignPattern WHERE name = 'Multi-Step Wizard');
INSERT INTO `mydb`.`ImageDesignPattern` (`idImage`, `idDesignPattern`, `link`) 
(SELECT NULL, idDesignPattern, "/site/img/designPattern/multi-step_wizard2.png" FROM DesignPattern WHERE name = 'Multi-Step Wizard');
INSERT INTO `mydb`.`ImageDesignPattern` (`idImage`, `idDesignPattern`, `link`) 
(SELECT NULL, idDesignPattern, "/site/img/designPattern/multi-step_wizard3.png" FROM DesignPattern WHERE name = 'Multi-Step Wizard');
