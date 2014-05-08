<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");

if (isset($_POST['idReported']) && isset($_POST['typeReported'])) {
    $bdd = Database::getConnection();
    if ($_POST['typeReported'] == "DesignPattern") {
        $dp = new DesignPattern($_POST['idReported']);
        $dp->removeDB($dp);
    }
    if ($_POST['typeReported'] == "Conflict") {
        $co = new Conflict($_POST['idReported']);
        $co->removeDB($co);
    }
    if ($_POST['typeReported'] == "Solution") {
        $so = new Solution($_POST['idReported']);
        $so->removeDB($so);
    }
    if ($_POST['typeReported'] == "CommentDesignPattern") {
        $dp = new CommentDesignPattern($_POST['idReported']);
        $dp->removeDB($dp);
    }
    if ($_POST['typeReported'] == "CommentConflict") {
        $co = new CommentConflict($_POST['idReported']);
        $co->removeDB($co);
    }
    if ($_POST['typeReported'] == "CommentSolution") {
        $so = new CommentSolution($_POST['idReported']);
        $so->removeDB($so);
    }
    
    $bdd->exec('DELETE FROM Reporting WHERE idReported = \''.$_POST['idReported'].'\' AND typeReported = \''.$_POST['typeReported'].'\'');

 } else {
    header('Location: /site/view/404.php');
}

    