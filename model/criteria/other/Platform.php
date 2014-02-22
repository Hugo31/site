<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/AbstractBasicCriteriaDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/ILinkCriteria.php");
class Platform extends AbstractBasicCriteriaDB implements IDatabase, ILinkCriteria{
    
    private $icon;
    /**
     * Construit une plateforme
     * @param int $_idSort L'identifiant dans la base de donnée.
     * @param string $_name Le nom de la plateforme.
     * @param string $_desc La description de la plateforme.
     * @param string $_icon L'icone de la plateforme.
     */
    public function __construct($_idSort, $_name, $_desc, $_icon){
        parent::__construct($_idSort, $_name, $_desc);
        $this->setIcon($_icon);
    }
    
    /**
     * Ajoute à la base de donnée une plateforme passé en paramètre.
     * @param Platform $object La plateforme à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO Platform (name, description, icon) VALUES(:name, :description, :icon)');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(), 
            'icon' => $object->getIcon()
        ));
        if($reussie == true){
            $object->setID((int)$bdd->lastInsertId()); 
        }
        return $reussie;
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
        $reponse->closeCursor();
        if($donnees != false){
            return new Platform($donnees['idPlatform'], $donnees['name'], $donnees['description'], $donnees['icon']);
        }
        return false;
    }

    /**
     * Modifie une plateforme de la base de donnée.
     * @param Platform $object La nouvelle plateforme à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE Platform SET name = :name, description = :description, icon = :icon WHERE idPlatform = :id');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'icon' => $object->getIcon(),
            'id' => $object->getID()
        ));
        return $reussie;
    }

    /**
     * Supprime de la base de donnée une plateforme.
     * @param Platform $object La plateforme à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM PlatformDesignPattern WHERE idPlatform = \''.$object->getID().'\'');
        $nbSuppr = $bdd->exec('DELETE FROM Platform WHERE idPlatform = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }
    
    /**
     * Ajoute un lien entre une plateforme et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @return bool True si le lien a été ajouté, FALSE sinon.
     */
    public function addLink($tableToLink){
        return parent::addLinkSort($tableToLink, "Platform");
    }

    /**
     * Supprime un lien entre une plateforme et un design pattern.
     * @param DesignPattern $tableToSort Le design pattern à délier.
     * @return bool True si le lien a été supprimer, FALSE sinon.
     */
    public function removeLink($tableToLink){
        return parent::removeLinkSort($tableToLink, "Platform");
    }
    
    public function setIcon($_icon){
        $this->icon = $_icon; 
    }
    
    public function getIcon() {
        return $this->icon;
    }
}
