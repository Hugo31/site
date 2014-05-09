<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");

if (isset($session->admin) && isset($_POST['idReported']) && isset($_POST['typeReported'])) {
    $bdd = Database::getConnection();
    $bdd->exec('DELETE FROM Reporting WHERE idReported = \''.$_POST['idReported'].'\' AND typeReported = \''.$_POST['typeReported'].'\'');  
}