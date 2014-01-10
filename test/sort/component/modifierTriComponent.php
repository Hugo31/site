<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/component/Component.php");
    if(isset($_POST['component'])){
        $st = Component::getDB($_POST['component']);
        $st->setName($st->getName()."MODIFY");
        Component::modifyDB($st);
    }
    
?>