<?php

class Source {
    
    /**
     * Ajoute une source au design pattern.
     * @param DesignPattern $object Le design pattern concerné.
     * @param string $author L'auteur de l'image.
     * @param string $link Le lien de l'image.
     * @return bool True si l'ajout a réussi, False sinon.
     */
    public static function addSource($object, $author, $link) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO Source (idDesignPattern, author, link) '
                            .'VALUES(:idDesignPattern, :author, :link)');
        $reussie = $rqt->execute(array(
            'idDesignPattern' => $object->getID(),
            'author' => $author,
            'link' => $link
            ));
        return $reussie;
    }
    

    /**
     * Supprime une source.
     * @param int $src L'identifant de la source.
     */
    public static function removeSource($src) {
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM Source WHERE idSource = '.$src.'');
        return $nbLine > 0;
    }
}
