<?php

class Database {
    
    /**
     * Réalise la connexion à la base de donnée
     * @return \PDO Une variable de connexion à la base de donnée
     */
    public static function connect(){ 
        try{ 
            return new PDO('mysql:host=localhost;dbname=mydb', 'root', 'root'); 
        } catch (Exception $e){ 
            die('Erreur : ' . $e->getMessage()); 
        } 
    } 
}

?>