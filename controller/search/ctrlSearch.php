<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitSearch.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();



if(isset($_POST['search_type_table'])){
    if($_POST['search_type_table'] == "Conflict"){
        $session->query = ToolKitSearch::searchConflict();
    }
    else{
        if($_POST['search_type_table'] == "DesignPattern"){
            $session->query = ToolKitSearch::searchDP();
        }
        else{
            $session->query = ToolKitSearch::searchSolution();
        }
    }
}


header("Location: /site/view/search/results.php");
?>