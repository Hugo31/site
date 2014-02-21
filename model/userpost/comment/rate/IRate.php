<?php

interface IRate {
    
    /**
     * Méthode qui permet d'ajouter une note avec la table à noter,
     * l'utilisateur qui note,
     * la note.
     */
    public function addRate($user, $note);
    
    /**
     * Méthode qui permet de supprimer une note d'une table.
     */
    public function removeRate($user);
}

?>
