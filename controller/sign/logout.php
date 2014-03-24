<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();
unset($session->login);
unset($session->admin);

header('Location: /site/index.php');