<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicPostedDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
abstract class AbstractBasicCommentDB extends AbstractBasicPostedDB{
    private $nbComments;
    
    public function __construct($_id, $_name, $_login, $_date) {
        parent::__construct($_id, $_name, $_login, $_date);
        $this->setNbComments(0);
    }
    
    public function getFromDB($donnees){
        $this->setNbComments($donnees['nbComments']);
        parent::getFromDB($donnees);
    }
    
    public function abstractAddComment($user, $comment, $nameTable) {
        
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO Comment'.$nameTable.' (login, id'.$nameTable.', date, comment) '
                            .'VALUES(:login, :id, NOW(), :comment)');
        $reussie = $rqt->execute(array(
            'login' => $user->getLogin(),
            'id' => $this->getID(),
            'comment' => $comment
        ));
        
        if($reussie){
            $rqt = $bdd->prepare('UPDATE TABLE '.$nameTable.' SET nbComments = nbComments + 1 WHERE id'.$nameTable.' = :id');
            $rqt->execute(array(
                'id' => $this->getID()
            ));
        }
        return $reussie;
    }
    
    public function abstractRemoveComment($idComment, $nameTable) {
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM Comment'.$nameTable.' WHERE idComment = \''.$idComment.'\'');
        if($nbLine > 0){
            $rqt = $bdd->prepare('UPDATE TABLE '.$nameTable.' SET nbComments = nbComments - 1 WHERE id'.$nameTable.' = :id');
            $rqt->execute(array(
                'id' => $this->getID()
            ));
        }
        return ($nbLine > 0);
    }
    
    public function getNbComments(){
        return $this->nbComments;
    }
    
    public function setNbComments($_nbComments){
        $this->nbComments = $_nbComments;
    }
}
