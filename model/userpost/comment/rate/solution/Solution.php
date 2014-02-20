<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/IRate.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/AbstractBasicRateDB.php");

class Solution extends AbstractBasicRateDB implements IDatabase, IComment, IRate{
    private $comment;
    private $codeSolution;
    private $idConflict;

    public function __construct($_id, $_name, $_login, $_date, $_comment, $_codeSolution, $_idConflict) {
        parent::__construct($_id, $_name, $_login, $_date);
        $this->setComment($_comment);
        $this->setCodeSolution($_codeSolution);
        $this->setIDConflict($_idConflict);
    }

    public static function addDB($object) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO Solution (comment, codeSolution, date, nbComments, nbRates, rate, idConflit, login) '
                            .'VALUES(:comment, :codeSolution, :date, :nbComments, :nbRates, :rate, :idConflit, :login)');
        $reussie = $rqt->execute(array(
            'comment' => $object->getComment(),
            'codeSolution' => $object->getCodeSolution(),
            'date' => $object->getDate(),
            'nbComments' => $object->getNbComments(), 
            'nbRates' => $object->getNbRates(), 
            'rate' => $object->getRate(), 
            'idConflict' => $object->getIDConflict(),
            'login' => $object->getLogin()
            ));
        if($reussie){
            $object->setID((int) $bdd->lastInsertId());
        }
        return $reussie;
    }

    public static function getDB($id) {
        $bdd = Database::getConnection();
        $reponse = $bdd->exec('SELECT * FROM Solution WHERE idSolution = ' . $id . '');
        $donnees = $reponse->fetch();

        $solution = new Solution($id, $donnees['comment'], $donnees['codeSolution'], $donnees['date'], $donnees['idConflict'], $donnees['login']);
        $solution->setNbComments($donnees['nbComments']);
        $solution->setNbRates($donnees['nbRates']);
        $solution->setRate($donnees['rate']);
        
        $reponse->closeCursor();
        return $solution;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();

        $reponse = $bdd->prepare('UPDATE Solution SET name = :name, comment = :comment, codeSolution = :codeSolution, '
                                .'nbComments = :nbComments, nbRates = :nbRates, rate = :rate, '
                                .'date = :date, login = :login WHERE idSolution = ' . $this->getID() . '');
        $reponse->execute(array(
            'name' => $object->getName(),
            'comment' => $object->getComment(),
            'codeSolution' => $object->getCodeSolution(),
            'nbComments' => $object->getNbComments(), 
            'nbRates' => $object->getNbRates(), 
            'rate' => $object->getRate(), 
            'date' => $object->getDate(),
            'login' => $object->getLogin(),
        ));
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM CommentSolution WHERE idSolution = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM NoteSolution WHERE idSolution = \'' . $object->getID() . '\'');
        $nbSuppr = $bdd->exec('DELETE FROM Solution WHERE idSolution = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }

    public static function addComment($object, $user, $comment) {
        return parent::addComment($object, $user, $comment, "Solution");
    }

    public static function addNote($object, $user, $note) {
        return parent::addNote($object, $user, $note, "Solution");
    }

    public static function removeComment($idComment) {
        return parent::removeComment($idComment, "Solution");
    }

    public static function removeNote($object, $user) {
        return parent::removeNote($object, $user, "Solution");
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($_comment) {
        $this->comment = $_comment;
    }

    public function getCodeSolution() {
        return $this->codeSolution;
    }

    public function setCodeSolution($_codeSolution) {
        $this->codeSolution = $_codeSolution;
    }

    public function getIDConflict() {
        return $this->idConflict;
    }

    public function setIDConflict($_idConflict) {
        $this->idConflict = $_idConflict;
    }

}
