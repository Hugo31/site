<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/component/ILinkComponent.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
class Component extends SortTable implements IDataBase, ILinkComponent{

    /**
     * Construit un composant
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom du composant.
     * @param string $_description La description du composant (Optionnel)
     */
    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    /**
     * Ajoute à la base de donnée un composant passé en paramètre.
     * @param Component $object Le composant à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Component (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
    }

    /**
     * Donne un composant selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant du composant.
     * @return Component Le composant issus de la base de donnée.
     */
    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM Component WHERE idComponent = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new Component($donnees['idComponent'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Component SET name = :name, description = :description WHERE idComponent = :id');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM ComponentDesignPattern WHERE idComponent = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM Component WHERE idComponent = \''.$object->getID().'\'');
    }
    
    public static function addLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO ComponentDesignPattern (idDesignPattern, idComponent) VALUES (:idDP, :idSort)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID()
            ));
    }

    public static function removeLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM ComponentDesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND idComponent = '.$sort->getID().'');
    }
    
    public static function addLinkRelated($tableToSort, $sort) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO ComponentRelatedDesignPattern (idDesignPattern, idComponent) VALUES (:idDP, :idSort)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID()
            ));
    }

    public static function removeLinkRelated($tableToSort, $sort) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM ComponentRelatedDesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND idComponent = '.$sort->getID().'');
    
    }

}
?>