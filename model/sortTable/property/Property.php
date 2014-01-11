<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/property/ILinkProperty.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
class Property extends SortTable implements IDataBase, ILinkProperty{
    
    /**
     * Construit une propriété
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom de la propriété.
     * @param string $_description La description de la propriété (Optionnel)
     */
    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    /**
     * Ajoute à la base de donnée une propriété passé en paramètre.
     * @param Property $object La propriété à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Property (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
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
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
    }

    /**
     * Supprime de la base de donnée une propriété.
     * @param Property $object La propriété à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM PropertyDesignPattern WHERE idProperty = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM Property WHERE idProperty = \''.$object->getID().'\'');
    }
    
    public static function addLink($tableToSort, $sort, $note){
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO PropertyDesignPattern (idDesignPattern, idProperty, note) VALUES (:idDP, :idSort, :note)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID(), 
            'note' => $note
            ));
    }

    public static function removeLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM PropertyDesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND idProperty = '.$sort->getID().'');
    }

    public static function addLinkRelated($tableToSort, $sort) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO PropertyRelatedDesignPattern (idDesignPattern, idProperty) VALUES (:idDP, :idSort)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID()
            ));
    }

    public static function removeLinkRelated($tableToSort, $sort) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM PropertyRelatedDesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND idProperty = '.$sort->getID().'');
    
    }
}
