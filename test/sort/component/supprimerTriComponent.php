<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/component/Component.php");
    if(isset($_POST['component'])){
        $st = Category::getDB($_POST['component']);
        Category::removeDB($st);
    }
    
?>