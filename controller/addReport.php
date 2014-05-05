<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
$bdd = Database::getConnection();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

$reussie = false;
if (isset($session->login)) {

    $req = $bdd->prepare('INSERT INTO Reporting(name, message, typeReported, idReported, login) VALUES(:name, :message, :typeReported, :idReported, :login)');
    $reussie = $req->execute(array(
        'name' => $_POST['name'],
        'message' => $_POST['repportMessage'],
        'typeReported' => $_POST['type'],
        'idReported' => $_POST['id'],
        'login' => $session->login)
    );
}
if($reussie){
    $session->message = "You have reported a problem.";
    $session->messageType = "good";
} else {
    $session->message = "An error occured when reporting a problem.";
    $session->messageType = "bad";
}

header('Location: /site/index.php');

