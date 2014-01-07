<?php
require_once($_SERVER['DOCUMENT_ROOT']."/model/interfaceDB/IDataBase.php");
class User implements IDataBase{
    private $login;
    private $pwd;
    private $lastname;
    private $firstname;
    private $mail;
    private $logo;
    
    
    public function __construct(){
        //ta mamanss
    }
    
    /**
     * Ajoute à la base de donnée un utilisateur.
     * @param User $object L'utilisateur à rajouter. 
     */
    public static function addDB($object) {
        
    }

    /**
     * Donne un utilisateur issus de la base de donnée.
     * @param int $id L'identifiant de l'utilisateur à obtenir.
     * @param NULL $typeTable = NULL ici.
     */
    public static function getDB($id) {
        
    }

    /**
     * Modifie un utilisateur dans la base de donnée
     * @param User $object L'utilisateur à modifier
     */
    public static function modifyDB($object) {
        
    }

    /**
     * Supprime de la base de donnée l'utilisateur passé en paramètre.
     * @param User $object L'utilisateur à supprimer de la base de donnée.
     */
    public static function removeDB($object) {
        
    }

}

?>
