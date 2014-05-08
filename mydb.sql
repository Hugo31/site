INSERT INTO `User` (`login`, `pwd`, `lastname`, `firstname`, `mail`, `logo`, `typeUser`) VALUES
('LaurineMarmisse', 'a929edb05103d7948d269c21b1a6ab8b', 'Marmisse', 'Laurine', 'laurine.marmisse@gmail.com', '/site/img/user/user.png', 'Admin'),
('LoicViguier', 'a929edb05103d7948d269c21b1a6ab8b', 'Viguier', 'Loic', 'loicviguier@gmail.com', '/site/img/user/user.png', 'Admin'),
('HugoGuignard', 'a929edb05103d7948d269c21b1a6ab8b', 'Guignard', 'Hugo', 'hugo.guignard@gmail.com', '/site/img/user/user.png', 'Admin'),
('LoicFaure', 'a929edb05103d7948d269c21b1a6ab8b', 'Faure', 'Loic', 'loicfaure@hotmail.fr', '/site/img/user/user.png', 'Admin'),
('MarcoWinckler', 'a929edb05103d7948d269c21b1a6ab8b', 'Winckler', 'Marco', 'winckler@irit.fr', '/site/img/user/user.png', 'Admin'),
('undefined', '5e543256c480ac577d30f76f9120eb74', 'undefined', 'undefined', 'undefined@undefined.com', '/site/img/user/user.png', 'Classic');

/* mdp admin : 36i9BAreM5 */

