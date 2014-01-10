<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/platform/Platform.php");
    if(isset($_POST['platform'])){
        $chaine = explode("-", $_POST['platform']);
        $st = Platform::getDB($chaine[0]);
        $dp = DesignPattern::getDB($chaine[1]);

        Platform::removeLink($dp, $st);
    }
?>
