<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicCriteriaDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/criteria/ILinkComponent.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");

class Component extends AbstractBasicCriteriaDB implements IDatabase, ILinkComponent{
    private $login;
    /**
     * Construit un composant
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom du composant.
     * @param string $_desc La description du composant
     */
    public function __construct($_id, $_name, $_desc, $_login) {
        parent::__construct($_id, $_name, $_desc);
        $this->setLogin($_login);
    }
    
    /**
     * Ajoute à la base de donnée un composant passé en paramètre.
     * @param Component $object Le composant à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Component (name, description, login) VALUES(:name, :description, :login)');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'login' => $object->getLogin()
            ));
        if ($reussie == true) {
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
        $donnees = Database::getOneData('SELECT * FROM Component WHERE idComponent = '.$id.'');
        
        if ($donnees != false) {
            return new Component($donnees['idComponent'], $donnees['name'], $donnees['description'], $donnees['login']);
        }
        return false;
    }

    /**
     * Modifie un composant de la base de donnée.
     * @param Component $object Le nouveau composant à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Component SET name = :name, description = :description, login = :login WHERE idComponent = :id');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'login' => $object->getLogin(),
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
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public function addLink($tableToLink) {
        return parent::addLinkSort($tableToLink, "Component");
    }

    /**
     * Supprime un lien entre un component et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public function removeLink($tableToLink) {
        return parent::removeLinkSort($tableToLink, "Component");
    }
    
    /**
     * Ajoute un lien relatif entre un component et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public function addLinkRelated($tableToLink) {
        return parent::addLinkSort($tableToLink, "ComponentRelated");
    }

    /**
     * Supprime un lien relatif entre un component et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public function removeLinkRelated($tableToLink) {
        return parent::removeLinkSort($tableToLink, "ComponentRelated");
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function setLogin($_login) {
        $this->login = $_login;
    }
}
