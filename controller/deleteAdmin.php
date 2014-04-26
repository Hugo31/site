<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Project.php");
$id = -1;
$type = "";
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

if ($id != -1 AND $type != "") {
    if ($type == "DesignPattern") {
        $dp = new DesignPattern($id);
        $dp->removeDB($dp);
    }
    if ($type == "Conflict") {
        $co = new Conflict($id);
        $co->removeDB($co);
    }
    if ($type == "Solution") {
        $so = new Solution($id);
        $so->removeDB($so);
    }
    if ($type == "Project") {
        $pj = new Project($id);
        Project::removeDB($pj);
    }
}

    