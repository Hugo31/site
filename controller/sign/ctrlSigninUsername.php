<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");

$username = $_POST['username'];
$password = $_POST['password'];
$donnees = Database::getOneData("SELECT COUNT(login) AS nbLogin FROM User WHERE login = \"" . $username . "\" AND pwd = \"" . md5($password) . "\";");

echo $donnees['nbLogin'];