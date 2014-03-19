<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');

if (!$user = User::getDB($session->login))
    echo "__Wrong User";
?>

<section id="contenu">
    <h1><?php echo $user->getLogin() ?></h1>
    <form method="post" id="profilform" name="profilform"
          action="/site/view/profil.php" onsubmit="return true">
        <input type="submit" value="Modify" class="modifyprofil" id="modifyprofil"/>
    </form>
</section>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
