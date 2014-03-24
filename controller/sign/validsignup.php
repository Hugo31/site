<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

if (!empty($_POST['captchasignup'])) {

    /* Conversion en majuscules */
    $userCaptchaCode = strtoupper($_POST['captchasignup']);

    /* Cryptage et comparaison avec la valeur stockée dans $_SESSION['captcha'] */
    if (md5($userCaptchaCode) == $session->captcha) {
        header('Location: /site/index.php');
        if (isset($_POST['usernamesignup']) AND isset($_POST['lastnamesignup']) AND isset($_POST['firstnamesignup']) AND isset($_POST['passwordsignup']) AND isset($_POST['emailsignup'])) {
            $user = new User($_POST['usernamesignup'], $_POST['passwordsignup'], $_POST['lastnamesignup'], $_POST['firstnamesignup'], $_POST['emailsignup'], NULL);
            User::addDB($user);
            $proj = new Project(null, "Current Design Pattern", $_POST['usernamesignup'], date(), "");
            $proj->setCurrent(true);
            Project::addDB($proj);
        }
    } else {
        header('Location: /site/view/signup.php');
    }
} else {
    header('Location: /site/view/signup.php');
}

