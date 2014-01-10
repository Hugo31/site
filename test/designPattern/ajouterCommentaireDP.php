<?php
    header('Location: ../pagetestdp.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/User.php");
    if(isset($_POST['user']) and isset($_POST['designPattern']) and isset($_POST['comment'])){
        $dp = DesignPattern::getDB($_POST['designPattern']);
        $user = User::getDB($_POST['user']);
        DesignPattern::addComment($dp, $user, $_POST['comment']);
        
    }
?>