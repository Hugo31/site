<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/property/Property.php");
    if(isset($_POST['property'])){
        $chaine = explode("-", $_POST['property']);
        $st = Property::getDB($chaine[0]);
        $dp = DesignPattern::getDB($chaine[1]);

        Property::removeLink($dp, $st);
    }
?>
