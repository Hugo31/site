<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Project.php");

if (!empty($_POST['captchasignup'])) {

    /* Conversion en majuscules */
    $userCaptchaCode = strtoupper($_POST['captchasignup']);

    /* Cryptage et comparaison avec la valeur stockée dans $_SESSION['captcha'] */
    if (md5($userCaptchaCode) == $session->captcha) {
        if (isset($_POST['usernamesignup']) AND isset($_POST['lastnamesignup']) AND isset($_POST['firstnamesignup']) AND isset($_POST['passwordsignup']) AND isset($_POST['emailsignup'])) {

            $vu = verifUsername($_POST['usernamesignup']);
            $vf = verifName($_POST['firstnamesignup']);
            $vl = verifName($_POST['lastnamesignup']);
            $ve = verifEmail($_POST['emailsignup']);
            $vp = verfifPass($_POST['passwordsignup'], $_POST['passwordsignup_confirm']);


            if ($vu && $vf && $vl && $ve && $vp) {
                $user = new User($_POST['usernamesignup'], md5($_POST['passwordsignup']), $_POST['lastnamesignup'], $_POST['firstnamesignup'], $_POST['emailsignup'], "/site/img/user/user.png");
                User::addDB($user);
                $proj = new Project(null, "Current Design Pattern", $_POST['usernamesignup'], date(), "");
                $proj->setCurrent(true);
                Project::addDB($proj);
                $session->message = "Congratulations, you can now login to your new account!";
                $session->messageType = "good";
                header('Location: /site/index.php');
            } else {
                $data = "/site/view/signup.php?";
                if ($vu) { $data .= "usrn=" . $_POST['usernamesignup'] . ""; }
                if ($vf) { $data .= "&fstn=" . $_POST['firstnamesignup'] . ""; }
                if ($vl) { $data .= "&lstn=" . $_POST['lastnamesignup'] . ""; }
                if ($ve) { $data .= "&mail=" . $_POST['emailsignup'] . ""; }
                urlencode($data);
                header('Location : ' . $data);
            }
        } else {
            header("Location: /site/view/signup.php");
        }
    } else {
        $data = "/site/view/signup.php?";
        $data .= "usrn=" . $_POST['usernamesignup'] . "";
        $data .= "&fstn=" . $_POST['firstnamesignup'] . "";
        $data .= "&lstn=" . $_POST['lastnamesignup'] . "";
        $data .= "&mail=" . $_POST['emailsignup'] . "";
        urlencode($data);
        header('Location: ' . $data);
    }
} else {
    header('Location: /site/view/signup.php');
}

function verifEmail($email) {
    $syntaxe = preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $email);
    $donnees = Database::getOneData("SELECT COUNT(mail) AS nbMail FROM User WHERE mail = \"" . $email . "\";");
    return ($donnees['nbMail'] == '0' && $syntaxe);
}

function verifName($name) {
    return (preg_match("#^([a-zA-Z'éèêôùûç-]{2,30})$#i", $name));
}

function verifUsername($user) {
    $syntaxe = preg_match("#^[A-z0-9]{3,30}$#i", $user);
    $donnees = Database::getOneData("SELECT COUNT(login) AS nbLogin FROM User WHERE login = \"" . $user . "\";");
    return ($donnees['nbLogin'] == '0' && $syntaxe);
}

function verfifPass($pass1, $pass2) {
    if (preg_match("#^[A-z0-9]{4,30}$#i", $pass1)) {
        return ($pass1 == $pass2);
    } else {
        return false;
    }
}
