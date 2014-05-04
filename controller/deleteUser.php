<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();
$reussie = false;
if ($session->admin && $session->login != $_GET['login']) {
    $user = new User();
    $user->setLogin($_GET['login']);
    $reussie = User::removeDB($user);
}
if($reussie){
    $session->message = "You have removed an user";
    $session->messageType = "good";
} else {
    $session->message = "An error occured when removing an user";
    $session->messageType = "bad";
}

header("Location: /site/index.php");