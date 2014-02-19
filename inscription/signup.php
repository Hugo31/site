<?php
    include('header.php');
    include('search.php');
?>

<!-- ligne a inclure dans le <head></head> -->
<link rel="stylesheet" type="text/css" href="styles/styleForm.css" />
<script type="text/javascript" src="signupcontrol.js"></script>
<!-- ************************************* -->

<section id="contenu">
    <h1>Sign up</h1>
    <div id="formulaire">
        <form method="post" id="formsignup" name="formsignup"
              action="./validsignup.php" onsubmit="return valider($(this));">
            <p>
                <label for="usernamesignup" class="uname">Your username</label><br/>
                <input type="text" id="usernamesignup" name="usernamesignup" 
                       required="required" size="30" maxlength="30" 
                       placeholder="JeanMichelDu31" />
            </p>
            <p>
                <label for="emailsignup" class="uemail">Your email</label><br/>
                <input type="email" id="emailsignup" name="emailsignup" 
                       required="required" size="30" maxlength="30" 
                       placeholder="jeanmi31@univ-tlse.fr" />
            </p>
            <p>
                <label for="passwordsignup" class="upasswd">Your password</label><br/>
                <input type="password" id="passwordsignup" name="passwordsignup" 
                       required="required" size="30" maxlength="30"
                       placeholder="ex : michmich31" />
            </p>
            <p>
                <label for="passwordsignup_confirm" class="upasswd" data-icon="p">Please confirm your password</label><br/>
                <input type="password" id="passwordsignup_confirm" name="passwordsignup_confirm" 
                       required="required" size="30" maxlength="30" 
                       placeholder="ex : michmich31" />
            </p>
            <p>
                <input type="submit" value="SIGN UP" class="signupform" />
            </p>
        </form>
    </div>
</section>

<?php
    include('footer.php');
?>