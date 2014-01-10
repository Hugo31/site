<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/User.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");

function writeTest($msgBefore, $var, $msgAfter){
    echo $msgBefore;
    var_dump($var);
    echo $msgAfter."<br/>";
}
/*
 * doit inclure tout les tests de base sur la bd
 */

$user1 = new User("bobRobBG", "mypwd", "Bob", "Robert", "robert.bob@gmail.com", "");
$user2 = new User("brianKitchen", "mypwd", "Brian", "Bro", "brian.bro@gmail.com", "");

writeTest("Ajout de l'user1 : ", User::addDB($user1), "");
writeTest("Ajout de l'user2 : ", User::addDB($user2), "");

$user3 = User::getDB("bobRobBG");
$user4 = User::getDB("brianKitchen");
$user3->setFirstName("BobBrian");
$user4->setMail("bro@gmail.com");

writeTest("Modification de l'user3 alias user1 : ", User::modifyDB($user3), "");
writeTest("Modification de l'user4 alias user2 : ", User::modifyDB($user4), "");

$dp1 = new DesignPattern(0, "Multi-Step", "Produit un design", "BROO", "Designer", "bobRobBG");
$dp2 = new DesignPattern(0, "BackTracker", "Produit un design", 0, "Designer", "bobRobBG");

writeTest("Ajout du dp1", DesignPattern::addDB($dp1), "");
writeTest("Ajout du dp2", DesignPattern::addDB($dp2), "");

$dp3 = DesignPattern::getDB($dp1->getID());
$dp4 = DesignPattern::getDB($dp2->getID());
$dp3->setWhat("Méthode pour guider l'utilisateur");
$dp4->setLayout("C'est un layout");

writeTest("Modification de dp3 alias dp1 : ", DesignPattern::modifyDB($dp3), "");
writeTest("Modification de dp4 alias dp2 : ", DesignPattern::modifyDB($dp4), "");

writeTest("Ajout d'un com : ", DesignPattern::addComment($dp1, $user1, "C'est le premier commentaire"), "");
writeTest("Ajout d'un com : ", DesignPattern::addComment($dp1, $user2, "C'est le deuxième commentaire"), "");
//Pour tester la suppresion d'un com, faudra passer par une autre méthode
writeTest("Ajout d'une note : ", DesignPattern::addNote($dp1, $user1, 10), "");
writeTest("Fake Ajout d'une note : ", DesignPattern::addNote($dp1, $user1, 10), " = FALSE");
writeTest("Suppr d'une note : ", DesignPattern::removeNote($dp1, $user1), "");


writeTest("Suppression de dp1 : ", DesignPattern::removeDB($dp1), "");
writeTest("Suppression de dp2 : ", DesignPattern::removeDB($dp2), "");
writeTest("Suppression de user1 : ", User::removeDB($user1), "");
writeTest("Suppression de user2 : ", User::removeDB($user2), "");

?>
