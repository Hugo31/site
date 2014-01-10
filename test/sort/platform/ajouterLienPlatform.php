<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/platform/Platform.php");
    if(isset($_POST['platform']) and isset($_POST['designPattern'])){
        
        $st = Platform::getDB($_POST['platform']);
        $dp = DesignPattern::getDB($_POST['designPattern']);
        Platform::addLink($dp, $st);
    }
    
?>