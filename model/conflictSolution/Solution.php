<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/INote.php");
class Solution implements IDataBase, IComment, INote{
    
    public static function addDB($object) {
        $bdd = Database::connect();
        $champ = 'idComment, login, idSolution, date, comment';
        $value = '\''.$object->getIdComment.'\',\''.$object->getLogin.'\',\''.$object->getIdSolution.'\'';
        $value .= '\''.$object->getDate.'\',\''.$object->getComment.'\'';
        $bdd->exec('INSERT INTO CommentSolution('.$champ.') VALUES('.$value.')');
        $object->setID((int)$bdd->lastInsertId());
    }

    public static function getDB($id) {
        
    }

    public static function modifyDB($object) {
        
    }

    public static function removeDB($object) {
        
    }

    public static function addComment($object, $user, $comment) {
        
    }

    public static function addNote($object, $user, $note) {
        
    }

    public static function removeComment($idComment) {
        
    }

    public static function removeNote($object, $user) {
        
    }

}

?>
