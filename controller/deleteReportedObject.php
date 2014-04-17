<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Conflict.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");

    if (isset($_POST['idReported']) AND isset($_POST['typeReported'])){
        $bdd = Database::getConnection();
        if($_POST['typeReported']=="DesignPattern"){
            $dp = new DesignPattern();
            $dp->setID($_POST['idReported']);
            $dp->removeDB($dp);
        }
        if($_POST['typeReported']=="Conflict"){
            $co = new Conflict();
            $co->setID($_POST['idReported']);
            $co->removeDB($co);
        }
        if($_POST['typeReported']=="Solution"){
            $so = new Solution();
            $so->setID($_POST['idReported']);
            $so->removeDB($so);
        }
        $bdd->exec('DELETE FROM Reporting WHERE idReported = \''.$_POST['idReported'].'\' AND typeReported = \''.$_POST['typeReported'].'\'');
    }

    