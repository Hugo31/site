<?php

interface ILinkComponent {
    /**
     * Méthode pour ajouter un lien deux objets.
     */
    public function addLink($tableToLink);
    
    /**
     * Méthode pour ajouter un lien deux objets.
     */
    public function addLinkRelated($tableToLink);

    /**
     * Méthode pour supprimer le lien entre deux objets.
     */
    public function removeLink($tableToLink);
    
    /**
     * Méthode pour supprimer le lien entre deux objets.
     */
    public function removeLinkRelated($tableToLink);
}

?>