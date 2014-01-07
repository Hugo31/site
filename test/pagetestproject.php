<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userProject/Project.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <a href="../index.php">Retour vers l'index</a>
        <h2>Ajouter un projet</h2>
        <form method="post" action="project/ajouterProject.php">
            <label for="nameProject">Nom :</label>
            <input type="text" name="nameProject" id="nameST" placeholder="Ex : Name" size="30" maxlength="30" /><br/>
            <label for="descriptionProject">Description :</label>
            <textarea name="descriptionProject" id="descriptionST"></textarea><br/>
            <input type="submit" value="Ajouter"/>
        </form>
        <br/>
        
        <h2>Modifier un projet</h2>
        <form method="post" action="project/modifierProject.php">
            <?php
                echo '<select name="project" id="project">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idProject,name FROM Project');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idProject'].'">';
                    echo $donnees['name'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Modifier"/>
        </form>
        
        <h2>Supprimer un projet</h2>
        <form method="post" action="project/supprimerProject.php">
            <?php
                echo '<select name="project" id="project">';
                $bdd = Database::connect();
                $reponse = $bdd->query('SELECT idProject,name FROM Project');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idProject'].'">';
                    echo $donnees['name'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Supprimer"/>
        </form>
    </body>
</html>
