<?php
// On démarre une session
//$session = Session::getInstance(); -> Erreur
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");

// Récupération d'un login ou d'une adresse mail
$login = $_POST['loginsignin'];

// Test de type sur le $login
if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $login)){
    // On remplace l'adresse mail par le login
    $donnees = Database::getOneData("SELECT login FROM User WHERE mail = \"" . $login . "\";");
    $login = $donnees['login'];
}

// Ajout du login dans la variable de session 'login'
//$session->login =  $login; -> Erreur
$_SESSION['login'] = $login;

// On retourne a l'index
header('Location: /site/index.php');