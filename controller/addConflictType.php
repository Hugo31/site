<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/TypeConflict.php");
$bdd = Database::getConnection();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

$reussie = false;
if (isset($session->login)) {
    
    if (isset($_POST['name'])) {
        $vtc = verifTypeConflict($_POST['name']);
        if ($vtc) {
            $conflicType = new TypeConflict(-1, $_POST['name'], $_POST['description']);   
            $bdd = Database::getConnection();
            $reussie = TypeConflict::addDB($conflicType);
            if($reussie){
                $session->message = "You have created a new conflict type.";
                $session->messageType = "good";
            } else {
                $session->message = "An error occured when creation a conflict type.";
                $session->messageType = "bad";
            }
        } else {
            $session->message = "Conflict type exists in the database.";
            $session->messageType = "bad";
        }
    }
}
header('Location: /site/view/contributions.php');

function verifTypeConflict($nametype) {
    $donnees = Database::getOneData("SELECT COUNT(*) AS nb FROM TypeConflict WHERE name = \"" . $nametype . "\";");
    return ($donnees['nb'] == '0');
}

