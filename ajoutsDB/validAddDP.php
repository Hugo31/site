<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/Database.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/userpost/comment/rate/designpattern/Image.php");

    if (isset($_POST['namee']) AND isset($_POST['what']) AND isset($_POST['wah']) AND isset($_POST['layout']) AND isset($_POST['copy']) AND isset($_POST['impl']) AND isset($_POST['thetarget'])) {
        
        $dp = new DesignPattern(-1, $_POST['namee'], 'undefined', date("Y-m-d H:i:s"), $_POST['what'], 0, $_POST['thetarget']);
        //TODO: remplacé 'undefined' par l'utilisateur actuellement connecté 
        $dp->setWhenAndHow($_POST['wah']);
        $dp->setLayout($_POST['layout']);
        $dp->setCopy($_POST['copy']);
        $dp->setImplementation($_POST['impl']);
        
        DesignPattern::addDB($dp);
        
        if (isset($_POST['img'])){
            Image::addImage($dp, $_POST['img']);
        }
        
        header('Location: /site/view/details.php?type=DesignPattern&id=' . $dp->getID());
    }
    else{
        echo '<h3>Error</h3>';
    }
    
    
    
    //on renvoi vers la page du nouveau DP
    //TODO: ajout notification ajout OK
    

