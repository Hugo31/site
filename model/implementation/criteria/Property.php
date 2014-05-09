<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicCriteriaDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/criteria/ILinkProperty.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
class Property extends AbstractBasicCriteriaDB implements IDatabase, ILinkProperty{
    private $login;
    /**
     * Construit une propriété
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom de la propriété.
     * @param string $_desc La description de la propriété
     */
    public function __construct($_idSort, $_name, $_desc, $_login) {
        parent::__construct($_idSort, $_name, $_desc);
        $this->setLogin($_login);
    }
    
    /**
     * Ajoute à la base de donnée une propriété passé en paramètre.
     * @param Property $object La propriété à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Property (name, description, login) VALUES(:name, :description, :login)');
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
     * Donne une propriété selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant de la propriété.
     * @return Property La propriété issus de la base de donnée.
     */
    public static function getDB($id) { 
        $donnees = Database::getOneData('SELECT * FROM Property WHERE idProperty = '.$id.'');
        if ($donnees != false) {
            return new Property($donnees['idProperty'], $donnees['name'], $donnees['description'], $donnees['login']);
        }
        return false;
    }

    /**
     * Modifie une propriété de la base de donnée.
     * @param Property $object La nouvelle propriété à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Property SET name = :name, description = :description, login = :login WHERE idProperty = :id');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'login' => $object->getLogin(), 
            'id' => $object->getID()
        ));
        return $reussie;
    }

    /**
     * Supprime de la base de donnée une propriété.
     * @param Property $object La propriété à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM PropertyDesignPattern WHERE idProperty = \''.$object->getID().'\'');
        $nbSuppr = $bdd->exec('DELETE FROM Property WHERE idProperty = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }
    
    /**
     * Ajoute un lien entre une propriété et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public function addLink($tableToLink, $note) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO PropertyDesignPattern (idDesignPattern, idProperty, note) VALUES (:idDP, :idSort, :note)');
        $reussie = $req->execute(array(
            'idDP' => $tableToLink->getID(),
            'idSort' => $this->getID(), 
            'note' => $note
        ));
        return $reussie;
    }

    /**
     * Supprime un lien entre une propriété et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public function removeLink($tableToLink) {
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM PropertyDesignPattern WHERE idDesignPattern = '.$tableToLink->getID().' AND idProperty = '.$this->getID().'');
        return ($nbSuppr > 0);
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function setLogin($_login) {
        $this->login = $_login;
    }
}
