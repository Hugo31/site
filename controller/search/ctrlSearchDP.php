<?php
//header("Location: ../index.php");
$requete = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what FROM DesignPattern dp";
$cond = "";
ToolKitSQL::generateCriteriaQuery("Category", "cdp", "OR", $requete, $cond, $_POST['idCategory']);
ToolKitSQL::generateCriteriaQuery("Component", "cpdp", "AND", $requete, $cond, $_POST['idComponent']);
ToolKitSQL::generateCriteriaQuery("Platform", "plt", "OR", $requete, $cond, $_POST['idPlatform']);
ToolKitSQL::generateCriteriaQuery("Property", "prt", "AND", $requete, $cond, $_POST['idProperty']);
ToolKitSQL::generateCriteriaQuery("System", "sys", "OR", $requete, $cond, $_POST['idSystem']);


$requete .= " WHERE target = \"".$_POST['target']. "\" AND ";
$requete .= $cond;

//Category : OU, Component : ET, System : OU, platform : OU, property : ET

echo $requete;
?>