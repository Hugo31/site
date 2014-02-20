<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/AbstractBasicCriteriaDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/component/ILinkComponent.php");

class Component extends AbstractBasicCriteriaDB implements IDatabase, ILinkComponent{
    
    /**
     * Construit un composant
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom du composant.
     * @param string $_desc La description du composant
     */
    public function __construct($_id, $_name, $_desc) {
        parent::__construct($_id, $_name, $_desc);
    }
    
    /**
     * Ajoute à la base de donnée un composant passé en paramètre.
     * @param Component $object Le composant à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Component (name, description) VALUES(:name, :description)');
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
     * Donne un composant selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant du composant.
     * @return Component Le composant issus de la base de donnée.
     */
    public static function getDB($id) { 
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM Component WHERE idComponent = '.$id.'');
        $donnees = $reponse->fetch();
        $st = new Component($donnees['idComponent'], $donnees['name'], $donnees['description']);
        $reponse->closeCursor();
        return $st;
    }

    /**
     * Modifie un composant de la base de donnée.
     * @param Component $object Le nouveau composant à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Component SET name = :name, description = :description WHERE idComponent = :id');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'id' => $object->getID()
        ));
        return $reussie;
    }

    /**
     * Supprime de la base de donnée un composant.
     * @param Composant $object Le composant à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM ComponentDesignPattern WHERE idComponent = \''.$object->getID().'\'');
        $nbSuppr = $bdd->exec('DELETE FROM Component WHERE idComponent = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }
    
    /**
     * Ajoute un lien entre un component et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param Component $sort Le component à lier.
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public static function addLink($tableToSort, $sort){
        return parent::addLink($tableToSort, $sort, "Component");
    }

    /**
     * Supprime un lien entre un component et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @param Component $sort La component à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public static function removeLink($tableToSort, $sort){
        return parent::removeLink($tableToSort, $sort, "Component");
    }
    
    /**
     * Ajoute un lien relatif entre un component et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param Component $sort Le component à lier de façon relative.
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public static function addLinkRelated($tableToSort, $sort) {
        return parent::addLink($tableToSort, $sort, "ComponentRelated");
    }

    /**
     * Supprime un lien relatif entre un component et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @param Component $sort Le component à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public static function removeLinkRelated($tableToSort, $sort) {
        return parent::removeLink($tableToSort, $sort, "ComponentRelated");
    }
}
