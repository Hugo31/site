<?php
interface IComment{
    /**
     * Méthode d'ajout d'un commentaire à un objet.
     */
    public function addComment($user, $comment);
    
    /**
     * Méthode de suppresion d'un commentaire d'un objet.
     */
    public function removeComment($idComment);
    
}
?>