<?php

interface IImage {
    /**
     * Méthode d'ajout d'une image à un objet.
     */
    public static function addImage($object, $link);
    
    /**
     * Méthode de suppresion d'une image à un objet.
     */
    public static function removeImage($img);
}

?>
