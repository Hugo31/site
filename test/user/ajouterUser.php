<?php
    header('Location: ../pagetestuser.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/User.php");
    $bdd = Database::connect();
    if(isset($_POST['loginUser']) AND isset($_POST['pwdUser'])){
        
        $user = new User($_POST['loginUser'], $_POST['pwdUser'], $_POST['lastnameUser'], $_POST['firstnameUser'], 'test', 'test');
        User::addDB($user);
        
    }
?>