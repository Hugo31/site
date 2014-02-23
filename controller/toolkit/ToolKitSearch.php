<?php

class ToolKitSearch {
    public static function searchConflict($values){
        $requete = "SELECT DISTINCT c.idConflict, c.name, c.description FROM Conflict c ";
        if($values['search_keywords'] != ""){
            $requete .= " WHERE name LIKE \"%".$values['search_keywords']."%\"";
        }
        return $requete;
    }
    
    public static function searchDP($values){
        //header("Location: ../index.php");
        $requete = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments FROM DesignPattern dp";
        $cond = "";
        if(isset($values['idCategory'])){
            ToolKitSQL::generateCriteriaLine($values, "idCategory", "cat");
            ToolKitSQL::generateCriteriaQuery("Category", "cdp", "OR", $requete, $cond, $values['cat']);
        }
        if(isset($values['idComponent'])){
            ToolKitSQL::generateCriteriaLine($values, "idComponent", "comp");
            ToolKitSQL::generateCriteriaQuery("Component", "cpdp", "AND", $requete, $cond, $values['comp']);
        }
        if(isset($values['idPlatform'])){
            ToolKitSQL::generateCriteriaLine($values, "idPlatform", "plat");
            ToolKitSQL::generateCriteriaQuery("Platform", "plt", "OR", $requete, $cond, $values['plat']);
        }
        if(isset($values['idProperty'])){
            ToolKitSQL::generateCriteriaLine($values, "idProperty", "prop");
            ToolKitSQL::generateCriteriaQuery("Property", "prt", "AND", $requete, $cond, $values['prop']);
        }
        if(isset($values['idSystem'])){
            ToolKitSQL::generateCriteriaLine($values, "idSystem", "syst");
            ToolKitSQL::generateCriteriaQuery("System", "sys", "OR", $requete, $cond, $values['syst']);
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
        $requete = "SELECT DISTINCT s.idSolution, s.comment FROM Solution s WHERE name LIKE \"%".$values['search_keywords']."%\"";
    
        return $requete;
    }
}

?>
