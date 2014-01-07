<?php
    header('Location: ../pagetestdp.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    if(isset($_POST['designPattern'])){
        $dp = DesignPattern::getDB($_POST['designPattern']);
        $dp->setNameDP($dp->getNameDP()."MODIFY");
        DesignPattern::modifyDB($dp);
    }
    
?>