<?php
    header('Location: ../pagetestproject.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/Project.php");
    if(isset($_POST['project'])){
        $dp = Project::getDB($_POST['project']);
        Project::removeDB($dp);
    }
?>
