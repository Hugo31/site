<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Image
 *
 * @author loic
 */
class Image {
    /**
     * Ajoute une image au design pattern.
     * @param DesignPattern $object Le design pattern concerné.
     * @param string $link Le lien de l'image.
     * @return bool True si l'ajout a réussi, False sinon.
     */
    public static function addImage($object, $link, $description) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO ImageDesignPattern (idDesignPattern, link, description) '
                            .'VALUES(:idDesignPattern, :link, :description)');
        $reussie = $rqt->execute(array(
            'idDesignPattern' => $object->getID(),
            'link' => $link, 
            'description' => $description
            ));
        return $reussie;
    }

    /**
     * Supprime une image.
     * @param int $img L'identifiant de l'image.
     */
    public static function removeImage($img) {
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM ImageDesignPattern WHERE idImage = '.$img.'');
        return $nbLine > 0;
    }
}
