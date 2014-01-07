<?php
    header('Location: ../pagetestuser.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/User.php");
    if(isset($_POST['login'])){
        $user = User::getDB($_POST['login']);
        User::removeDB($user);
    }

?>