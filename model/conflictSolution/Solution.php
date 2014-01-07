<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/INote.php");
class Solution implements IDataBase, IComment, INote{
    
    public static function addDB($object) {
        
    }

    public static function getDB($id) {
        
    }

    public static function modifyDB($object) {
        
    }

    public static function removeDB($object) {
        
    }

    public static function addComment($object, $user, $comment) {
        $bdd = Database::connect();
        $champ = 'login, idSolution, date, comment';
        $value = '\''.$user->getLogin().'\', '.$object->getID().', NOW(), \''.$comment.'\'';
        $bdd->exec('INSERT INTO CommentSolution('.$champ.') VALUES('.$value.')');
    }

    public static function addNote($object, $user, $note) {
        
    }

    public static function removeComment($idComment) {
        $bdd = Database::connect();
        $bdd->exec('DELETE FROM CommentSolution WHERE idComment = \''.$idComment.'\'');
    }

    public static function removeNote($object, $user) {
        
    }

}

?>
