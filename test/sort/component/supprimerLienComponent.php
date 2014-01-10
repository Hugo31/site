<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/component/Component.php");
    if(isset($_POST['component'])){
        $chaine = explode("-", $_POST['component']);
        $st = Component::getDB($chaine[0]);
        $dp = DesignPattern::getDB($chaine[1]);

        Component::removeLink($dp, $st);
    }
?>
