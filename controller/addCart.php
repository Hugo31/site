<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Project.php");
$session = Session::getInstance();
$bdd = Database::getConnection();
if(isset($session->login)){
    $data = Database::getOneData("SELECT idProject FROM Project WHERE login = \"".$session->login."\" AND current = 1;");
    $proj = Project::getDB($data['idProject']);
    echo $proj->addLink($_POST['idDesignPattern']);
}
else{
    if(isset($session->currentDP)){
        $session->currentDP = array(); 
    }
    $session->currentDP[count($session->currentDP)] = $_POST['idDesignPattern'];
    echo true;
}
