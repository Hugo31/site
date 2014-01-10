<?php
    header('Location: ../pagetestimgsrc.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    if(isset($_POST['designPattern']) and isset($_POST['author']) and isset($_POST['link'])){
        $dp = DesignPattern::getDB($_POST['designPattern']);
        DesignPattern::addSource($dp, $_POST['author'], $_POST['link']);
        
    }
?>
