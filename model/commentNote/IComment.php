<?php

interface IComment {
    public static function addComment($object, $user, $comment);
    
    public static function removeComment($idComment);
}
?>