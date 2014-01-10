<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/platform/Platform.php");
    if(isset($_POST['nameST']) and isset($_POST['listePossiblite']) and isset($_POST['descriptionST'])){
        
        $st = new Platform($_POST['listePossiblite'], 0, $_POST['nameST'], $_POST['descriptionST']);
        Platform::addDB($st);
    }
?>
