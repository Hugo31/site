<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBaseMini.php");
interface IDatabaseSort extends IDataBaseMini{
    /**
     * Méthode pour récupérer un objet de la base de donnée dans le cas de plusieurs tables possibles.
     */
    public static function getDB($id, $typeTable=NULL);
}
