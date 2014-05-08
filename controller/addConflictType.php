<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/TypeConflict.php");
$bdd = Database::getConnection();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

$reussie = false;
if (isset($session->login)) {
    $req = $bdd->prepare('INSERT INTO TypeConflict(name, description) VALUES(:name, :description)');
    $reussie = $req->execute(array(
        'name' => $_POST['name'],
        'description' => $_POST['description'])
    );
}
if($reussie){
    $session->message = "You have created a new conflict type.";
    $session->messageType = "good";
} else {
    $session->message = "An error occured when creation a conflict type.";
    $session->messageType = "bad";
}

header('Location: /site/view/contributions.php');

