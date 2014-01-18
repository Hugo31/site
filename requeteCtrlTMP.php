<?php

//Récupérer les informations d'un design pattern
$requete = "SELECT * FROM DesignPattern WHERE idDesignPattern = :idDP";
$requete = "SELECT link FROM ImageDesignPattern WHERE idDesignPattern = :idDP";
$requete = "SELECT author, link FROM Source WHERE idDesignPattern = :idDP";
$requete = "SELECT nom FROM Category c, CategoryDesignPattern cdp WHERE idDesignPattern = :idDP AND c.idCategory = cdp.idCategory";
$requete = "SELECT nom FROM Component c, ComponentDesignPattern cdp WHERE idDesignPattern = :idDP AND c.idComponent = cdp.idComponent";
$requete = "SELECT nom FROM Platform p, PlatformDesignPattern pdp WHERE idDesignPattern = :idDP AND p.idPlatform = pdp.idPlatform";
$requete = "SELECT nom, note FROM Property p, PropertyDesignPattern pdp WHERE idDesignPattern = :idDP AND p.idProperty = pdp.idProperty";
$requete = "SELECT nom FROM System s, SystemDesignPattern sdp WHERE idDesignPattern = :idDP AND s.idSystem = sdp.idSystem";
$requete = "SELECT * FROM CommentDesignPattern WHERE idDesignPattern = :idDP ORDER BY date DESC LIMIT 0, 3";
$requete = "SELECT COUNT(*), AVG(note) FROM NoteDesignPattern WHERE idDesignPattern = :idDP";

