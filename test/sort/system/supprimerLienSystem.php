<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/system/System.php");
    if(isset($_POST['system'])){
        $chaine = explode("-", $_POST['System']);
        $st = System::getDB($chaine[0]);
        $dp = DesignPattern::getDB($chaine[1]);

        System::removeLink($dp, $st);
    }
?>
