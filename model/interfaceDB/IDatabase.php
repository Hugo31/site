<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBaseMini.php");
interface IDataBase extends IDatabaseMini
{
    /**
     * Méthode pour récupérer un objet de la base de donnée.
     */
    public static function getDB($id);

}
?>