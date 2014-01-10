<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/ILink.php");
class Category extends SortTable implements IDataBase, ILink{
    
    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Category (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
    }

    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM Category WHERE idCategory = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new Category($donnees['idCategory'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Category SET name = :name, description = :description WHERE idCategory = :id');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM CategoryDesignPattern WHERE idCategory = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM Category WHERE idCategory = \''.$object->getID().'\'');
    }
    
    public static function addLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO CategoryDesignPattern (idDesignPattern, idCategory) VALUES (:idDP, :idSort)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID()
            ));
    }

    public static function removeLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM CategoryDesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND idCategory = '.$sort->getID().'');
    }
}

?>
