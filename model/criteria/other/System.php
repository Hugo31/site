<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/AbstractBasicCriteriaDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/ILinkCriteria.php");
class System extends AbstractBasicCriteriaDB implements IDatabase, ILinkCriteria{
    private $icon;
    /**
     * Construit un système
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom du système.
     * @param string $_desc La description du système.
     * @param string $_icon L'icone associée.
     */
    public function __construct($_idSort, $_name, $_desc, $_icon){
        parent::__construct($_idSort, $_name, $_desc);
        $this->setIcon($_icon);
    }
    
    /**
     * Ajoute à la base de donnée un système passé en paramètre.
     * @param System $object Le système à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO System (name, description, icon) VALUES(:name, :description, icon)');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(), 
            'icon' => $object->getIcone()
        ));
        if($reussie == true){
            $object->setID((int)$bdd->lastInsertId()); 
        }
        return $reussie;
        
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
        $st = new System($donnees['idSystem'], $donnees['name'], $donnees['description'], $donnees['icon']);
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
        $req = $bdd->prepare('UPDATE System SET name = :name, description = :description, icon = :icon WHERE idSystem = :id');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'icon' => $object->getIcon(),
            'id' => $object->getID()
        ));
        return $reussie;
    }

    /**
     * Supprime de la base de donnée un système.
     * @param System $object Le système à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM SystemDesignPattern WHERE idSystem = \''.$object->getID().'\'');
        $nbSuppr = $bdd->exec('DELETE FROM System WHERE idSystem = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }
    
    /**
     * Ajoute un lien entre un système et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param System $sort Le système à lier.
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public static function addLink($tableToSort, $sort){
        return parent::addLink($tableToSort, $sort, "System");
    }

    /**
     * Supprime un lien entre un système et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @param System $sort Le système à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public static function removeLink($tableToSort, $sort){
        return parent::removeLink($tableToSort, $sort, "System");
    }
    
    public function setIcon($_icon){
        $icon = $_icon; 
    }
    
    public function getIcon() {
        return $icon;
    }
}
