<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/user/User.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/ETarget.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/conflict/Conflict.php");
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $bdd = Database::getConnection();
        $sql = file_get_contents($_SERVER['DOCUMENT_ROOT']."/site/projet.sql");
        $bdd->exec($sql);
        
        
        $userUndef = new User("undefined", "test", "Broman", "Robert", "r.broman@gmail.com", "");
        echo "User ajouté : ".User::addDB($userUndef)."<br>";
        $anotherUser = User::getDB($userUndef->getLogin());
        $anotherUser->setLastName("Johnson");
        echo "User modifié : ".User::modifyDB($anotherUser)."<br>";
        echo "User supprimer : ".User::removeDB($userUndef)."<br>";
        echo "User ajouté pour la suite des tests : ".User::addDB($userUndef)."<br>";
        
        $dpFactory = new DesignPattern(0, "Unnamed", $userUndef->getLogin(), date("Y-m-d H:i:s"), "Construit une classe qui construit d'autres classes", 0, ETarget::Designer);
        echo "DP ajouté : ".DesignPattern::addDB($dpFactory)."<br>";
        $anotherDP = DesignPattern::getDB($dpFactory->getID());
        $anotherDP->setName("Factory");
        echo "DP modifié : ".DesignPattern::modifyDB($anotherDP)."<br>";
        echo "DP supprimer : ".DesignPattern::removeDB($anotherDP)."<br>";
        echo "DP ajouté pour la suite des tests : ".DesignPattern::addDB($dpFactory)."<br>";
        $dpObserver = new DesignPattern(0, "Observer", $userUndef->getLogin(), date("Y-m-d H:i:s"), "Verifie des classes", 0, ETarget::Designer);
        echo "DP 2 ajouter : ".  DesignPattern::addDB($dpObserver)."<br>";
        
        $conflict1 = new Conflict(0, "Conflict", "undefined", date("Y-m-d H:i:s"), "Description de conflict", "Conflict between design pattern");
        echo "Conflict ajouté : ".Conflict::addDB($conflict1)."<br>";
        $conflictMod = Conflict::getDB($conflict1->getID());
        $conflictMod->setName("New Conflict");
        echo "Conflict modifié : ".Conflict::modifyDB($conflictMod)."<br>";
        echo "Conflict supprimé : ".Conflict::removeDB($conflict1)."<br>";
        echo "Conflict ajouté : ".Conflict::addDB($conflict1)."<br>";
        
        echo "Lien entre Factory et conflict1 ajouter : ".Conflict::addLink($dpFactory, $conflict1)."<br>";
        echo "Lien entre Observer et conflict1 ajouter : ".Conflict::addLink($dpObserver, $conflict1)."<br>";
        echo "Lien entre Factory et conflict1 supprimer : ".Conflict::removeLink($dpFactory, $conflict1)."<br>";
        echo "Lien entre Factory et conflict1 ajouter : ".Conflict::addLink($dpFactory, $conflict1)."<br>";
        
        
        
        
        ?>
    </body>
</html>
