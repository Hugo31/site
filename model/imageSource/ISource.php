<?php

interface ISource {
    
    /**
     * Méthode d'ajout d'une source à un objet.
     */
    public static function addSource($object, $author, $link);
    
    /**
     * Méthode de suppresion d'une source d'un objet.
     */
    public static function removeSource($src);
}

?>