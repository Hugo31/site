<?php
    header('Location: ../pagetestdp.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/model/designPattern/DesignPattern.php");
    if(isset($_POST['nameDP']) and isset($_POST['whatDP']) and isset($_POST['targetDP']) and isset($_POST['user'])){
        $dp = new DesignPattern(0, $_POST['nameDP'], $_POST['whatDP'], $_POST['targetDP'], $_POST['user']);
        DesignPattern::addDB($dp);
        
    }
?>