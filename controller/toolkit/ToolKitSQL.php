<?php

class ToolKitSQL {
    public static function generateCriteriaLine(&$values, $name, $newName) {
        if (isset($values[$name])) {
            $nbElem = $values[$name];
            //echo $nbElem;
            $values[$newName] = array();
            $values[$newName]["nb"] = 0;
            for ($i = 0; $i < $nbElem; $i++) {
                if (isset($values[$name.$i])) {
                    $var = explode("|", $values[$name.$i]);
                    $values[$newName][$values[$newName]["nb"]] = $var[0];
                    $values[$newName][$var[1]] = 1;
                    $values[$newName]["nb"] += 1;
                }
            }
        }
        
    }
    
    public static function generateCriteriaQuery($nameCat, $acronym, $cdt, &$requete, &$cond, $results) {
        if (isset($results)) {
            if (count($results) > 1) {
                if ($cdt == "AND") {
                    if ($cond != "") {
                        $cond .= " AND ";
                    }
                    for ($i = 0; $i < $results["nb"] - 1; $i++) {
                        $requete .= ", ".$nameCat."DesignPattern ".$acronym.$i."";
                        $cond .= "(".$acronym.$i.".id".$nameCat." = ".$results[$i]." AND dp.idDesignPattern = ".$acronym.$i.".idDesignPattern)";
                        $cond .= " AND ";
                    }
                    $requete .= ", ".$nameCat."DesignPattern ".$acronym.$i."";
                    $cond .= "(".$acronym.$i.".id".$nameCat." = ".$results[$i]." AND dp.idDesignPattern = ".$acronym.$i.".idDesignPattern)";

                } else {
                    $requete .= ", ".$nameCat."DesignPattern ".$acronym;
                    if ($cond != "") {
                        $cond .= " AND ";
                    }
                    $cond .= "(dp.idDesignPattern = ".$acronym.".idDesignPattern AND (";
                    for ($i = 0; $i < $results["nb"] - 1; $i++) {
                        $cond .= "(".$acronym.".id".$nameCat." = ".$results[$i].")";
                        $cond .= " OR ";
                    }
                    $cond .= "(".$acronym.".id".$nameCat." = ".$results[$i].")";
                    $cond .= "))";
                }
            }
            
        }
    }
}
