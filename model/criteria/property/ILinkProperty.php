<?php

interface ILinkProperty {
    /**
     * Méthode pour ajouter un lien deux objets.
     */
    public function addLink($tableToLink, $note);

    /**
     * Méthode pour supprimer le lien entre deux objets.
     */
    public function removeLink($tableToLink);
}

?>