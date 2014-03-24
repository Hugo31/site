<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");

$dp = new DesignPattern($_POST['idDesignPattern'], "", "", "", "", "", "");

$dp->addRate(new User($_POST['login'], "", "", "", "", ""), $_POST['rate']);



