<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Project.php");
$session = Session::getInstance();
if (isset($session->login)) {
    $data = Database::getOneData("SELECT idProject FROM Project WHERE "
            ."login = \"".$session->login."\" AND current = 1");
    
    $proj = Project::getDB($data['idProject']);
    if (isset($_POST['merge'])) {
        if ($_POST['merge'] == "mergeAll") {
            if (isset($session->currentDP)) {
                
                for ($i = 0; $i < count($session->currentDP); $i ++) {
                    $proj->addLink(new DesignPattern($session->currentDP[$i], "", "", "", "", "", ""));
                }
                unset($session->currentDP);
            } 
        } else {
            if ($_POST['merge'] == "replaceCurrent") {
                if (isset($session->currentDP)) {
                    unset($session->currentDP);
                }
            } else {
                if ($_POST['merge'] == "replaceConnected") {
                    if (isset($session->currentDP)) {
                        $response = Database::getAllData("SELECT idDesignPattern FROM ProjectDesignPattern pdp, Project p WHERE "
                                        ."pdp.idProject = p.idProject AND p.login = \"".$session->login."\" AND current = 1");
                        foreach ($response as $row) {
                            $dp = new DesignPattern($row['idDesignPattern'], "", "", "", "", "", "");
                            $proj->removeLink($dp);
                        }
                        for ($i = 0; $i < count($session->currentDP); $i ++) {
                            $proj->addLink(new DesignPattern($session->currentDP[$i], "", "", "", "", "", ""));
                        }
                        unset($session->currentDP);
                    }
                }
            }
        }
    }

}

header("Location: /site/view/currentDP.php");