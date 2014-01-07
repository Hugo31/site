<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/User.php");
    header('Location: ../pagetestuser.php');

    if(isset($_POST['loginUser'])){
        $user = User::getDB($_POST['loginUser']);
        $user->setPwd($_POST['pwdUser']);
        $user->setLastName($_POST['lastnameUser']);
        $user->setFirstName($_POST['firstnameUser']);
        User::modifyDB($user);
         
    }

?>