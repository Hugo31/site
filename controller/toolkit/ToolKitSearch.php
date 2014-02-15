<?php

class ToolKitSearch {
    public static function searchConflict($values){
        $requete = "SELECT DISTINCT c.idConflict, c.name FROM Conflict c WHERE name LIKE \"".$values['search_keywords']."\"";
    }
    
    public static function searchDP($values){
        //header("Location: ../index.php");
        $requete = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what FROM DesignPattern dp";
        $cond = "";
        if(isset($values['idCategory'])){
            ToolKitSQL::generateCriteriaQuery("Category", "cdp", "OR", $requete, $cond, $values['idCategory']);
        }
        if(isset($values['idComponent'])){
            ToolKitSQL::generateCriteriaQuery("Component", "cpdp", "AND", $requete, $cond, $values['idComponent']);
        }
        if(isset($values['idPaltform'])){
            ToolKitSQL::generateCriteriaQuery("Platform", "plt", "OR", $requete, $cond, $values['idPlatform']);
        }
        if(isset($values['idProperty'])){
            ToolKitSQL::generateCriteriaQuery("Property", "prt", "AND", $requete, $cond, $values['idProperty']);
        }
        if(isset($values['idSystem'])){
            ToolKitSQL::generateCriteriaQuery("System", "sys", "OR", $requete, $cond, $values['idSystem']);
        }
        


        $requete .= " WHERE target = \"".$values['search_type_designpattern_target']. "\"";
        if($cond != ""){
            $requete .= " AND ";
        }
        $requete .= $cond;

//Category : OU, Component : ET, System : OU, platform : OU, property : ET

        return $requete;
    }
    
    public static function searchSolution(){
        
    }
}

?>
