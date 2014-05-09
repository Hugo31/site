<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
Session::getInstance();

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');

$pwdNotification = "";
$usrNotification = "";

function verifEmail($email) {

    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $email)) {
        return true;
    }

    global $usrNotification;
    $usrNotification = "Please, put a valid email";
    return false;
}

function verifName($name) {

    if (preg_match("#^([a-zA-Z'éèêôùûç-]{2,30})$#i", $name)) {
        return true;
    }

    global $usrNotification;
    $usrNotification = "Please, put a valid name";
    return false;
}

function verifPassword($pass1, $pass2) {
    global $pwdNotification;

    if (preg_match("#^[A-z0-9]{4,30}$#i", $pass1)) {
        if ($pass1 == $pass2) {
            $pwdNotification = "Password has been changed";
            return true;
        } else {
            $pwdNotification = "Please, put the same password";
            return false;
        }
    }

    $pwdNotification = "Please, put a valid password";
    return false;
}

if (!isset($session->login)) {
    header('Location: 404.php');
} else {
    $user = User::getDB($session->login);
    if (isset($_POST['firstnameedit']) && isset($_POST['lastnameedit']) && isset($_POST['emailedit']) && isset($_POST['passwordedit']) && isset($_POST['passwordedit_confirm'])) {

        $pass1 = $_POST['passwordedit'];
        $pass2 = $_POST['passwordedit_confirm'];

        if ($pass1 != '' || $pass2 != '') {
            if (verifPassword($pass1, $pass2)) {
                $user->setPwd(md5($pass1));
                User::modifyDB($user);
                $session->message = "Your password has been changed";
                $session->messageType = "good";
            }
        }

        $verife = verifEmail($_POST['emailedit']);
        $veriff = verifName($_POST['firstnameedit']);
        $verifl = verifName($_POST['lastnameedit']);

        if ($verife && $veriff && $verifl &&
                ($user->getFirstName() != $_POST['firstnameedit'] ||
                $user->getLastName() != $_POST['lastnameedit'] ||
                $user->getMail() != $_POST['emailedit'])) {
            $user->setMail($_POST['emailedit']);
            $user->setFirstName($_POST['firstnameedit']);
            $user->setLastName($_POST['lastnameedit']);
            
            if(isset($session->admin)){
                echo "PASSAGE";
                $user->setTypeUser(ETypeUser::Admin);
            }
            
            $usrNotification = "User informations has been changed";
            User::modifyDB($user);
            $session->message = "Your profil has been changed";
            $session->messageType = "good";
        }
    }
    ?>

    <section id="contenu">
        <?php
        
        ?>
        <h1>Edit your profil</h1>

        <h2><?php echo $user->getLogin() ?></h2>
        <div id="editprofilimg">
            <p>Profil picture</p>
            <img src="<?php echo $user->getLogo() ?>" alt="Image profil" style="width: auto; height:100px">

        </div>
        <br/>

        <form method="post" id="editprofilimgform" name="editprofilimgform"
              action="#" onsubmit="return true">
            <label for="editimgup">Image upload</label>
            <input type="file" id="editimgup" name="editimgup" accept="image/*">
            <input type="submit" value="Submit" class="applymodifyimgprofil" id="applymodifyimgprofil"/>
        </form>

        <form method="post" id="editprofilform" name="editprofilform"
              action="/site/view/editProfil.php" onsubmit="return true">
            <p>
                <label for="firstnameedit" class="fnameedit">Change your firstname</label>
                <input type="text" id="firstnameedit" name="firstnameedit" 
                       required="required" size="30" maxlength="30"
                       value=<?php echo $user->getFirstName() ?> />
            </p>
            <p>
                <label for="lastnameedit" class="lnameedit">Change your lastname</label>
                <input type="text" id="lastnameedit" name="lastnameedit" 
                       required="required" size="30" maxlength="30" 
                       value=<?php echo $user->getLastName() ?> />
            </p>
            <p>
                <label for="emailedit" class="uemailedit">Change your email</label>
                <input type="email" id="emailedit" name="emailedit" 
                       required="required" size="30" maxlength="30" 
                       value=<?php echo $user->getMail() ?> />
            </p>
            <div id="errormsgeditprofil_usr" style="color: green; margin-left: 150px">
                <?php echo $usrNotification ?>
            </div>
            <br/>
            <p>
                <label for="passwordedit" class="upasswdedit">Change your password</label>
                <input type="password" id="passwordedit" name="passwordedit" 
                       size="30" maxlength="30" />
            </p>
            <p>
                <label for="passwordedit_confirm" class="upasswdedit">Please confirm your new password</label>
                <input type="password" id="passwordedit_confirm" name="passwordedit_confirm" 
                       size="30" maxlength="30" />
            </p>
            <div id="errormsgeditprofil_pwd" style="color: green; margin-left: 150px">
                <?php echo $pwdNotification ?>
            </div>
            <p>
                <input type="submit" value="Apply" class="applymodifyprofil" id="applymodifyprofil"/>
            </p>
        </form>
        
        <div id="deleteprofilbuttonaffichage">
            <h2>Delete your account</h2>
            <button onclick="document.getElementById('deleteprofilconfirmationaffichage').style.display = 'block';
                    document.getElementById('deleteprofilbuttonaffichage').style.display = 'none'" 
                    id="deleteprofilbutton">
                DELETE
            </button>
        </div>
        
        <div style="display: none;" id="deleteprofilconfirmationaffichage">
            <h2>Are you really sure?</h2>
            <a href="/site/controller/sign/deleteUser.php"><button class="button" style="margin-left: 30px;">Yes</button></a>
            
            <a href="#" onclick="document.getElementById('deleteprofilconfirmationaffichage').style.display = 'none';
                document.getElementById('deleteprofilbuttonaffichage').style.display = 'block'" style="margin-left: 10px">
                <button class="button">No</button>
            </a>
        </div>
        
        <br/>
    </section>

    <?php
}
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
?>
