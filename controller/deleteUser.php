<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();
if ($session->admin && $session->login != $_GET['login']) {
    $user = new User();
    $user->setLogin($_GET['login']);
    User::removeDB($user);
}
