<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/property/Property.php");
    if(isset($_POST['property']) and isset($_POST['designPattern']) and isset($_POST['note'])){
        
        $st = Property::getDB($_POST['property']);
        $dp = DesignPattern::getDB($_POST['designPattern']);
        Property::addLink($dp, $st, $_POST['note']);
    }
    
?>