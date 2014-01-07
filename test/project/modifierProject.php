<?php
    header('Location: ../pagetestproject.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/Project.php");
    if(isset($_POST['project'])){
        $project = Project::getDB($_POST['project']);
        $project->setNameProject($project->getNameProject()."MODIFY");
        var_dump($project);
        Project::modifyDB($project);
    }
?>
