<?php

header('Location: /site/indexlaurine/index.html');

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/user/User.php");

if (isset($_POST['usernamesignup']) AND isset($_POST['lastnamesignup']) 
        AND isset($_POST['firstnamesignup']) AND isset($_POST['passwordsignup']) 
        AND isset($_POST['emailsignup'])) {
    $user = new User($_POST['usernamesignup'], $_POST['passwordsignup'], 
            $_POST['lastnamesignup'], $_POST['firstnamesignup'], 
            $_POST['emailsignup'], NULL);
    User::addDB($user);
}
