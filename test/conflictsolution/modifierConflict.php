<?php
    header('Location: ../pagetestconflict.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/conflictSolution/Conflict.php");
    if(isset($_POST['conflict'])){
        $cf = Conflict::getDB($_POST['conflict']);
        $cf->setName($dp->getName()."MODIFY");
        Conflict::modifyDB($cf);
    }
?>