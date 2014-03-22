<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');  
?>

<script type="text/javascript" src="/site/controller/sign/ctrlSignup.js"></script>

<section id="contenu">
    <h1>Sign up</h1><br/>
    Votre espace personnel sur www.uidesignpatterncommunity.com vous permet de gérer vos projets, 
    d'ajouter des design pattern, de signaler des conflits ainsi que de proposer des solutions à ces conflits. 
    En vous connectant, vous aurez aussi la possibilité de donner votre avis en postant des commentaires sur les 
    autres design patterns. <br/><br/>
    <center><h3 style="margin:0 auto">N'attendez plus, inscrivez vous gratuitement sur notre site pour profiter de tous ces privilèges !</h3></center><br/><br/>
    <form method="post" id="formsignup" name="formsignup"
          action="/site/controller/sign/validsignup.php" onsubmit="return validSignup($(this));">
        <p>
            <label for="firstnamesignup" class="fname">Your firstname</label>
            <input type="text" id="firstnamesignup" name="firstnamesignup" 
                   required="required" size="30" maxlength="30" 
                   placeholder="Jean" />
        </p>
        <div id="errormsgsignup_firstname"></div>
        <p>
            <label for="lastnamesignup" class="lname">Your lastname</label>
            <input type="text" id="lastnamesignup" name="lastnamesignup" 
                   required="required" size="30" maxlength="30" 
                   placeholder="Michel" />
        </p>
        <div id="errormsgsignup_lastname"></div>
        <p>
            <label for="usernamesignup" class="uname">Your username</label>
            <input type="text" id="usernamesignup" name="usernamesignup" 
                   required="required" size="30" maxlength="30" 
                   placeholder="JeanMichelDu31" />
        </p>
        <div id="errormsgsignup_username"></div>
        <p>
            <label for="emailsignup" class="uemail">Your email</label>
            <input type="email" id="emailsignup" name="emailsignup" 
                   required="required" size="30" maxlength="30" 
                   placeholder="jeanmi31@univ-tlse.fr" />
        </p>
        <div id="errormsgsignup_email"></div>
        <p>
            <label for="passwordsignup" class="upasswd">Your password</label>
            <input type="password" id="passwordsignup" name="passwordsignup" 
                   required="required" size="30" maxlength="30"
                   placeholder="ex : michmich31" />
        </p>
        <p>
            <label for="passwordsignup_confirm" class="upasswd" data-icon="p">Please confirm your password</label>
            <input type="password" id="passwordsignup_confirm" name="passwordsignup_confirm" 
                   required="required" size="30" maxlength="30" 
                   placeholder="ex : michmich31" />
        </p>
        <div id="errormsgsignup_password"></div>
        <p>
            <input type="submit" value="SIGN UP" class="signupform" />
        </p>
    </form>
</section>

<?php
include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');
