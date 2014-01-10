<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/component/Component.php");
    if(isset($_POST['component']) and isset($_POST['designPattern'])){
        
        $st = Component::getDB($_POST['component']);
        $dp = DesignPattern::getDB($_POST['designPattern']);
        Component::addLinkRelated($dp, $st);
    }
    
?>