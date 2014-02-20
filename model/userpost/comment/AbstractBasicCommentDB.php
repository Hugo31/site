<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/AbstractBasicPostedDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/IAbstractComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
abstract class AbstractBasicCommentDB extends AbstractBasicPostedDB implements IAbstractComment{
    private $nbComments;
    
    public function __construct($_id, $_name, $_login, $_date) {
        parent::__construct($_id, $_name, $_login, $_date);
        $this->setNbComments(0);
    }
    
    public function addComment($object, $user, $comment, $nameTable) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO Comment'.$nameTable.' (login, '.$nameTable.', date, comment) '
                            .'VALUES(:login, :id, NOW(), :comment)');
        $reussie = $rqt->execute(array(
            'login' => $user->getLogin(),
            'id' => $object->getID(),
            'comment' => $comment
        ));
        return $reussie;
    }
    
    public function removeComment($idComment, $nameTable) {
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM Comment'.$nameTable.' WHERE idComment = \''.$idComment.'\'');
        return $nbLine > 0;
    }
    
    public function getNbComments(){
        return $this->nbComments;
    }
    
    public function setNbComments($_nbComments){
        $this->nbComments = $_nbComments;
    }
}
