<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBaseMini.php");
interface IDataBase extends IDatabaseMini
{
    public static function getDB($id);

}
?>