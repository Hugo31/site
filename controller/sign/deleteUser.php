<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");
$session = Session::getInstance();

if (isset($session->login)) {
    $user = new User();
    $user->setLogin($session->login);
    User::removeDB($user);
    unset($session->login);
    header('Location: /site/index.php');
}


