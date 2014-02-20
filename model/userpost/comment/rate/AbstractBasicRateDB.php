<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/AbstractBasicCommentDB.php.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/IAbstractRate.php");
abstract class AbstractBasicRateDB extends AbstractBasicCommentDB implements IAbstractRate{
    private $rate;
    private $nbRates;
    
    public function __construct($_id, $_name, $_login, $_date) {
        parent::__construct($_id, $_name, $_login, $_date);
        $this->setNbRates(0);
        $this->setRate(0);
    }
    
    public static function addRate($object, $user, $note, $nameTable){
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO Note'.$nameTable.' (login, id'.$nameTable.', note) '
                            .'VALUES(:login, :id, :note)');
        $reussie = $rqt->execute(array(
            'login' => $user->getLogin(),
            'id' => $object->getID(),
            'note' => $note
            ));
        return $reussie;
    }
     
    public static function removeRate($object, $user, $nameTable){
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM Note'.$nameTable.' WHERE '
                    .'login = \''.$user->getLogin().'\' AND id'.$nameTable.' = '.$object->getID().'');
        return $nbLine > 0;
    }
    
    public function getRate(){
        return $this->rate;
    }
    
    public function setRate($_rate){
        $this->rate = $_rate;
    }
    
    public function getNbRates(){
        return $this->nbRates;
    }
    
    public function setNbRates($_nbRates){
        $this->nbRates = $_nbRates;
    }
}
