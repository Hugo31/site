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
        $bdd = Database::connect();
        $champ = 'comment, codeSolution, date, idConflit, login';
        $value = '\'' . $object->getComment() . '\', \'' . $object->getCodeSolution() . '\'';
        $value .= ', NOW(), ' . $object->getIDConflict() . ', \'' . $object->getLogin() . '\'';
        $bdd->exec('INSERT INTO Solution(' . $champ . ') VALUES(' . $value . ')');
        $object->setID((int) $bdd->lastInsertId());
    }

    public static function getDB($id) {
        $bdd = Database::connect();
        $reponse = $bdd->exec('SELECT * FROM Solution WHERE idSolution = ' . $id . '');
        $donnees = $reponse->fetch();

        $solution = new Solution($donnees['idSolution'], $donnees['comment'], $donnees['codeSolution'], 
                $donnees['date'], $donnees['idConflict'], $donnees['login']);
        $reponse->closeCursor();
        return $solution;
    }

    public static function modifyDB($object) {
        
    }

    public static function removeDB($object) {
        
    }

    public static function addComment($object, $user, $comment) {
        $bdd = Database::connect();
        $champ = 'login, idSolution, date, comment';
        $value = '\'' . $user->getLogin() . '\', ' . $object->getID() . ', NOW(), \'' . $comment . '\'';
        $bdd->exec('INSERT INTO CommentSolution(' . $champ . ') VALUES(' . $value . ')');
    }

    public static function addNote($object, $user, $note) {
        
    }

    public static function removeComment($idComment) {
        $bdd = Database::connect();
        $bdd->exec('DELETE FROM CommentSolution WHERE idComment = \'' . $idComment . '\'');
    }

    public static function removeNote($object, $user) {
        
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
