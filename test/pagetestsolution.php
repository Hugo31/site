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
        <h2>Ajouter une solution</h2>
        <form method="post" action="conflictsolution/ajouterSolution.php">
        <p>
            <label for="comment">Comment :</label>
            <textarea type="text" name="comment" id="comment"></textarea><br/>
            <label for="code">Code :</label>
            <textarea type="text" name="code" id="code"></textarea><br/>
            <?php
                echo '<select name="user" id="user">';
                $reponse = $bdd->query('SELECT login, firstname, lastname FROM User');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['login'].'">';
                    echo $donnees['firstname'].' - '.$donnees['lastname'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Envoyer"/>
        </p>
        </form>
    </body>
</html>
