<?php
// On démarre une session
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance(); 

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");

// Récupération d'un login ou d'une adresse mail
$login = $_POST['loginsignin'];

// Test de type sur le $login
if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $login)){
    // On remplace l'adresse mail par le login
    $donnees = Database::getOneData("SELECT login FROM User WHERE mail = \"" . $login . "\";");
    $login = $donnees['login'];
}

$donnees = Database::getOneData("SELECT typeUser FROM User WHERE login = \"" . $login . "\";");
if ($donnees['typeUser'] == "Admin"){
    $session->admin = $login;
} 

$session->login = $login;

// On retourne a l'index
header('Location: /site/index.php');