<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?>

<script type="text/javascript" src="/site/controller/sign/ctrlForget.js"></script>

<section id="contenu">
    <?php
    
    ?>
    <h1>Forgotten password ?</h1><br/>
    You forgot your password on www.uidesignpatterncommunity.com and cannot access your personal space anymore. Here is how to retrieve it:
    <ol>
        <li>Enter your email address in the field below.</li>
        <li>If there is an account associated with this email address, you will receive an email containing your new randomly generated password.</li>
        <li>On your next connection, don't forget to change your password.</li>
    </ol>
    <form method="post" id="forgetform" name="forgetform"
          action="#" onsubmit="return validforget($(this));">
        <table>
            <tr>
                <td><label for="emailforget" id="eforget">Your email</label></td>
                <td><input type="email" id="emailforget" name="emailforget" 
                   required="required" size="30" maxlength="30" 
                   placeholder="JeanMi@univ-tlse.fr" 
                   onkeypress="desactivateEnterKey(event);"/></td>
                <td><input type="submit" value="SEND" class="sendforget" id="sendforget"/></td>
            </tr>
            <tr>
                <td></td>
                <td><div id="errormsgforget"></div></td>
                <td></td>
            </tr>
            
        </table>
    </form>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');
    
