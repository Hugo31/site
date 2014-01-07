<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/model/sortTable/SortTable.php");
    if(isset($_POST['nameST']) and isset($_POST['listePossiblite']) and isset($_POST['descriptionST'])){
        
        $st = new SortTable($_POST['listePossiblite'], 0, $_POST['nameST'], $_POST['descriptionST']);
        SortTable::addDB($st);
    }
?>