<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");
if ($_POST['table'] == "DesignPattern") {
    $dp = new DesignPattern($_POST['id'], "", "", "", "", "", "");
    echo $dp->removeRate(new User($_POST['login'], "", "", "", "", ""));
} else {
    $sl = new Solution($_POST['id'], "", "", "", "", "", "");
    echo $sl->removeRate(new User($_POST['login'], "", "", "", "", ""));
}