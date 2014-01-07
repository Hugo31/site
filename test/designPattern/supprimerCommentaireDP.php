<?php
    header('Location: ../pagetestdp.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    if(isset($_POST['comment'])){
        DesignPattern::removeComment($_POST['comment']);
        
    }
?>