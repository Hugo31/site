<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/AbstractBasicDB.php");
class AbstractBasicPostedDB extends AbstractBasicDB{
    private $login;
    private $date;
    
    public function __construct($_id, $_name, $_login, $_date) {
        parent::__construct($_id, $_name);
        $this->setLogin($_login);
        $this->setDate($_date);
    }
    
    public function getFromDB($donnees){
        $this->setLogin($donnees['login']);
        $this->setDate($donnees['date']);
        parent::getFromDB($donnees);
    }
    
    public function getLogin(){
        return $this->login;
    }

    public function setLogin($_login){
        $this->login = $_login;
    }
    
    public function getDate(){
        return $this->date;
    }

    public function setDate($_date) {
        $this->date = $_date;
    }
}
