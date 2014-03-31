<?php

if(isset($_POST['idProject'])){
    $project = Project::getDB($_POST['idProject']);
    $response = Database::getAllData("SELECT idDesignPattern FROM ProjectDesignPattern WHERE idProject = ".$_POST['idProject']);
    foreach($response as $row){
        $dp = DesignPattern::getDB($row['idDesignPattern']);
        
    }
}

