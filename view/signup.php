<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?>

<script type="text/javascript" src="/site/controller/sign/ctrlSignup.js"></script>

<section id="contenu">
    <?php
    $fstn = "";
    $lstn = "";
    $usrn = "";
    $mail = "";
    
    if (isset($_GET['fstn'])) {
        $fstn = $_GET['fstn'];
    }
    if (isset($_GET['lstn'])) {
        $lstn = $_GET['lstn'];
    }
    if (isset($_GET['usrn'])) {
        $usrn = $_GET['usrn'];
    }
    if (isset($_GET['mail'])) {
        $mail = $_GET['mail'];
    }
    ?>
    <h1>Sign up</h1><br/>
    Your personal space on www.uidesignpatterncommunity.com allows you to manage your projects, 
    add design patterns, report conflicts and propose solutions to these conflicts. 
    By logging in, you'll also have the possibility to share your opinion on design patterns by posting comments. <br/><br/>
    <center><h3 style="margin:0 auto">Don't wait, register for free on our site to enjoy all these benefits now!</h3></center><br/><br/>
    <form method="post" id="formsignup" name="formsignup"
          action="/site/controller/sign/validSignup.php" onsubmit="return validSignup($(this));">
        <p>
            <label for="firstnamesignup" class="fname">Your firstname</label>
            <input type="text" id="firstnamesignup" name="firstnamesignup" 
                   required="required" size="30" maxlength="30" 
                   placeholder="Emma" <?php if($fstn != "") {echo "value=\"".$fstn."\"";} ?> />
        </p>
        <div id="errormsgsignup_firstname"></div>
        <p>
            <label for="lastnamesignup" class="lname">Your lastname</label>
            <input type="text" id="lastnamesignup" name="lastnamesignup" 
                   required="required" size="30" maxlength="30" 
                   placeholder="Martin" <?php if($lstn != "") {echo "value=\"".$lstn."\"";} ?> />
        </p>
        <div id="errormsgsignup_lastname"></div>
        <p>
            <label for="usernamesignup" class="uname">Your username</label>
            <input type="text" id="usernamesignup" name="usernamesignup" 
                   required="required" size="30" maxlength="30" 
                   placeholder="EmMart" <?php if($usrn != "") {echo "value=\"".$usrn."\"";} ?> />
        </p>
        <div id="errormsgsignup_username"></div>
        <p>
            <label for="emailsignup" class="uemail">Your email</label>
            <input type="email" id="emailsignup" name="emailsignup" 
                   required="required" size="30" maxlength="30" 
                   placeholder="e.martin@gmail.com" <?php if($mail != "") {echo "value=\"".$mail."\"";} ?> />
        </p>
        <div id="errormsgsignup_email"></div>
        <p>
            <label for="passwordsignup" class="upasswd">Your password</label>
            <input type="password" id="passwordsignup" name="passwordsignup" 
                   required="required" size="30" maxlength="30"
                   placeholder="ex : melodyMaker14" />
        </p>
        <p>
            <label for="passwordsignup_confirm" class="upasswd" data-icon="p">Please confirm your password</label>
            <input type="password" id="passwordsignup_confirm" name="passwordsignup_confirm" 
                   required="required" size="30" maxlength="30" 
                   placeholder="ex : melodyMaker14" />
        </p>
        <div id="errormsgsignup_password"></div>
        <p>
            <img src="captcha.php" alt="Captcha" id="signinimagecaptcha" />
            <a style="cursor:pointer" onclick="document.images.signinimagecaptcha.src = 'captcha.php?id=' + Math.round(Math.random(0) * 1000) + 1"><br><i>Regenerate code</i></a><br/><br/>
            <label for="captchasignup" class="ucaptcha">Enter code</label>
            <input type="text" id="captchasignup" name="captchasignup" 
                   size="5" pattern="[a-zA-Z0-9]{5}"
                   required="required"><br/>
        </p>
        <p>
            <input type="submit" value="SIGN UP" class="signupform" />
        </p>
    </form>
</section>

<?php

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
