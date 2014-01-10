<?php

class Platform extends SortTable implements IDataBase, ILink{
    
    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Platform (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
    }

    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM Platform WHERE idPlatform = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new Platform($donnees['idPlatform'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Platform SET name = :name, description = :description WHERE idPlatform = :id');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM PlatformDesignPattern WHERE idPlatform = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM Platform WHERE idPlatform = \''.$object->getID().'\'');
    }
    
    public static function addLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO PlatformDesignPattern (idDesignPattern, idPlatform) VALUES (:idDP, :idSort)');
        $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID()
            ));
    }

    public static function removeLink($tableToSort, $sort){
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM PlatformDesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND idPlatform = '.$sort->getID().'');
    }
}

?>
