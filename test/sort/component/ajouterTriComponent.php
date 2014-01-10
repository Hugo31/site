<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/component/Component.php");
    if(isset($_POST['nameST']) and isset($_POST['listePossiblite']) and isset($_POST['descriptionST'])){
        
        $st = new Component($_POST['listePossiblite'], 0, $_POST['nameST'], $_POST['descriptionST']);
        Component::addDB($st);
    }
?>
