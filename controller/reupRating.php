<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/ToolkitDisplay.php");

$data = Database::getOneData("SELECT rate, nbRates FROM ".$_POST['table']." WHERE id".$_POST['table']." = ".$_POST['id'].";");

ToolKitDisplay::displayRate($_POST['id'], $data['nbRates'], $data['rate'], $_POST['table'], $session);

