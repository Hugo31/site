<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/model/sortTable/SortTable.php");
    if(isset($_POST['triTable'])){
        $chaine = explode("-", $_POST['triTable']);
        $st = SortTable::getDB($chaine[1], ESortTable::getValueEnum($chaine[0]));
        
        SortTable::removeDB($st);
    }
    
?>