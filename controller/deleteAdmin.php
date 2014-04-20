<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Project.php");

if (isset($_POST['id']) AND isset($_POST['type'])){
    $bdd = Database::getConnection();
    if($_POST['type']=="DesignPattern"){
        $dp = new DesignPattern();
        $dp->setID($_POST['id']);
        $dp->removeDB($dp);
    }
    if($_POST['type']=="Conflict"){
        $co = new Conflict();
        $co->setID($_POST['id']);
        $co->removeDB($co);
    }
    if($_POST['type']=="Solution"){
        $so = new Solution();
        $so->setID($_POST['id']);
        $so->removeDB($so);
    }
    if($_POST['type']=="Project"){
        $pj = new Project();
        $pj->setID($_POST['id']);
        Project::removeDB($pj);
    }
}

    