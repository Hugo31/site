<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();
    
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Conflict.php");
    

    if (isset($_POST['selectDP2']) AND isset($_POST['namee']) AND isset($_POST['description']) AND isset($_POST['typee']) AND isset($_POST['DP1'])) {

        $cf = new Conflict(-1, $_POST['namee'], $session->login, date("Y-m-d H:i:s"), $_POST['description'], $_POST['typee']);
        
        Conflict::addDB($cf);

        $cf->addLink($_POST['DP1']);
        $cf->addLink($_POST['selectDP2']);

        header('Location: /site/view/details.php?type=Conflict&id=' . $cf->getID());
    }
    else{
        echo '<h3>Error</h3>';
    }
    