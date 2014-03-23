<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicCommentDB.php");
abstract class AbstractBasicRateDB extends AbstractBasicCommentDB{
    private $rate;
    private $nbRates;
    
    public function __construct($_id, $_name, $_login, $_date) {
        parent::__construct($_id, $_name, $_login, $_date);
        $this->setNbRates(0);
        $this->setRate(0);
    }
    
    public function getFromDB($donnees){
        $this->setRate($donnees['rate']);
        $this->setNbRates($donnees['nbRates']);
        parent::getFromDB($donnees);
    }
    
    public function abstractAddRate($user, $note, $nameTable){
        $bdd = Database::getConnection();
        $data = Database::getOneData('SELECT count(note) as nb FROM Note'.$nameTable.' WHERE id'.$nameTable.' = '.$this->getID().' AND login = "'.$user->getLogin().'";');
        if($data['nb'] > 0){
            $rqt = $bdd->prepare('UPDATE Note'.$nameTable.' SET note = :note WHERE id'.$nameTable.' = :id AND login = :login;');
        }
        else{
            $rqt = $bdd->prepare('INSERT INTO Note'.$nameTable.' (login, id'.$nameTable.', note) '
                            .'VALUES (:login, :id, :note)');
            
        }
        $reussie = $rqt->execute(array(
            'login' => $user->getLogin(),
            'id' => $this->getID(),
            'note' => $note
        ));
        if($reussie){
            $requete = 'UPDATE '.$nameTable.' SET';
            if($data['nb'] == 0){ $requete .= ' nbRates = nbRates + 1, ';}
            
            
            $rqt = $bdd->prepare($requete.''
                                .' rate = (SELECT AVG(note) FROM Note'.$nameTable.' WHERE id'.$nameTable.' = '.$this->getID().')'
                                .' WHERE id'.$nameTable.' = :id');
            $rqt->execute(array(
                'id' => $this->getID()
            ));
        }
        return $reussie;
    }
     
    public function abstractRemoveRate($user, $nameTable){
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM Note'.$nameTable.' WHERE '
                    .'login = \''.$user->getLogin().'\' AND id'.$nameTable.' = '.$this->getID().'');
        if($nbLine > 0){
            $data = Database::getOneData('SELECT AVG(note) as avg FROM Note'.$nameTable.' WHERE id'.$nameTable.' = '.$this->getID().'');
            if($data['avg'] == null){
                $data['avg'] = 0;
            }
            $rqt = $bdd->prepare('UPDATE '.$nameTable.' SET nbRates = nbRates - 1, '
                                .'rate = :avg'
                                .' WHERE id'.$nameTable.' = :id');
            $rqt->execute(array(
                'id' => $this->getID(), 
                'avg' => $data['avg']
            ));
        }
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
