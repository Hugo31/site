<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBaseMini.php");
interface IDatabaseSort extends IDataBase{
    
    public static function getDB($id, $typeTable=NULL);
}
