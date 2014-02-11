<?php
header("Location: /site/view/search/results.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitSearch.php");
if(isset($_POST['search_type_table'])){
    if($_POST['search_type_table'] == "Conflict"){
        ToolKitSearch::searchConflict();
    }
    else{
        if($_POST['search_type_table'] == "DesignPattern"){
            ToolKitSearch::searchDP();
        }
        else{
            ToolKitSearch::searchSolution();
        }
    }
}

?>