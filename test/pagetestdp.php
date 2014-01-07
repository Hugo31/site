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
        <h2>Ajouter un design pattern</h2>
        <form method="post" action="designPattern/ajouterDesignPattern.php">
        <p>
            <label for="nameDP">Nom :</label>
            <input type="text" name="nameDP" id="nameDP" placeholder="Ex : Multi-Step" size="30" maxlength="30" /><br/>
            <label for="whatDP">What :</label>
            <textarea name="whatDP" id="whatDP"></textarea><br/>
            <label for="targetDP">Pour :</label>
            <input type="radio" name="targetDP" value="Designer" id="designer" checked/> <label for="designer">Designer</label><br />
            <input type="radio" name="targetDP" value="Evaluator" id="evaluator" /> <label for="evaluator">Evaluator</label><br />
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
        <h2>Modifier un design pattern</h2>
        <form method="post" action="designPattern/modifierDesignPattern.php">
            <p>
            <?php
                echo '<select name="designPattern" id="designPattern">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idDesignPattern, name FROM DesignPattern');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idDesignPattern'].'">';
                    echo $donnees['name'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Modifier"/>
        </p>
        </form>
		
        <h2>Supprimer un design pattern</h2>
        <form method="post" action="designPattern/supprimerDesignPattern.php">
        <p>
            <?php
                echo '<select name="designPattern" id="designPattern">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idDesignPattern, name FROM DesignPattern');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idDesignPattern'].'">';
                    echo $donnees['name'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Supprimer"/>
        </p>
        </form>
        
        <h2>Ajouter un commentaire</h2>
        <form method="post" action="designPattern/ajouterCommentaireDP.php">
        <p>
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
            <?php
                echo '<select name="designPattern" id="designPattern">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idDesignPattern, name FROM DesignPattern');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idDesignPattern'].'">';
                    echo $donnees['name'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <label for="comment">Comment :</label>
            <textarea name="comment" id="comment"></textarea><br/>
            <input type="submit" value="Supprimer"/>
        </p>
        </form>
    </body>
</html>
