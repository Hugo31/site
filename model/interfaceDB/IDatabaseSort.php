<?php

require_once("IDatabase.php");
interface IDatabaseSort extends IDataBase{
    
    public static function getDB($id, $typeTable=NULL);
}
