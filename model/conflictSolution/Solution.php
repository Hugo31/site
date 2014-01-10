<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/commentNote/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/commentNote/INote.php");

class Solution implements IDataBase, IComment, INote {

    private $idSolution;
    private $comment;
    private $codeSolution;
    private $date;
    private $idConflict;
    private $login;

    public function __construct($_idSolution, $_comment, $_codeSolution, $_date, $_idConflict, $_login) {
        $this->setID($_idSolution);
        $this->setComment($_comment);
        $this->setCodeSolution($_codeSolution);
        $this->setDate($_date);
        $this->setIDConflict($_idConflict);
        $this->setLogin($_login);
    }

    public static function addDB($object) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO Solution (comment, codeSolution, date, idConflit, login) '
                            .'VALUES(:comment, :codeSolution, NOW(), :idConflit, :login)');
        $rqt->execute(array(
            'comment' => $object->getComment(),
            'codeSolution' => $object->getCodeSolution(),
            'idConflict' => $object->getIDConflict(),
            'login' => $object->getLogin()
            ));
        $object->setID((int) $bdd->lastInsertId());
    }

    public static function getDB($id) {
        $bdd = Database::getConnection();
        $reponse = $bdd->exec('SELECT * FROM Solution WHERE idSolution = ' . $id . '');
        $donnees = $reponse->fetch();

        $solution = new Solution($id, $donnees['comment'], $donnees['codeSolution'], $donnees['date'], $donnees['idConflict'], $donnees['login']);
        $reponse->closeCursor();
        return $solution;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();

        $reponse = $bdd->prepare('UPDATE Solution SET comment = :comment, codeSolution = :codeSolution, '
                . 'date = NOW(), login = :login WHERE idSolution = ' . $this->getID() . '');
        $reponse->execute(array(
            'comment' => $object->getComment(),
            'codeSolution' => $object->getCodeSolution(),
            'login' => $object->getLogin(),
        ));
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        
        $bdd->exec('DELETE FROM CommentSolution WHERE idSolution = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM NoteSolution WHERE idSolution = \'' . $object->getID() . '\'');
        $bdd->exec('DELETE FROM Solution WHERE idSolution = \''.$object->getID().'\'');
    }

    public static function addComment($object, $user, $comment) {
        $bdd = Database::getConnection();
        $champ = 'login, idSolution, date, comment';
        $value = '\'' . $user->getLogin() . '\', ' . $object->getID() . ', NOW(), \'' . $comment . '\'';
        $bdd->exec('INSERT INTO CommentSolution(' . $champ . ') VALUES(' . $value . ')');
    }

    public static function addNote($object, $user, $note) {
        $bdd = Database::getConnection();   
        $champ = 'login, idSolution, note';
        $value = '\'' . $user->getLogin() . '\', ' . $object->getID() . '\'' . $note . '\'';
        $bdd->exec('INSERT INTO NoteSolution(' . $champ . ') VALUES(' . $value . ')');
    }

    public static function removeComment($idComment) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM CommentSolution WHERE idComment = \'' . $idComment . '\'');
    }

    public static function removeNote($object, $user) {
        $bdd = Database::getConnection();
        $bdd->exec('DELETE FROM NoteSolution WHERE idSolution = ' . $object->getID() 
                . 'AND login = \'' . $user->getLogin() . '\'');
    }

    public function getID() {
        return $this->idSolution;
    }

    public function setID($_idSolution) {
        $this->idSolution = $_idSolution;
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

    public function getDate() {
        return $this->date;
    }

    public function setDate($_date) {
        $this->date = $_date;
    }

    public function getIDConflict() {
        return $this->idConflict;
    }

    public function setIDConflict($_idConflict) {
        $this->idConflict = $_idConflict;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($_login) {
        $this->login = $_login;
    }

}

?>
