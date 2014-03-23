<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");

$email = $_POST['email'];
$password = $_POST['password'];
$donnees = Database::getOneData("SELECT COUNT(mail) AS nbLogin FROM User WHERE mail = \"" . $email . "\" AND pwd = \"" . md5($password) . "\";");

echo $donnees['nbLogin'];