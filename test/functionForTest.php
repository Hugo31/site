<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
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



function getAllSortTableAssociation(){
    $bdd = Database::connect();
    $reponse = $bdd->query('SELECT idSystem, idDesignPattern FROM SystemDesignPattern');
    while ($donnees = $reponse->fetch()){
        echo '<option value="System-'.$donnees['idSystem'].'-'.$donnees['idDesignPattern'].'">';
        echo "System-".$donnees['idSystem'];
        echo '</option>';
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT idPlatform, idDesignPattern FROM PlatformDesignPattern');
    while ($donnees = $reponse->fetch()){
        echo '<option value="Platform-'.$donnees['idPlatform'].'-'.$donnees['idDesignPattern'].'">';
        echo "Platform-".$donnees['idPlatform'];
        echo '</option>';
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT idCategory, idDesignPattern FROM CategoryDesignPattern');
    while ($donnees = $reponse->fetch()){
        echo '<option value="Category-'.$donnees['idCategory'].'-'.$donnees['idDesignPattern'].'">';
        echo "Category-".$donnees['idCategory'];
        echo '</option>';
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT idProperty, idDesignPattern FROM PropertyDesignPattern');
    while ($donnees = $reponse->fetch()){
        echo '<option value="Property-'.$donnees['idProperty'].'-'.$donnees['idDesignPattern'].'">';
        echo "Property-".$donnees['idProperty'];
        echo '</option>';
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT idComponent, idDesignPattern FROM ComponentDesignPattern');
    while ($donnees = $reponse->fetch()){
        echo '<option value="Component-'.$donnees['idComponent'].'-'.$donnees['idDesignPattern'].'">';
        echo "Component-".$donnees['idComponent'];
        echo '</option>';
    }
    $reponse->closeCursor();
}
?>
