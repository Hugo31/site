<?php

class Project implements IDataBase, ILink{
    
    public function __construct(){
        
    }
    
    /**
     * Ajoute un projet à la base de donnée.
     * @param Project $object Le projet à ajouter.
     */
    public static function addDB($object) {
        
    }

    /**
     * Ajoute un design pattern à un projet.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param Project $sort Le projet où l'on va ajouter un design pattern.
     */
    public static function addLink($tableToSort, $sort) {
        
    }

    /**
     * Donne un projet issus de la base de donnée.
     * @param int $id L'identifiant du projet dans la base de donnée.
     * @param NULL $typeTable = NULL ici.
     */
    public static function getDB($id) {
        
    }

    /**
     * 
     * @param type $object
     */
    public static function modifyDB($object) {
        
    }

    public static function removeDB($object) {
        
    }

    public static function removeLink($tableToSort, $sort) {
        
    }

}
?>
