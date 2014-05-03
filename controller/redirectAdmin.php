<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();
if(isset($_GET['type'])){
    if ($_GET['type'] == "Conflict") {
        $session->typeQuery = "Conflict";
        $session->query = "SELECT DISTINCT c.idConflict, c.name, c.description, c.idTypeConflict, c.date, c.nbComments, c.login FROM Conflict c ";
    } else {
        if ($_GET['type'] == "DesignPattern") {
            $session->typeQuery = "DesignPattern";
            $session->query = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp";
        }else {
            if ($_GET['type'] == "Solution") {
                $session->typeQuery = "Solution";
                $session->query = "SELECT DISTINCT s.idSolution, s.name, s.comment, s.date, s.rate, s.nbComments, s.nbRates, s.login FROM Solution s ";
            }else {
                $session->typeQuery = "Project";
                $session->query = "SELECT DISTINCT p.idProject, p.name, p.description, p.date, p.login FROM Project p WHERE p.current = false";
            }
            
        }
    }
    $session->searchTextQuery = "";
    $session->targetQuery = "Designer";
    $tab = array();
    $tab["nb"] = 0;
    $session->idCategoryQuery = $tab;
    $session->idComponentQuery = $tab;
    $session->idPlatformQuery = $tab;
    $session->idPropertyQuery = $tab;
    $session->idSystemQuery = $tab;
    
    header("Location: /site/view/results.php");
}
else{
    header("Location: /site/index.php");
}