<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitSearch.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitSQL.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();



if(isset($_POST['search_type_table'])){
    if($_POST['search_type_table'] == "Conflict"){
        $session->query = ToolKitSearch::searchConflict();
    }
    else{
        if($_POST['search_type_table'] == "DesignPattern"){
            if(isset($_POST['idCategory'])){
                $nbElem = $_POST['idCategory'];
                //echo $nbElem;
                $_POST['idCategory'] = "";
                for($i = 0; $i < $nbElem; $i++){
                    if(isset($_POST['idCategory'.$i])){
                        $_POST['idCategory'] .= $_POST['idCategory'.$i]."|";
                    }
                    
                }
            }
            //echo "CAT".$_POST['idCategory']."CAT";
            $session->query = ToolKitSearch::searchDP($_POST);
        }
        else{
            $session->query = ToolKitSearch::searchSolution();
        }
    }
}


header("Location: /site/view/search/results.php");
?>