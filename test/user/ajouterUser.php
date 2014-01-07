<?php
    header('Location: ../pagetestuser.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/model/Database.php");
    $bdd = Database::connect();
    if(isset($_POST['loginUser']) AND isset($_POST['pwdUser'])){
        $value = '\''.$_POST['loginUser'].'\', \''.$_POST['pwdUser'].'\', \''.$_POST['lastnameUser'].'\', ';
        $value .= '\''.$_POST['firstnameUser'].'\', \''.$_POST['lastnameUser'].'@gmail.com\'';
        
        $bdd->exec('INSERT INTO User(login, pwd, lastname, firstname, mail) VALUES('.$value.')');
    }
?>