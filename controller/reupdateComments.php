<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/ToolkitDisplay.php");
ToolkitDisplay::displayCommentsLittles($_POST['id'], $_POST['nbComments'], $_POST['table'], $session);
ToolKitDisplay::displayAddComment($_POST['id'], $_POST['table'], $_POST['nbComments']);