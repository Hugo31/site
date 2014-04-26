<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");
if ($_POST['rate'] > 5) {
    $_POST['rate'] = 5;
}
if ($_POST['rate'] < 1) {
    $_POST['rate'] = 1;
}
if ($_POST['table'] == "DesignPattern") {
    $dp = new DesignPattern($_POST['id'], "", "", "", "", "", "");
    echo $dp->addRate(new User($_POST['login'], "", "", "", "", ""), $_POST['rate']);
} else {
    $sl = new Solution($_POST['id'], "", "", "", "", "", "");
    echo $sl->addRate(new User($_POST['login'], "", "", "", "", ""), $_POST['rate']);
}




