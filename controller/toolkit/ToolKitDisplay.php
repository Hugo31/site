<?php

class ToolKitDisplay {
    
    public static function displayCheckBoxCriteria($criteria, $dataToDisplay){
        $i = 0;
        foreach($dataToDisplay as $row){
            echo "<input type=\"checkbox\" name=\"id".$criteria.$i."\" value=\"".$row["id"]."\">".$row["name"]."<br>";
            $i++;
            
        }
    }
    
    public static function displayGenericBox(){
        
    }
}
