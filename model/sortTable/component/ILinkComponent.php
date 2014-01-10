<?php

interface ILinkComponent {
    /**
     * Méthode pour ajouter un lien deux objets.
     */
    public static function addLink($tableToSort, $sort);
    
    /**
     * Méthode pour ajouter un lien deux objets.
     */
    public static function addLinkRelated($tableToSort, $sort);

    /**
     * Méthode pour supprimer le lien entre deux objets.
     */
    public static function removeLink($tableToSort, $sort);
    
    /**
     * Méthode pour supprimer le lien entre deux objets.
     */
    public static function removeLinkRelated($tableToSort, $sort);
}

?>