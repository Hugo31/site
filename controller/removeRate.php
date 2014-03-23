<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");
if($_POST['table'] == "DesignPattern"){
    $dp = new DesignPattern($_POST['id'], "", "", "", "", "", "");
    return $dp->removeRate(new User($_POST['login'], "", "", "", "", ""), $_POST['rate']);
}
else{
    $sl = new Solution($_POST['id'], "", "", "", "", "", "");
    return $sl->removeRate(new User($_POST['login'], "", "", "", "", ""));
}