INSERT INTO `DesignPattern` (`idDesignPattern`, `name`, `what`, `whenAndHow`, `layout`, `copy`, `implementation`, `descriptionImage`, `nbUsage`, `nbComments`, `nbRates`, `rate`, `date`, `target`, `login`) VALUES
(1, 'Advancement Box', 'Display the user its current position in the procedure: where he is, what he has done, what is left to be done.', 'Must be used in multi-step wizard procedures holding three or more steps.', '1. Use 2 shades of 1 colour for the background of the box places, the deeper one signalizing the current step, the lighter for thesteps done or to be done. 2. Use three icons to show the state of a step. 3. Recall the step number in the header of the page. 4. Dont use checkboxes to indicate (completed) steps as this can give a false impression users can click on them.', 'Give each step a number.', 'Put the box in the rigth-hand part of the screen, just as any non-critical information that can be missed by people holding a low screen resolution.', NULL, 0, 0, 0, 0, '2014-05-02 17:00:00', 'Designer', 'MarcoWinckler'),
(2, 'Multi-Step Wizard', 'The goal of the procedure is reached through the accomplishment of a sequence of activites. This sequence of activities is guided by the sequence of screens but also by the navigation proposed which is limited to "next step" and "previous step" (eventually "cancell all").', 'Should be used when users are novice.\nShouldnt be used when the procedure.', '1. Use an advancement box to indicate the procedure advancement.\n2. Remove unnecessary links and content so focus is on the wizard, while reinforcing the brand.', 'Give you step a clear title, whose formulation is user-centred and contains a verb corresponding to the activity of the step.', '1. Make sure the back button always works.\n2. When going back to a previous step, auto complete the previous input.', NULL, 0, 0, 0, 0, '2014-05-02 17:00:00', 'Designer', 'MarcoWinckler'),
(3, 'Ratings', 'A user wants to leave an opinion quickly. Use in combination with reviews for richer experience. Use to quickly tap into the existing community of a product. Ratings are collected together to present an average rating of an object from the collective user set.', '- WHEN : 1. A user wants to leave an opinion quickly. 2. Use in combination with reviews for richer experience. 3. Use to quickly tap into the existing community of a product. 4. Ratings are collected together to present an average rating of an object from the collective user set.     - HOW : 1. Show clickable items (most often used are stars) that light up on rollover to suggest clickability. 2. Initial state should be empty and show invitational text above to invite the user to rate the object. 3. As the mouse cursor moves over the icons, indicate the level of rating (through a color change) and display a text description of the rating at each point. 4. Once the user has clicked the rating (5th star, 3rd star etc.) the rating should be saved and added to the Average Rating which should be displayed separately. 5. The saved rating should be indicated with a change in final color of the items and a text indication that the rating is saved. 6. An aggregate or average rating should also be displayed. 7. Users should be able to change their rating later if they change their mind.', 'Next to the object that you want to rate.', '', 'http://rog.ie/blog/css-star-rater', NULL, 0, 0, 0, 0, '2014-05-02 17:00:00', 'Designer', 'MarcoWinckler'),
(4, 'Inline Edit', 'Consider using inline edit whenever there is text that the user might need to edit. Use it only when the user needs to edit the text occasionally. If the primary action on the page is to edit content, then it should always be in edit mode.', 'Consider using inline edit whenever there is text that the user might need to edit.\n The inline edit process has usually four different states it can be in: non-edit state, invitation to edit, edit state, and ending state. The inline edit process has usually four different states it can be in: non-edit state, invitation to edit, edit state, and ending state.', 'Where the text need to be change', '', 
'Non-edit state : The text is in view mode, no edit actions are available
Invitation to edit : Invite the user to click the text providing a tooltip when the mouse is over the text the user wants to edit. Use phrase -Click to edit- or just word -Edit-. On hover, change the mouse cursor to an edit cursor. Highlight the element by changing the background of the element to yellow or add borders around it. See Hover invitation pattern for details on how to provide an invitation. An alternative way to invite the user to edit is to show an edit link beside the element the user needs to edit. If the edit link is always visible, the discoverability of this feature improves. If good readability if essential, show the link only on hover.
Edit state : When the user clicks on the element / edit link, load the text into a text box in the same location as the original text to make the transition as smooth as possible. Show buttons for completing and canceling the edit. An alternative for the buttons is to save the changes when the user clicks outside the edit area or tabs away from it. It is visually simpler, but doesn\'t leave the user a chance to cancel the changes unless you use undo. This technique is most commonly used to edit values in a data table.
Ending state : Let the user know that the text is being saved. During the progress, consider replacing the edited text with the text -Saving...- or show a progress indicator.', NULL, 0, 0, 0, 0, '2014-05-02 17:00:00', 'Designer', 'MarcoWinckler'),
(5, 'Navigation Tabs', 'The category titles fit on a single row. You need to represent the highest level navigation options on a site. You need to indicate the user\'s current location in the set of available options.', 'The category titles fit on a single row. The category titles are relatively short and predictable. The number of categories is not likely to change often. The entire width of the page is needed for content. An alternative approach is to use a left bar navigation', 'On a bar at the top of the website', '', 'First, design the information architecture of the Website. Present a single-line row of tabs in a horizontal bar at the top of the page. The most common place for it is right under the site\'s branding and header. If the first tab is labeled Home then it should point to the site\'s home page. The complete tab area is clickable - not just the tab label. Use hover effect to give feedback when the mouse is over a tab. Tab navigation should be maintained on all pages that are linked to by the tab set. When the list of categories becomes too long and suggests the need for a -more...- link, consider using a left bar navigation instead or re-chunking the content.', NULL, 0, 0, 0, 0, '2014-05-02 17:00:00', 'Designer', 'MarcoWinckler');

INSERT INTO `TypeConflict` (`idTypeConflict`, `name`, `description`) VALUES
(1, 'Design', 'Design conflict between design patterns'),
(2, 'Layout', 'Layout conflict between desing patterns'),
(3, 'Implementation', 'Implementation conflict between design patterns'),
(4, 'Name', 'Name conflict between desing patterns'),
(5, 'What', 'What conflict between desing patterns'),
(6, 'Other', 'Other conflict between design patterns');

/*
INSERT INTO `Conflict` (`idConflict`, `name`, `description`, `date`, `nbComments`, `login`, `idTypeConflict`) VALUES
(1, 'Conflict between 2 design pattern', 'This is signaled because there is a conflict between design pattern 1 and 2.', '2014-03-27 00:00:00', 0, 'laurineM', 1);



INSERT INTO `ConflictDesignPattern` (`idConflict`, `idDesignPattern`) VALUES
(1, 1),
(1, 2);
INSERT INTO `CommentDesignPattern` (`idComment`, `login`, `idDesignPattern`, `date`, `comment`) VALUES
(1, 'laurineM', 1, '2014-03-01 00:00:00', 'I think there might be a problem with this one');
*/



INSERT INTO `ImageDesignPattern` (`idImage`, `idDesignPattern`, `link`, `description`) VALUES
(1, 1, '/site/img/designPattern/advancement_box1.png', NULL),
(2, 2, '/site/img/designPattern/multi-step_wizard1.png', NULL),
(3, 2, '/site/img/designPattern/multi-step_wizard2.png', NULL),
(4, 2, '/site/img/designPattern/multi-step_wizard3.png', NULL);

INSERT INTO `Source` (`idSource`, `idDesignPattern`, `author`, `link`) VALUES
(1, 1, 'MarcoWinckler', 'http://www.welie.com/patterns/showPattern.php?patternID=purchase-process'),
(2, 2, 'MarcoWinckler', 'http://www.designofsites.com/about_the_book/patternh1.pdf'),
(3, 2, 'MarcoWinckler', 'http://harbinger.sims.berkeley.edu/ui_designpatterns/webpatterns2/webpatterns/pattern.php?id=7');

/*
INSERT INTO `NoteDesignPattern` (`login`, `idDesignPattern`, `note`) VALUES
('laurineM', 1, 4),
('undefined', 1, 3);
*/

INSERT INTO `Platform` (`idPlatform`, `name`, `description`, `icon`) VALUES
(1, 'Windows', 'Windows Platform', '/site/img/vrac/windows.png'),
(2, 'Linux', 'Linux Platform', '/site/img/vrac/linux.png'),
(3, 'MacOS', 'Apple Platform', '/site/img/vrac/apple.png'),
(4, 'Android', 'Google mobile Platform', '/site/img/vrac/android.png'),
(5, 'iOS', 'Apple mobile platform', '/site/img/vrac/ios.png'),
(6, 'Windows Phone', 'Windows mobile platform', '/site/img/vrac/windowsphone.png');

INSERT INTO `PlatformDesignPattern` (`idDesignPattern`, `idPlatform`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(5, 2),
(5, 3),
(5, 4);

INSERT INTO `System` (`idSystem`, `name`, `description`, `icon`) VALUES
(1, 'Tablet', 'Tablet device', '/site/img/vrac/tablet.png'),
(2, 'Phone', 'Phone device', '/site/img/vrac/tel.png'),
(3, 'Computer', 'Computer device', '/site/img/vrac/ordi.png');

INSERT INTO `SystemDesignPattern` (`idDesignPattern`, `idSystem`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3);


INSERT INTO `Project` (`idProject`, `name`, `description`, `date`, `login`, `current`) VALUES
(1, 'Current Cart', '', '2014-05-02 17:00:00', 'LaurineMarmisse', 1),
(2, 'Current Cart', '', '2014-05-02 17:00:00', 'LoicViguier', 1),
(3, 'Current Cart', '', '2014-05-02 17:00:00', 'HugoGuignard', 1),
(4, 'Current Cart', '', '2014-05-02 17:00:00', 'LoicFaure', 1),
(5, 'Current Cart', '', '2014-05-02 17:00:00', 'MarcoWinckler', 1),
(6, 'Current Cart', '', '2014-05-02 17:00:00', 'undefined', 1);

/* 
INSERT INTO `ProjectDesignPattern` (`idProject`, `idDesignPattern`) VALUES
(1, 1),
(1, 2);

INSERT INTO `Solution` (`idSolution`, `name`, `comment`, `codeSolution`, `nbComments`, `nbRates`, `rate`, `date`, `idConflict`, `login`) VALUES
(1, 'Solution', 'I propose this solution to this conflict.', 'vue = new Vue();vue.setVisible(false);', 0, 0, 0, '2014-03-19 00:00:00', 1, 'laurineM');
*/