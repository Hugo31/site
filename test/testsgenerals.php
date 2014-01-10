<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/User.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
/*
 * doit inclure tout les tests de base sur la bd
 */

$user1 = new User("bobRobBG", "mypwd", "Bob", "Robert", "robert.bob@gmail.com", "");
$user2 = new User("brianKitchen", "mypwd", "Brian", "Bro", "brian.bro@gmail.com", "");

echo "Ajout de l'user1 : ";
var_dump(User::addDB($user1));
echo "<br/>";
echo "Ajout de l'user2 : ";
var_dump(User::addDB($user2));
echo "<br/>";

$user3 = User::getDB("bobRobBG");
$user4 = User::getDB("brianKitchen");
$user3->setFirstName("BobBrian");
$user4->setMail("bro@gmail.com");

echo "Modification de l'user3 alias user1 : ";
var_dump(User::modifyDB($user3));
echo "<br/>";
echo "Modification de l'user4 alias user2 : ";
var_dump(User::modifyDB($user4));
echo "<br/>";



$dp1 = new DesignPattern(0, "Multi-Step", "Produit un design", "BROO", "Designer", "bobRobBG");
$dp2 = new DesignPattern(0, "BackTracker", "Produit un design", 0, "Designer", "bobRobBG");

echo "Ajout du dp1";
var_dump(DesignPattern::addDB($dp1));
echo "<br/>";
echo "Ajout du dp2";
var_dump(DesignPattern::addDB($dp2));
echo "<br/>";

$dp3 = DesignPattern::getDB($dp1->getID());
$dp4 = DesignPattern::getDB($dp2->getID());
$dp3->setWhat("Méthode pour guider l'utilisateur");
$dp4->setLayout("C'est un layout");

echo "Modification de dp3 alias dp1 : ";
var_dump(DesignPattern::modifyDB($dp3));
echo "<br/>";
echo "Modification de dp4 alias dp2 : ";
var_dump(DesignPattern::modifyDB($dp4));
echo "<br/>";


echo "Suppression de dp1 : ";
var_dump(DesignPattern::removeDB($dp1));
echo "<br/>";
echo "Suppression de dp2 : ";
var_dump(DesignPattern::removeDB($dp2));
echo "<br/>";
echo "Suppression de user1 : ";
var_dump(User::removeDB($user1));
echo "<br/>";
echo "Suppression de user2 : ";
var_dump(User::removeDB($user2));
echo "<br/>";
?>
