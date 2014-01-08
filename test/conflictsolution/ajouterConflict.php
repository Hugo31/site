<?php
    header('Location: ../pagetestconflict.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/conflictSolution/Conflict.php");
    if(isset($_POST['name']) and isset($_POST['desc']) and isset($_POST['user'])){
        $cf = new Conflict(0, $_POST['name'], $_POST['desc'], $_POST['user']);
        Conflict::addDB($cf);
        
    }
?>