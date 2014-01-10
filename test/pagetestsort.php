<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once("./functionForTest.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/ESortTable.php");
$bdd = Database::getConnection();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>       
        <a href="../index.php">Retour vers l'index</a>
        <h2>Ajouter un tri</h2>
        <form method="post" action="sort/ajouterTriTable.php">
        <p>
            <?php
                echo '<select name="listePossiblite" id="listePossibilite">';
                $i = 0;
                while (ESortTable::isValidValue($i)){
                    echo '<option value="'.$i.'">';
                    echo ESortTable::getNameEnum($i);
                    echo '</option>';
                    $i++;
                }
                echo '</select><br/>';
                
            ?>
            <label for="nameST">Nom :</label>
            <input type="text" name="nameST" id="nameST" placeholder="Ex : Nom" size="30" maxlength="30" /><br/>
            <label for="descriptionST">Description :</label>
            <textarea name="descriptionST" id="descriptionST"></textarea><br/>
            <input type="submit" value="Ajouter"/>
        </p>
        </form>
        
        <h2>Modifier un tri</h2>
        <form method="post" action="sort/modifierTriTable.php">
        <p>
            <select name="triTable" id="triTable">
            <?php
            getAllSortTable();
            ?>
            </select><br/>
            <input type="submit" value="Modifier"/>
        </p>
        </form>
        
        <h2>Supprimer un tri</h2>
        <form method="post" action="sort/supprimerTriTable.php">
        <p>
            <select name="triTable" id="triTable">
            <?php
            getAllSortTable();
            ?>
            </select><br/>
            <input type="submit" value="Supprimer"/>
        </p>
        </form>
        
        <h2>Ajouter lien</h2>
        <form method="post" action="sort/ajouterLienTri.php">
        <p>
            <select name="triTable" id="triTable">
            <?php
            getAllSortTable();
            ?>
            </select><br/>
            <?php
                echo '<select name="designPattern" id="designPattern">';
                
                $reponse = $bdd->query('SELECT idDesignPattern, name FROM DesignPattern');
                while ($donnees = $reponse->fetch()){
                    echo '<option value="'.$donnees['idDesignPattern'].'">';
                    echo $donnees['name'];
                    echo '</option>';
                }
                echo '</select><br/>';
                $reponse->closeCursor();
            ?>
            <input type="submit" value="Ajouter"/>
        </p>
        </form>
        
        <h2>Supprimer lien</h2>
        <form method="post" action="sort/supprimerLienTri.php">
        <p>
            <select name="triTable" id="triTable">
            <?php
            getAllSortTableAssociation();
            ?>
            </select><br/>
            
            <input type="submit" value="Supprimer"/>
        </p>
        </form>
    </body>
</html>