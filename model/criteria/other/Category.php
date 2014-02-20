<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/AbstractBasicCriteriaDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/ILinkCriteria.php");
class Category extends AbstractBasicCriteriaDB implements IDatabase, ILinkCriteria{
    
    /**
     * Construit une categorie
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom de la catégorie.
     * @param string $_desc La description de la catégorie
     */
    public function __construct($_id, $_name, $_desc) {
        parent::__construct($_id, $_name, $_desc);
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
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
        ));
        return $reussie;
    }

    /**
     * Supprime de la base de donnée une catégorie.
     * @param Category $object La categorie à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM CategoryDesignPattern WHERE idCategory = \''.$object->getID().'\'');
        $nbSuppr = $bdd->exec('DELETE FROM Category WHERE idCategory = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }
    
    /**
     * Ajoute un lien entre une catégorie et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param Category $sort La catégorie à lier.
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public static function addLink($tableToSort, $sort){
        return parent::addLink($tableToSort, $sort, "Category");
    }

    /**
     * Supprime un lien entre une catégorie et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @param Category $sort La catégorie à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public static function removeLink($tableToSort, $sort){
        return parent::removeLink($tableToSort, $sort, "Category");
    }

}
