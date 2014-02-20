<?php

interface IAbstractLink {
    
    /**
     * Méthode pour ajouter un lien deux objets.
     */
    public static function addLink($tableToSort, $sort, $nameSort);

    /**
     * Méthode pour supprimer le lien entre deux objets.
     */
    public static function removeLink($tableToSort, $sort, $nameSort);
}
