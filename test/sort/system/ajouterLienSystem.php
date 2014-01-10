<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/system/System.php");
    if(isset($_POST['system']) and isset($_POST['designPattern'])){
        
        $st = System::getDB($_POST['system']);
        $dp = DesignPattern::getDB($_POST['designPattern']);
        System::addLink($dp, $st);
    }
    
?>