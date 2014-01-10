<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
    if(isset($_POST['triTable'])){
        $st = SortTable::getDB($_POST['triTable']);
        SortTable::removeDB($st);
    }
    
?>