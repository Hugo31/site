<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/property/Property.php");
    if(isset($_POST['property'])){
        $st = Property::getDB($_POST['property']);
        $st->setName($st->getName()."MODIFY");
        Property::modifyDB($st);
    }
    
?>