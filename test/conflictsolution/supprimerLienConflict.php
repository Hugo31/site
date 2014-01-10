<?php
    header('Location: ../pagetestconflict.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/conflictSolution/Conflict.php");
    if(isset($_POST['conflictDP'])){
        $chaine = explode("-", $_POST['conflictDP']);
        
        $cf = Conflict::getDB($chaine[1]);
        $dp = DesignPattern::getDB($chaine[0]);
        Conflict::removeLink($dp, $cf);
    }
?>
