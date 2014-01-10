<?php
    header('Location: ../pagetestdp.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/User.php");
    if(isset($_POST['note'])){
        $chaine = explode("-", $_POST['note']);
        $dp = DesignPattern::getDB($chaine[0]);
        $user = User::getDB($chaine[1]);
        DesignPattern::removeNote($dp, $user);
        
    }
?>