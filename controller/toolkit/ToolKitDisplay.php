<?php

class ToolKitDisplay {
    
    public static function displayCheckBoxCriteria($criteria, $dataToDisplay){
        foreach($dataToDisplay as $row){
            echo "<input type=\"checkbox\" name=\"".$criteria.$row["id"]."\" value=\"".$row["id"]."\">".$row["name"]."<br>";
        }
    }
}
