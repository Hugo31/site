<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");

$email = $_POST['email'];
$donnees = Database::getOneData("SELECT COUNT(mail) AS nbMail FROM User WHERE mail = \"" . $email . "\";");

echo $donnees['nbMail'];