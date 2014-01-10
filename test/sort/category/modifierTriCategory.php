<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/category/Category.php");
    if(isset($_POST['category'])){
        $st = Category::getDB($_POST['category']);
        $st->setName($st->getName()."MODIFY");
        Category::modifyDB($st);
    }
    
?>