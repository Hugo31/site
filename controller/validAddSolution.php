<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();
    
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");
    

    if (isset($_POST['namee']) AND isset($_POST['comment']) AND isset($_POST['code']) AND isset($_POST['conflict'])) {

        $sol = new Solution(-1, $_POST['namee'], $session->login, date("Y-m-d H:i:s"), $_POST['comment'], $_POST['code'], $_POST['conflict']);
        
        $bdd = Database::getConnection();
        Solution::addDB($sol);
        
        header('Location: /site/view/details.php?type=Solution&id=' . $sol->getID());
    }
    else{
        echo '<h3>Error</h3>';
    }
    