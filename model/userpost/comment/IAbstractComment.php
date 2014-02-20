<?php

interface IAbstractComment {
    /**
     * Méthode d'ajout d'un commentaire à un objet.
     */
    public static function addComment($object, $user, $comment , $nameTable);
    
    /**
     * Méthode de suppresion d'un commentaire d'un objet.
     */
    public static function removeComment($idComment, $nameTable);
    
    public function getNbComments();
    
    public function setNbComments($_nbComments);
}
