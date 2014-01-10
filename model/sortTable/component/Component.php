<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/component/ILinkComponent.php");
class Component extends SortTable implements IDataBase, ILinkComponent{

    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Component (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
    }

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