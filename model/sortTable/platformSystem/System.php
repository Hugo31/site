<?php

class System extends SortTable implements IDataBase, ILink{
    
    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO System (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
    }

    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM System WHERE idSystem = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new System($donnees['idSystem'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE System SET name = :name, description = :description WHERE idSystem = :id');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM SystemDesignPattern WHERE idSystem = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM System WHERE idSystem = \''.$object->getID().'\'');
    }
    
    public static function addLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO SystemDesignPattern (idDesignPattern, idSystem) VALUES (:idDP, :idSort)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID()
            ));
    }

    public static function removeLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM SystemDesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND idSystem = '.$sort->getID().'');
    }
}

?>
