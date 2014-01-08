<?php
    header('Location: ../pagetestconflict.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/conflictSolution/Conflict.php");
    if(isset($_POST['conflict']) and isset($_POST['designPattern'])){
        
        $cf = Conflict::getDB($_POST['conflict']);
        $dp = DesignPattern::getDB($_POST['designPattern']);
        Conflict::addLink($dp, $cf);
    }
    
?>