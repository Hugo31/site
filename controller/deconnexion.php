<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();

unset($session->login);
$session->message = "You have disconnect";
$session->messageType = "good";

header("Location: /site/index.php");