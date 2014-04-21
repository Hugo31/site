<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/User.php");
$session = Session::getInstance();
if(isset($session->login)){
    $user = new User($session->login, "", "", "", "", "");
    if(isset($_POST['id'])){
        if($_POST['table'] == "designpattern"){
            $dp = new DesignPattern($_POST['id'], "", "", "", "", "", "");
            echo $dp->addComment($user, $_POST['comment']);
        }
        else{
            if($_POST['table'] == "solution"){
                $sl = new Solution($_POST['id'], "", "", "", "", "", "");
                echo $sl->addComment($user, $_POST['comment']);
            }
            else{
                $cf = new Conflict($_POST['id'], "", "", "", "", "");
                echo $cf->addComment($user, $_POST['comment']);
            }
        }
    }
    else{
        echo false;
    }
}
else{
        echo false;
}


//header("Location: /site/index.php");