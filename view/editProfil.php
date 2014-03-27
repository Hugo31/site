<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
Session::getInstance();

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');

if (!$user = User::getDB($session->login)) {
    echo '<center><h3>You must be connected in order to use this page</h3></center>';
} else {
    ?>
    <h1>Edit your profil</h1>

    <section id="contenu">
        <h2><?php echo $user->getLogin() ?></h2>
        <div id="editprofilimg">
            <p>Profil picture</p>
                <img src="<?php echo $user->getLogo() ?>" alt="Image profil" style="width: 100px; height:100px">
        </div>
        <form method="post" id="editprofilform" name="editprofilform"
              action="/site/controller/sign/validEditProfil.php" onsubmit="return true">
            <p>
                <label for="firstnameedit" class="fnameedit">Change your firstname</label>
                <input type="text" id="firstnameedit" name="firstnameedit" 
                       required="required" size="30" maxlength="30"
                       value=<?php $user->getFirstName() ?> />
            </p>
            <div id="errormsgeditprofil_firstname"></div>
            <p>
                <label for="lastnameedit" class="lnameedit">Change your lastname</label>
                <input type="text" id="lastnameedit" name="lastnameedit" 
                       required="required" size="30" maxlength="30" 
                       value=<?php $user->getLastName() ?> />
            </p>
            <div id="errormsgsignupeditprofil_lastnameedit"></div>
            <p>
                <label for="emailedit" class="uemailedit">Change your email</label>
                <input type="email" id="emailedit" name="emailedit" 
                       required="required" size="30" maxlength="30" 
                       value=<?php $user->getMail() ?> />
            </p>
            <div id="errormsgsignupeditprofil_email"></div>
            <br/>
            <p>
                <label for="passwordedit" class="upasswdedit">Change your password</label>
                <input type="password" id="passwordedit" name="passwordedit" 
                       required="required" size="30" maxlength="30" />
            </p>
            <p>
                <label for="passwordedit_confirm" class="upasswdedit">Please confirm your new password</label>
                <input type="password" id="passwordedit_confirm" name="passwordedit_confirm" 
                       required="required" size="30" maxlength="30" />
            </p>
            <div id="errormsgsignupeditprofil_password"></div>
            <p>
                <input type="submit" value="Apply" class="applymodifyprofil" id="applymodifyprofil"/>
            </p>
        </form>
        <h2>Delete your account</h2>
        <a href="/site/controller/sign/delete.php" style="text-decoration: none">
            <button id="deleteprofilbutton">DELETE</button>
        </a>
        <br/>
    </section>

    <?php
}
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
