<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Project.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/designpattern/DesignPattern.php");
$session = Session::getInstance();

if (isset($session->login)) {
    if (isset($_POST['date'])) {
        $date = $_POST['date'];
    } else {
        $date = date("Y-m-d H:i:s");
    }
    $data = Database::getOneData("SELECT p.idProject, count(idDesignPattern) as nb FROM ProjectDesignPattern pdp, Project p WHERE "
            ."pdp.idProject = p.idProject AND p.login = \"".$session->login."\" AND current = 1");
            
    if ($data['nb'] > 0) {
        $projTemp = Project::getDB($data['idProject']);
        $proj = new Project(null, $_POST['name_project'], $session->login, $date, $_POST['desc_project']);
        $reussie = Project::addDB($proj);
        $response = Database::getAllData("SELECT idDesignPattern FROM ProjectDesignPattern pdp, Project p WHERE "
                                        ."pdp.idProject = p.idProject AND p.login = \"".$session->login."\" AND current = 1");
        foreach ($response as $row) {
            $dp = new DesignPattern($row['idDesignPattern'], "", "", "", "", "", "");
            $proj->addLink($dp);
            $projTemp->removeLink($dp);
        }
        if($reussie){
            $session->message = "You have created a new project.";
            $session->messageType = "good";
        } else {
            $session->message = "An error occured when creation our project.";
            $session->messageType = "bad";
        }
    }
    
}
header("Location: /site/index.php");