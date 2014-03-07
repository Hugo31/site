<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");

$username = $_POST['username'];
$donnees = Database::getOneData("SELECT COUNT(login) AS nbLogin FROM User WHERE login = \"" . $username . "\";");

echo $donnees['nbLogin'];