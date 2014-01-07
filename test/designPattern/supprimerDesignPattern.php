<?php
    header('Location: ../pagetestdp.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/model/designPattern/DesignPattern.php");
    if(isset($_POST['designPattern'])){
        $dp = DesignPattern::getDB($_POST['designPattern']);
        DesignPattern::removeDB($dp);
    }
    
?>