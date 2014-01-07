<?php
require_once($_SERVER['DOCUMENT_ROOT']."/model/Database.php");
function getAllSortTable(){
    $bdd = Database::connect();
    $reponse = $bdd->query('SELECT idSystem, name FROM System');
    while ($donnees = $reponse->fetch()){
        echo '<option value="System-'.$donnees['idSystem'].'">';
        echo "System - ".$donnees['name'];
        echo '</option>';
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT idPlatform, name FROM Platform');
    while ($donnees = $reponse->fetch()){
        echo '<option value="Platform-'.$donnees['idPlatform'].'">';
        echo "Platform - ".$donnees['name'];
        echo '</option>';
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT idCategory, name FROM Category');
    while ($donnees = $reponse->fetch()){
        echo '<option value="Category-'.$donnees['idCategory'].'">';
        echo "Category - ".$donnees['name'];
        echo '</option>';
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT idProperty, name FROM Property');
    while ($donnees = $reponse->fetch()){
        echo '<option value="Property-'.$donnees['idProperty'].'">';
        echo "Property - ".$donnees['name'];
        echo '</option>';
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT idComponent, name FROM Component');
    while ($donnees = $reponse->fetch()){
        echo '<option value="Component-'.$donnees['idComponent'].'">';
        echo "Component - ".$donnees['name'];
        echo '</option>';
    }
    $reponse->closeCursor();
}

?>
