<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/platform/Platform.php");
    if(isset($_POST['platform'])){
        $st = Platform::getDB($_POST['platform']);
        Platform::removeDB($st);
    }
    
?>