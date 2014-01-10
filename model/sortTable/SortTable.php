<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/ILink.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/ESortTable.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");

class SortTable implements IDataBase, ILink{
    private $idSortTable;
    private $name;
    private $description;
    
    public function __construct($_idSort, $_name, $_description = ""){
        $this->idSortTable = $_idSort;
        $this->name = $_name;
        $this->description = $_description;
    }
    
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO '.ESortTable::getNameEnum($object->sortType).' (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
    }

    public static function getDB($id, $typeTable = NULL) { 
        $bdd = Database::getConnection();
        $table = ESortTable::getNameEnum($typeTable);
        
        $reponse = $bdd->query('SELECT * FROM '.$table.' WHERE id'.$table.' = '.$id.'');
        $donnees = $reponse->fetch();
        
        $st = new SortTable($typeTable, $donnees['id'.$table], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $table = ESortTable::getNameEnum($object->sortType);
        $req = $bdd->prepare('UPDATE '.$table.' SET name = :name, description = :description WHERE id'.$table.' = :id');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
        
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $table = ESortTable::getNameEnum($object->sortType);
        //Spprimer les occurences de : 
        $bdd->exec('DELETE FROM '.$table.'DesignPattern WHERE id'.$table.' = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM '.$table.' WHERE id'.$table.' = \''.$object->getID().'\'');
    }

    public static function addLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $table = ESortTable::getNameEnum($sort->sortType);
        $req = $bdd->prepare('INSERT INTO '.$table.'DesignPattern (idDesignPattern, id'.$table.') VALUES (:idDP, :idSort)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID()
            ));
        
    }

    public static function removeLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $table = ESortTable::getNameEnum($sort->sortType);
        $cond = 'idDesignPattern = '.$tableToSort->getID().' AND id'.$table.' = '.$sort->getID().'';
        
        $bdd->exec('DELETE FROM '.$table.'DesignPattern WHERE '.$cond.'');
    }
    
    public static function addLinkProperty($tableToSort, $sort, $note){
        $bdd = Database::getConnection();
        $table = ESortTable::getNameEnum($sort->sortType);
        $req = $bdd->prepare('INSERT INTO '.$table.'DesignPattern (idDesignPattern, id'.$table.', note) VALUES (:idDP, :idSort, :note)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID(), 
            'note' => $note
            ));
    }

    public function getID(){
        return $this->idSortTable;
    }

    public function setID($_id) {
        $this->idSortTable = $_id;
    }
    
    public function getName(){
        return $this->name;
    }

    public function setName($_name) {
        $this->name = $_name;
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($_description) {
        $this->description = $_description;
    }
}
