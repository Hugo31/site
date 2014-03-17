<?php
include('header.php');
include('search.php');

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

$donnees = Database::getOneData('Select * FROM User Where login = "' . $_SESSION['login'] . '"');
$user = new User($donnees['login'], $donnees['pwd'], $donnees['lastname'], $donnees['firstname'], $donnees['mail'], $donnees['logo']);
?>

<section id="contenu">
    <h1><?php echo $user->getLogin() ?></h1>
    <div id="profil">
        <div id="profillogo">
            Logo <br/>
            <br/>
            image
            <br/>
            <br/>
        </div>
        <div id="profilcontent">
            <div id="profilgauche">
                Firstname <?php ?><br/>
                Lastname <?php ?><br/>
                Email <?php ?><br/>
                Password <?php ?><br/>
            </div>
            <div id="profildroit">
                <?php $user->getFirstName() ?>
                Jean<br/>
                <?php $user->getLastName() ?>
                Michel<br/>
                <?php $user->getMail() ?>
                jeanmi@mail.com<br/>
                <?php $user->getPwd() ?>
                ********<br/>
            </div>
        </div>
        <form method="post" id="profilform" name="profilform"
              action="#" onsubmit="return false">

            <input type="submit" value="Modify" class="modifyprofil" id="modifyprofil"/>
    </div>
</section>

<?php
include ('footer.php');
