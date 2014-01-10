<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/system/System.php");
    if(isset($_POST['system'])){
        $st = System::getDB($_POST['system']);
        System::removeDB($st);
    }
    
?>
