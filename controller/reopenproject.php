<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Project.php");
$session = Session::getInstance();
if (isset($session->login) && isset($_GET['project'])) {
    $data = Database::getOneData("SELECT idProject FROM Project WHERE "
            ."login = \"".$session->login."\" AND current = 1;");
    
    $proj = Project::getDB($data['idProject']);
    $data = Database::getOneData("SELECT login FROM Project WHERE idProject = ".$_GET['project'].";");
    $projOld = Project::getDB($_GET['project']);
    if ($session->login == $data['login']) {
        $response = Database::getAllData("SELECT idDesignPattern FROM ProjectDesignPattern WHERE "
                                        ."idProject = ".$_GET['project'].";");
        foreach ($response as $row) {
            $dp = new DesignPattern($row['idDesignPattern'], "", "", "", "", "", "");
                $proj->addLink($dp);
        }
        $proj->setDescription($projOld->getName()." : ".$projOld->getDescription());
        
        Project::modifyDB($proj);
        Project::removeDB($projOld);
    }
    

}

header("Location: /site/view/currentDP.php");