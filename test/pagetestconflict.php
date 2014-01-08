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
        
        <h2>Ajouter un conflict</h2>
        <form method="post" action="conflictsolution/ajouterConflict.php">
        <p>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name"/><br/>
            <label for="desc">Description :</label>
            <textarea name="desc" id="desc"></textarea><br/>
            <?php
                echo '<select name="user" id="user">';
                $bdd = Database::connect();
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
        <h2>Modifier un conflict</h2>
        <form method="post" action="conflictsolution/modifierConflict.php">
            <p>
            <?php
                echo '<select name="conflict" id="conflict">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idConflict, name FROM Conflict');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idConflict'].'">';
                    echo $donnees['name'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Modifier"/>
        </p>
        </form>
		
        <h2>Supprimer un conflict</h2>
        <form method="post" action="conflictsolution/supprimerConflict.php">
        <p>
            <?php
                echo '<select name="conflict" id="conflict">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idConflict, name FROM Conflict');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idConflict'].'">';
                    echo $donnees['name'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Supprimer"/>
        </p>
        </form>
    </body>
</html>
