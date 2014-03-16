<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();
    
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Project.php");
    

    if (isset($_POST['namee']) AND isset($_POST['description'])) {

        $pj = new Project(-1, $_POST['namee'], 'undefined', date("Y-m-d H:i:s"), $_POST['description']);
        //TODO: remplacé 'undefined' par l'utilisateur actuellement connecté 
        
        $bdd = Database::getConnection();
        Project::addDB($pj);
        
        header('Location: /site/view/details.php?type=Project&id=' . $pj->getID());
    }
    else{
        echo '<h3>Error</h3>';
    }
    