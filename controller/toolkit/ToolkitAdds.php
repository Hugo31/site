<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");




class ToolKitAdds {
    
    public static function displayDesignPatternMini($id){
        echo '<div id="dDP">';
        echo 'DP number '.$id;
        echo ' | Last update: date | Author: autor | Used: 0 times ';
        echo '</div>';

    }
    
    public static function displayConflictMini($id){
        echo '<div id="dDP">';
        echo 'Conflict number '.$id;
        echo ' | Date of reporting: date | Author: autor | Used: 0 times | 0 DP in conflict';
        echo '</div>';

    }
    
    public static function displayCriteriaAddDP($name){
        echo '<div style="display: block;">';
        $bdd = Database::getConnection();
        $sql = " SELECT id".$name.", name FROM ".$name;
        $result = $bdd->query($sql);
        if($result->rowCount() != 0){
            echo '<a href="#" onclick="return showblock(this)" style="text-decoration:none;" >[+]</a>'.$name;
            echo '<p hidden style="padding-left: 130px;">';
            foreach($result as $row){
                echo '<input type="checkbox" name="'.$name.'DP[]" value='.$row[0].'>'.$row[1].'</br>';
            }
            echo '</p>';
        }
        else{
            echo 'No '.$name.' found';
        }
        echo '</div>';
    }
}
    
