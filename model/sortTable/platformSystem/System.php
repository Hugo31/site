<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/ILink.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
class System extends SortTable implements IDataBase, ILink{
    
    /**
     * Construit un système
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom du système.
     * @param string $_description La description du système (Optionnel)
     */
    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    /**
     * Ajoute à la base de donnée un système passé en paramètre.
     * @param System $object Le système à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO System (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
    }

    /**
     * Donne un système selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant du système.
     * @return System Le système issus de la base de donnée.
     */
    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM System WHERE idSystem = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new System($donnees['idSystem'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    /**
     * Modifie un système de la base de donnée.
     * @param System $object Le nouveau système à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE System SET name = :name, description = :description WHERE idSystem = :id');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
    }

    /**
     * Supprime de la base de donnée un système.
     * @param System $object Le système à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
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
