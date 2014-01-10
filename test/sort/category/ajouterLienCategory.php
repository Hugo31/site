<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/category/Category.php");
    if(isset($_POST['category']) and isset($_POST['designPattern'])){
        
        $st = Category::getDB($_POST['category']);
        $dp = DesignPattern::getDB($_POST['designPattern']);
        Category::addLink($dp, $st);
    }
    
?>