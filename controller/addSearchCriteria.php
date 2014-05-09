<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/Category.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/Component.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/Platform.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/Property.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/System.php");
$bdd = Database::getConnection();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

$reussie = false;
if (isset($session->login)) {
    
    if (isset($_POST['name'])) {
        $vcriteria = verifCriteria($_POST['name'], $_POST['searchcriteria']);
        if ($vcriteria) {
            $bdd = Database::getConnection();
            if ($_POST['searchcriteria'] == "Category") {
                $criteria = new Category(-1, $_POST['name'], $_POST['description']);
                $reussie = Category::addDB($criteria);
            } else if ($_POST['searchcriteria'] == "Component") {
                $criteria = new Component(-1, $_POST['name'], $_POST['description']);
                $reussie = Component::addDB($criteria);
            } else if ($_POST['searchcriteria'] == "Platform") {
                $criteria = new Platform(-1, $_POST['name'], $_POST['description'], $_POST['icon']);
                $reussie = Platform::addDB($criteria);
            } else if ($_POST['searchcriteria'] == "Property") {
                $criteria = new Property(-1, $_POST['name'], $_POST['description']);
                $reussie = Property::addDB($criteria);
            } else {
                $criteria = new System(-1, $_POST['name'], $_POST['description'],$_POST['icon']);
                $reussie = System::addDB($criteria);
            }
            
            if($reussie){
                $session->message = "You have created a new search criteria.";
                $session->messageType = "good";
            } else {
                $session->message = "An error occured when creation a criteria.";
                $session->messageType = "bad";
            }
        } else {
            $session->message = "Criteria exists in the database.";
            $session->messageType = "bad";
        }
    }
}
header('Location: /site/view/contributions.php');

function verifCriteria($name, $table) {
    $donnees = Database::getOneData("SELECT COUNT(*) AS nb FROM ".$table." WHERE name = \"" . $name . "\";");
    return ($donnees['nb'] == '0');
}

