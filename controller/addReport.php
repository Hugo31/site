<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
$bdd = Database::getConnection();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

$req = $bdd->prepare('INSERT INTO Reporting(name, message, typeReported, idReported, login) VALUES(:name, :message, :typeReported, :idReported, :login)');
$req->execute(array(
    'name' => $_GET['name'],
    'message' => $_POST['repportMessage'],
    'typeReported' => $_GET['type'],
    'idReported' => $_GET['id'],
    'login' => $session->login));

header('Location: /site/index.php');

