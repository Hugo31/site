<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/model/interfaceDB/IDataBaseMini.php");
interface IDataBase extends IDatabaseMini
{
    public static function getDB($id);

}
?>