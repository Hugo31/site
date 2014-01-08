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
        
        <h2>Ajouter une image</h2>
        <form method="post" action="imageSource/ajouterImage.php">
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
            <label for="link">Link : </label>
            <input type="text" name="link" id="link"/><br/>
            <input type="submit" value="Ajouter"/>
        </p>
        </form>
        
        <h2>Supprimer une image</h2>
        <form method="post" action="imageSource/supprimerImage.php">
        <p>
            <?php
                echo '<select name="image" id="image">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idImage, link FROM ImageDesignPattern');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idImage'].'">';
                    echo $donnees['link'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Supprimer"/>
        </p>
        </form>
        
        <h2>Ajouter une source</h2>
        <form method="post" action="imageSource/ajouterSource.php">
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
            <label for="author">Author : </label>
            <input type="text" name="author" id="author"/><br/>
            <label for="link">Link : </label>
            <input type="text" name="link" id="link"/><br/>
            <input type="submit" value="Ajouter"/>
        </p>
        </form>
        
        <h2>Supprimer une image</h2>
        <form method="post" action="imageSource/supprimerSource.php">
        <p>
            <?php
                echo '<select name="source" id="source">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idSource, author FROM Source');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idSource'].'">';
                    echo $donnees['author'];
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
