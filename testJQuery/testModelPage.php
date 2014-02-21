<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/user/User.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/ETarget.php");

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
        
        ?>
    </body>
</html>
