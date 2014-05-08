<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');

$user = User::getDB($_GET['user']);
?>

<section id="contenu">
    <?php
    
    ?>
    <h1><?php echo $user->getLogin() ?></h1>
    <div id="profil">
        <h2>Informations</h2>
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
        </div>
        <br/>
    </div>
    <h1>Contribution</h1>
    <h2 style="margin:0 auto;">Design pattern</h2><hr>
    <?php
    $bdd = Database::getConnection();
    $session->typeQuery = "DesignPattern";
    $reponse = Database::getAllData("SELECT * FROM DesignPattern WHERE login = \"" . $user->getLogin() . "\";");
    ToolKitDisplay::displayGenericBox($session->typeQuery, $reponse);
    ?>
    <br/><br/>
</section>
<script>
    $("details").hide();
</script>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
?>