<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/AbstractBasicCriteriaDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/property/ILinkProperty.php");
class Property extends AbstractBasicCriteriaDB implements IDatabase, ILinkProperty{
    /**
     * Construit une propriété
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom de la propriété.
     * @param string $_desc La description de la propriété
     */
    public function __construct($_idSort, $_name, $_desc){
        parent::__construct($_idSort, $_name, $_desc);
    }
    
    /**
     * Ajoute à la base de donnée une propriété passé en paramètre.
     * @param Property $object La propriété à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Property (name, description) VALUES(:name, :description)');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        if($reussie == true){
            $object->setID((int)$bdd->lastInsertId()); 
        }
        return $reussie;
        
    }

    /**
     * Donne une propriété selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant de la propriété.
     * @return Property La propriété issus de la base de donnée.
     */
    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM Property WHERE idProperty = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new Property($donnees['idProperty'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    /**
     * Modifie une propriété de la base de donnée.
     * @param Property $object La nouvelle propriété à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Property SET name = :name, description = :description WHERE idProperty = :id');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
        ));
        return $reussie;
    }

    /**
     * Supprime de la base de donnée une propriété.
     * @param Property $object La propriété à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM PropertyDesignPattern WHERE idProperty = \''.$object->getID().'\'');
        $nbSuppr = $bdd->exec('DELETE FROM Property WHERE idProperty = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }
    
    /**
     * Ajoute un lien entre une propriété et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param Property $sort La propriété à lier.
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public static function addLink($tableToSort, $sort, $note){
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO PropertyDesignPattern (idDesignPattern, idProperty, note) VALUES (:idDP, :idSort, :note)');
        $reussie = $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID(), 
            'note' => $note
        ));
        return $reussie;
    }

    /**
     * Supprime un lien entre une propriété et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @param Property $sort La propriété à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public static function removeLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM PropertyDesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND idProperty = '.$sort->getID().'');
        return ($nbSuppr > 0);
    }
}
