<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?>

<section id="contenu">
    <?php
    
    if (!isset($session->login)) {
        header('Location: 404.php');
    } else {
        $user = User::getDB($session->login);
        ?>
        <h1><?php echo $user->getLogin() ?></h1>
        <div id="profil">
            <h2>Information about me</h2>
            <div id="profillogo">
                Image de profil<br/>
                <img src="<?php echo $user->getLogo() ?>" alt="Image profil" style="width: auto; height:100px">
            </div>
            <div id="profilcontent">
                <div id="profilgauche">
                    Firstname<br/>
                    Lastname<br/>
                    Email<br/>
                </div>
                <div id="profildroit">
                    <?php echo $user->getFirstName() ?><br/>
                    <?php echo $user->getLastName() ?><br/>
                    <?php echo $user->getMail() ?><br/>
                </div>
                <form method="post" id="profilform" name="profilform"
                      action="/site/view/editProfil.php" onsubmit="return true">
                    <input type="submit" value="Modify" class="modifyprofil" id="modifyprofil"/>
                </form>
            </div>
        </div>
    <?php } ?>
</section>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
?>
