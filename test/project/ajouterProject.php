<?php
    header('Location: ../pagetestproject.php'); 
    
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/Project.php");
    if(isset($_POST['nameProject']) and isset($_POST['descriptionProject'])){
        
        $st = new Project(0, $_POST['nameProject'], $_POST['descriptionProject'], "hugo");
        Project::addDB($st);   
    }
    
?>
