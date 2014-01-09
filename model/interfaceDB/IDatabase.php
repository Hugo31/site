<?php 

interface IDataBase
{
    /**
     * Méthode d'ajout d'un objet à la base de donnée.
     */
    public static function addDB($object);

    /**
     * Méthode pour changer le contenu d'un objet dans la base de donnée.
     */
    public static function modifyDB($object);

    /**
     * Méthode de suppresion d'un objet de la base de donnée.
     */
    public static function removeDB($object);
    
    /**
     * Méthode pour récupérer un objet de la base de donnée.
     */
    public static function getDB($id);

}
?>