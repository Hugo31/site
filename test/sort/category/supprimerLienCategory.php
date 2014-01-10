<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/category/Category.php");
    if(isset($_POST['category'])){
        $chaine = explode("-", $_POST['category']);
        $st = Category::getDB($chaine[0]);
        $dp = DesignPattern::getDB($chaine[1]);

        Category::removeLink($dp, $st);
    }
?>
