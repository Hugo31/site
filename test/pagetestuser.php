<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <a href="../index.php">Retour vers l'index</a>
        <h2>Ajouter un utilisateur</h2>
        <form method="post" action="user/ajouterUser.php">
            <label for="loginUser">Login :</label>
            <input type="text" name="loginUser" id="loginUser" placeholder="Votre login..." size="30" maxlength="30" required/><br/>
            <label for="pwdUser">Password :</label>
            <input type="password" name="pwdUser" id="pwdUser" placeholder="Votre pwd..." size="30" maxlength="30" required/><br/>
            <label for="lastnameUser">Last name :</label>
            <input type="text" name="lastnameUser" id="lastnameUser" placeholder="Votre nom..." size="30" maxlength="30" required/><br/>
            <label for="firstnameUser">First name :</label>
            <input type="text" name="firstnameUser" id="firstnameUser" placeholder="Votre prénom..." size="30" maxlength="30" required/><br/>
            <input type="submit" value="Ajouter"/>
    	</form>
        
        <h2>Modifier un utilisateur</h2>
        <form method="post" action="user/modifierUser.php">
            <input type="submit" value="Modifier"/>
    	</form>
        
        <h2>Supprimer un utilisateur</h2>
        <form method="post" action="user/supprimerUser.php">
            <input type="submit" value="Supprimer"/>
    	</form>
        
    </body>
</html>
