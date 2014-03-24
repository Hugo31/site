<?php

header('Location: /site/index.php');

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Project.php");

if (isset($_POST['usernamesignup']) AND isset($_POST['lastnamesignup']) AND isset($_POST['firstnamesignup']) AND isset($_POST['passwordsignup']) AND isset($_POST['emailsignup'])) {
    $user = new User($_POST['usernamesignup'], md5($_POST['passwordsignup']), $_POST['lastnamesignup'], $_POST['firstnamesignup'], $_POST['emailsignup'], NULL);
    User::addDB($user);
    $proj = new Project(null, "Current Design Pattern", $_POST['usernamesignup'], date("Y-m-d H:i:s"), "");
    $proj->setCurrent(true);
    echo $proj->getDate();
    echo $proj->getName();
    Project::addDB($proj);
}
