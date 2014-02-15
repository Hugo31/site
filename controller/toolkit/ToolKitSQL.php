<?php

class ToolKitSQL {
    public static function generateCriteriaQuery($nameCat, $acronym, $cdt, &$requete, &$cond, $results){
        if(isset($results)){
            $var = explode("|", $results); //Le dernier résultat de var n'est pas à prendre
            if(count($var) > 0 && $var[0] != ""){
                if($cdt == "AND"){
                    if($cond != ""){
                        $cond .= " AND ";
                    }
                    for($i = 0; $i < count($var) - 2; $i++){
                        $requete .= ", ".$nameCat."DesignPattern ".$acronym.$i."";
                        $cond .= "(".$acronym.$i.".id".$nameCat." = ".$var[$i]." AND dp.idDesignPattern = ".$acronym.$i.".idDesignPattern)";
                        $cond .= " AND ";
                    }
                    $requete .= ", ".$nameCat."DesignPattern ".$acronym.$i."";
                    $cond .= "(cpdp".$i.".id".$nameCat." = ".$var[$i]." AND dp.idDesignPattern = ".$acronym.$i.".idDesignPattern)";

                }
                else{
                    $requete .= ", ".$nameCat."DesignPattern ".$acronym;
                    if($cond != ""){
                        $cond .= " AND ";
                    }
                    $cond .= "(dp.idDesignPattern = ".$acronym.".idDesignPattern AND (";
                    for($i = 0; $i < count($var) - 2; $i++){
                        $cond .= "(".$acronym.".id".$nameCat." = ".$var[$i].")";
                        $cond .= " OR ";
                    }
                    $cond .= "(".$acronym.".id".$nameCat." = ".$var[$i].")";
                    $cond .= "))";
                }
            }
        }
    }
}
