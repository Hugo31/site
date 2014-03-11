<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicDB.php");

class AbstractBasicCriteriaDB extends AbstractBasicDB{
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

    public function addLinkSort($tableToLink, $nameSort) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO '.$nameSort.'DesignPattern (idDesignPattern, id'.$nameSort.') VALUES (:idDP, :idSort)');
        $reussie = $req->execute(array(
            'idDP' => $tableToLink->getID(),
            'idSort' => $this->getID()
        ));
        return $reussie;
    }

    public function removeLinkSort($tableToLink, $nameSort) {
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM '.$nameSort.'DesignPattern WHERE idDesignPattern = '.$tableToLink->getID().' AND id'.$nameSort.' = '.$this->getID().'');
        return ($nbSuppr > 0);
        
    }

}
