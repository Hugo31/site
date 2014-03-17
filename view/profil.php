<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');

if (!$user = User::getDB($session->login)) echo "__Wrong User";
?>

<section id="contenu">
    <h1><?php echo $user->getLogin() ?></h1>
    <div id="profil">
        <div id="profillogo">
            Image de profil
        </div>
        <div id="profilcontent">
            <div id="profilgauche">
                Firstname<br/>
                Lastname<br/>
                Email<br/>
                Password<br/>
            </div>
            <div id="profildroit">
                <?php echo $user->getFirstName() ?><br/>
                <?php echo $user->getLastName() ?><br/>
                <?php echo $user->getMail() ?><br/>
                <?php echo $user->getPwd() ?><br/>
            </div>
        </div>
        <form method="post" id="profilform" name="profilform"
              action="#" onsubmit="return false">

            <input type="submit" value="Modify" class="modifyprofil" id="modifyprofil"/>
    </div>
</section>

<?php
include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');
