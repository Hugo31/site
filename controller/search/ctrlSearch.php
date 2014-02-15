<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitSearch.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitSQL.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();



if(isset($_POST['search_type_table'])){
    if($_POST['search_type_table'] == "Conflict"){
        $session->query = ToolKitSearch::searchConflict($_POST);
    }
    else{
        if($_POST['search_type_table'] == "DesignPattern"){
            //echo "CAT".$_POST['idCategory']."CAT";
            $session->query = ToolKitSearch::searchDP($_POST);
        }
        else{
            $session->query = ToolKitSearch::searchSolution($_POST);
        }
    }
}


header("Location: /site/view/search/results.php");
?>