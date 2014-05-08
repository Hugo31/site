<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicCriteriaDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IDatabase.php");
class TypeConflict extends AbstractBasicCriteriaDB implements IDatabase {
    
    public function __construct($_id, $_name, $_desc) {
        parent::__construct($_id, $_name, $_desc);
    }

    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO TypeConflict (name, description) VALUES(:name, :description)');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        if ($reussie == true) {
            $object->setID((int)$bdd->lastInsertId()); 
        }
        
        return $reussie;
        
    }

    public static function getDB($id) { 
        $donnees = Database::getOneData('SELECT * FROM TypeConflict WHERE idTypeConflict = '.$id.'');
        if ($donnees != false) {
            return new Category($donnees['idTypeConflict'], $donnees['name'], $donnees['description']);
        }
        return false;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE TypeConflict SET name = :name, description = :description WHERE idTypeConflict = :id');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
        ));
        return $reussie;
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM TypeConflict WHERE idTypeConflict = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }

}
