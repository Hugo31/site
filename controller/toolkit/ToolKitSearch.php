<?php

class ToolKitSearch {
    public static function searchConflict($values) {
        $requete = "SELECT DISTINCT c.idConflict, c.name, c.description, c.idTypeConflict, c.date, c.nbComments, c.login FROM Conflict c ";
        if ($values['search_keywords'] != "") {
            $requete .= " WHERE name LIKE \"%".$values['search_keywords']."%\"";
            $keys = explode(" ", $values['search_keywords']);
            foreach ($keys as $k) {
                $requete .= " OR name LIKE \"%".$k."%\"";
            }        
        }
        return $requete;
    }
    
    public static function searchDP(&$values) {
        //header("Location: ../index.php");
        $requete = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp";
        $cond = "";
        if (isset($values['idCategory'])) {
            ToolKitSQL::generateCriteriaLine($values, "idCategory", "cat");
            ToolKitSQL::generateCriteriaQuery("Category", "cdp", "OR", $requete, $cond, $values['cat']);
        } else {
            $values['cat']["nb"] = 0;
        }
        if (isset($values['idComponent'])) {
            ToolKitSQL::generateCriteriaLine($values, "idComponent", "comp");
            ToolKitSQL::generateCriteriaQuery("Component", "cpdp", "AND", $requete, $cond, $values['comp']);
        } else {
            $values['comp']["nb"] = 0;
        }
        if (isset($values['idPlatform'])) {
            ToolKitSQL::generateCriteriaLine($values, "idPlatform", "plat");
            ToolKitSQL::generateCriteriaQuery("Platform", "plt", "OR", $requete, $cond, $values['plat']);
        } else {
            $values['plat']["nb"] = 0;
        }
        if (isset($values['idProperty'])) {
            ToolKitSQL::generateCriteriaLine($values, "idProperty", "prop");
            ToolKitSQL::generateCriteriaQuery("Property", "prt", "AND", $requete, $cond, $values['prop']);
        } else {
            $values['prop']["nb"] = 0;
        }
        if (isset($values['idSystem'])) {
            ToolKitSQL::generateCriteriaLine($values, "idSystem", "syst");
            ToolKitSQL::generateCriteriaQuery("System", "sys", "OR", $requete, $cond, $values['syst']);
        } else {
            $values['syst']["nb"] = 0;
        }
        
        $requete .= " WHERE ";
        if ($values['search_keywords'] != "") {
            $requete .= " (dp.name LIKE \"%".$values['search_keywords']."%\"";
            $keys = explode(" ", $values['search_keywords']);
            foreach ($keys as $k) {
                $requete .= " OR dp.name LIKE \"%".$k."%\"";
            }
            $requete .= ") AND ";
        }
        $requete .= "target = \"".$values['search_type_designpattern_target']. "\"";
        if ($cond != "") {
            $requete .= " AND ";
        }
        $requete .= $cond;

//Category : OU, Component : ET, System : OU, platform : OU, property : ET
        return $requete;
    }
    
    public static function searchSolution($values) {
        $requete = "SELECT DISTINCT s.idSolution, s.name, s.comment, s.date, s.rate, s.nbComments, s.nbRates, s.login FROM Solution s ";
        if ($values['search_keywords'] != "") {
            $requete .= " WHERE s.name LIKE \"%".$values['search_keywords']."%\"";
            $keys = explode(" ", $values['search_keywords']);
            foreach ($keys as $k) {
                $requete .= " OR s.name LIKE \"%".$k."%\"";
            }
        }
        return $requete;
    }
    
    public static function searchProject($values) {
        $requete = "SELECT DISTINCT p.idProject, p.name, p.description, p.date, p.login FROM Project p WHERE p.current = false";
        if ($values['search_keywords'] != "") {
            $requete .= " AND p.name LIKE \"%".$values['search_keywords']."%\"";
            $keys = explode(" ", $values['search_keywords']);
            foreach ($keys as $k) {
                $requete .= " OR p.name LIKE \"%".$k."%\"";
            }
        }
        return $requete;
    }
    
    public static function stockParameters($values, &$session) {
        $session->searchTextQuery = $values['search_keywords'];
        $session->targetQuery = $values['search_type_designpattern_target'];
        $session->idCategoryQuery = array();
        $session->idComponentQuery = array();
        $session->idPlatformQuery = array();
        $session->idPropertyQuery = array();
        $session->idSystemQuery = array();
        if ($session->typeQuery == "DesignPattern") {
            
            if (isset($values['cat'])) { $session->idCategoryQuery = $values['cat']; }
            if (isset($values['comp'])) { $session->idComponentQuery = $values['comp']; }
            if (isset($values['plat'])) { $session->idPlatformQuery = $values['plat']; }
            if (isset($values['prop'])) { $session->idPropertyQuery = $values['prop']; }
            if (isset($values['syst'])) { $session->idSystemQuery = $values['syst']; }
        }
    }
    
    public static function getNbCurrentCart($session) {
        $nb = 0;
        if (isset($session->login)) {
            $reqP = "SELECT idProject FROM Project WHERE login = \"".$session->login."\" AND current = 1;";
            $data = Database::getOneData($reqP);
            $reqNb = "SELECT count(idDesignPattern) As nb FROM ProjectDesignPattern WHERE idProject = ".$data['idProject'].";";
            $dataNb = Database::getOneData($reqNb);
            $nb += $dataNb['nb'];
            if (isset($session->currentDP)) {
                $nb += count($session->currentDP);
            }
        } else {
            $nb += count($session->currentDP);

        }
        echo $nb;
    }
}

?>
