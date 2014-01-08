<?php
    header('Location: ../pagetestimgsrc.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    if(isset($_POST['image'])){
        DesignPattern::removeComment($_POST['image']);
        
    }
?>