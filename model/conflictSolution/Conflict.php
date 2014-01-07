<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/INote.php");
class Conflict implements IDataBase, IComment{
    
    public static function addDB($object) {
        
    }

    public static function getDB($id) {
        
    }

    public static function modifyDB($object) {
        
    }

    public static function removeDB($object) {
        
    }

    public static function addComment($object, $user, $comment) {
        
    }

    public static function removeComment($idComment) {
        
    }

}

?>
