<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?>

<script type="text/javascript" src="/site/controller/sign/ctrlForget.js"></script>

<section id="contenu">
    <h1>Forgotten password ?</h1><br/>
    Vous avez oublié votre mot de passe pour vous identifier sur www.uidesignpatterncommunity.com et vous ne pouvez donc plus accéder à votre espace personnel. Voici la marche à suivre pour le récupérer:
    <ol>
        <li>Entrez votre adresse mail dans l'espace prévu à cet effet.</li>
        <li>Si celle-ci est correcte, vous recevrez un mail contenant votre nouveau mot de passe généré aléatoirement.</li>
        <li>Lors de votre nouvelle connexion, n'oubliez pas de changer ce mot de passe.</li>
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
    