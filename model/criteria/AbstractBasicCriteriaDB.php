<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/AbstractBasicDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/IAbstractLink.php");

class AbstractBasicCriteriaDB extends AbstractBasicDB implements IAbstractLink{
    private $description;
    
    public function __construct($_id, $_name, $_desc) {
        parent::__construct($_id, $_name);
        $this->setDescription($_desc);
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($_description) {
        $this->description = $_description;
    }

    public static function addLink($tableToSort, $sort, $nameSort) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO '.$nameSort.'DesignPattern (idDesignPattern, id'.$nameSort.') VALUES (:idDP, :idSort)');
        $reussie = $req->execute(array(
            'idDP' => $tableToSort->getID(),
            'idSort' => $sort->getID()
        ));
        return $reussie;
    }

    public static function removeLink($tableToSort, $sort, $nameSort) {
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM '.$nameSort.'DesignPattern WHERE idDesignPattern = '.$tableToSort->getID().' AND id'.$nameSort.' = '.$sort->getID().'');
        return ($nbSuppr > 0);
        
    }

}
