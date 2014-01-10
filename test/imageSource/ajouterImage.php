<?php
    header('Location: ../pagetestimgsrc.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    if(isset($_POST['designPattern']) and isset($_POST['link'])){
        $dp = DesignPattern::getDB($_POST['designPattern']);
        DesignPattern::addImage($dp, $_POST['link']);
        
    }
?>
