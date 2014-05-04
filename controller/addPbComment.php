<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();
$reussie = false;
if (isset($session->login)) {
    $user = new User($session->login, "", "", "", "", "");
    if (isset($_POST['id'])) {
        if ($_POST['table'] == "designpattern") {
            $dp = new DesignPattern($_POST['id'], "", "", "", "", "", "");
            $reussie = $dp->addComment($user, $_POST['comment']);
        } else {
            if ($_POST['table'] == "solution") {
                $sl = new Solution($_POST['id'], "", "", "", "", "", "");
                $reussie = $sl->addComment($user, $_POST['comment']);
            } else {
                $cf = new Conflict($_POST['id'], "", "", "", "", "");
                $reussie = $cf->addComment($user, $_POST['comment']);
            }
        }
    }
}
if($reussie){
    $session->message = "You have signaled a problem.";
    $session->messageType = "good";
} else {
    $session->message = "An error occured when signaling a problem.";
    $session->messageType = "bad";
}

header("Location: /site/index.php");