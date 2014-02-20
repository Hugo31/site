<?php

interface IAbstractRate {
    /**
     * Méthode qui permet d'ajouter une note avec la table à noter,
     * l'utilisateur qui note,
     * la note.
     */
    public static function addRate($object, $user, $note, $nameTable);
    
    /**
     * Méthode qui permet de supprimer une note d'une table.
     */
    public static function removeRate($object, $user, $nameTable);
    
    public function getRate();
    
    public function setRate($_rate);
    
    public function getNbRates();
    
    public function setNbRates($_nbRates);
}
