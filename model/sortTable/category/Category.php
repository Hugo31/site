<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/ILink.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
class Category extends SortTable implements IDataBase, ILink{
    
    /**
     * Construit une categorie
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom de la catégorie.
     * @param string $_description La description de la catégorie (Optionnel)
     */
    public function __construct($_idSort, $_name, $_description = ""){
        parent::__construct($_idSort, $_name, $_description);
    }
    
    /**
     * Ajoute à la base de donnée une catégorie passé en paramètre.
     * @param Category $object La catégorie à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Category (name, description) VALUES(:name, :description)');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription()
            ));
        if($reussie == true){
            $object->setID((int)$bdd->lastInsertId()); 
        }
        
        return $reussie;
        
    }

    /**
     * Donne une catégorie selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant de la catégorie.
     * @return Category La categorie issus de la base de donnée.
     */
    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM Category WHERE idCategory = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new Category($donnees['idCategory'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    /**
     * Modifie une catégorie de la base de donnée.
     * @param Category $object La nouvelle catégorie à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Category SET name = :name, description = :description WHERE idCategory = :id');
        $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
            ));
    }

    /**
     * Supprime de la base de donnée une catégorie.
     * @param Category $object La categorie à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
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
