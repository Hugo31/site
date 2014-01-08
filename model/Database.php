<?php

class Database {
    private static $bdd = NULL;
    /**
     * Réalise la connexion à la base de donnée
     * @return \PDO Une variable de connexion à la base de donnée
     */
    private static function connect(){ 
        try{ 
            return new PDO('mysql:host=localhost;dbname=mydb', 'admin', 'admin');
        } catch (Exception $e){ 
            die('Erreur : ' . $e->getMessage()); 
        } 
    } 
    
    /**
     * Donne la connexion à la base de donnée, et la crée si elle n'existe pas.
     * @return \PDO Une variable de connexion à la base de donnée.
     */
    public static function getConnection(){
        if(Database::$bdd == NULL){
            Database::$bdd = Database::connect();
        }
        return Database::$bdd;
    }
    
    
}

?>
