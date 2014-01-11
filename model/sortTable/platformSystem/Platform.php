<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/ILink.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
class Platform extends SortTable implements IDataBase, ILink{
    
    /**
     * Construit une plateforme
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom de la plateforme.
     * @param string $_description La description de la plateforme (Optionnel)
     */
    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    /**
     * Ajoute à la base de donnée une plateforme passé en paramètre.
     * @param Platform $object La plateforme à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Platform (name, description) VALUES(:name, :description)');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
        
    }

    /**
     * Donne une plateforme selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant de la plateform.
     * @return Platform La plateform issus de la base de donnée.
     */
    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM Platform WHERE idPlatform = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new Platform($donnees['idPlatform'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    /**
     * Modifie une plateforme de la base de donnée.
     * @param Platform $object La nouvelle plateforme à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Platform SET name = :name, description = :description WHERE idPlatform = :id');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
    }

    /**
     * Supprime de la base de donnée une plateforme.
     * @param Platform $object La plateforme à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
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
