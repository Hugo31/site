<?php

//Récupérer un design pattern selon certains critères
//Pour chaque category, récupérer l'ensemble des choix:
$_POST['category'];
$requete = "SELECT * FROM DesignPattern WHERE name = '%:name%'";
$requete = "SELECT * FROM DesignPattern, CategoryDesignPattern cdp1,  CategoryDesignPattern cdp2"
        ."WHERE cdp1.idCategory = :idCa1 AND cdp2.idCategory = :idCa2";

//Récupérer les informations d'un design pattern
$requete = "SELECT * FROM DesignPattern WHERE idDesignPattern = :idDP";
$requete = "SELECT link FROM ImageDesignPattern WHERE idDesignPattern = :idDP";
$requete = "SELECT author, link FROM Source WHERE idDesignPattern = :idDP";
$requete = "SELECT name FROM Category c, CategoryDesignPattern cdp WHERE idDesignPattern = :idDP AND c.idCategory = cdp.idCategory";
$requete = "SELECT name FROM Component c, ComponentDesignPattern cdp WHERE idDesignPattern = :idDP AND c.idComponent = cdp.idComponent";
$requete = "SELECT name FROM Component c, ComponentRelatedDesignPattern cdp WHERE idDesignPattern = :idDP AND c.idComponent = cdp.idComponent";
$requete = "SELECT name FROM Platform p, PlatformDesignPattern pdp WHERE idDesignPattern = :idDP AND p.idPlatform = pdp.idPlatform";
$requete = "SELECT name, note FROM Property p, PropertyDesignPattern pdp WHERE idDesignPattern = :idDP AND p.idProperty = pdp.idProperty";
$requete = "SELECT name FROM System s, SystemDesignPattern sdp WHERE idDesignPattern = :idDP AND s.idSystem = sdp.idSystem";
$requete = "SELECT * FROM CommentDesignPattern WHERE idDesignPattern = :idDP ORDER BY date DESC LIMIT 0, 3";
$requete = "SELECT COUNT(*), AVG(note) FROM NoteDesignPattern WHERE idDesignPattern = :idDP";

//Récupérer les informations d'un user
$requete = "SELECT * FROM User WHERE login = :login";
$requete = "SELECT idDesignPattern, name FROM DesignPattern WHERE login = :login";
$requete = "SELECT idConflict, name FROM Conflict WHERE login = :login";
$requete = "SELECT idSolution, name FROM Solution WHERE login = :login";
$requete = "SELECT idProject, name FROM Project WHERE login = :login";

//Récupérer les informations d'un critère
$requete = "SELECT * FROM Category WHERE idCategory = :idC";
$requete = "SELECT * FROM Component WHERE idComponent = :idC";
$requete = "SELECT * FROM Platform WHERE idPlatform = :idC";
$requete = "SELECT * FROM Property WHERE idProperty = :idC";
$requete = "SELECT * FROM System WHERE idSystem = :idC";


