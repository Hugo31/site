<?php

interface IComment {
    /**
     * Méthode d'ajout d'un commentaire à un objet.
     */
    public static function addComment($object, $user, $comment);
    
    /**
     * Méthode de suppresion d'un commentaire d'un objet.
     */
    public static function removeComment($idComment);
    
}
?>