<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Project.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();
$id = -1;
$type = "Nothing";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['type'])) {
    $type = $_POST['type'];
}
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
$reussie = false;
if ($id != -1 && $type != "Nothing") {
    if ($type == "DesignPattern") {
        $dp = new DesignPattern($id);
        $reussie = DesignPattern::removeDB($dp);
    }
    if ($type == "Conflict") {
        $co = new Conflict($id);
        $reussie = Conflict::removeDB($co);
    }
    if ($type == "Solution") {
        $so = new Solution($id);
        $reussie = Solution::removeDB($so);
    }
    if ($type == "Project") {
        $pj = new Project($id);
        $reussie = Project::removeDB($pj);
    }
    $session->message = "You have remove a ".$type;
    if($reussie){
        $session->messageType = "good";
    } else{
        $session->messageType = "bad";
    }
}

    
header("Location: /site/index.php");