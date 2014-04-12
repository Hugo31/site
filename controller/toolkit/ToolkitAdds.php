<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");

class ToolKitAdds {
    
    public static function displayDesignPatternMini($id){
        echo '<div id="miniDP">';
        
        $donnees = Database::getOneData('SELECT * FROM DesignPattern WHERE idDesignPattern = '.$id.'');
        
        echo $donnees['name'];
        echo ' | '.$donnees['what'];
        echo '</div>';

    }
    
    public static function displayConflictMini($id){
        echo '<div id="miniConflict">';
        
        $donnees = Database::getOneData('SELECT * FROM Conflict WHERE idConflict = '.$id.'');
        
        echo $donnees['name'];
        echo ' | '.$donnees['description'];
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
    
    public static function displayReportMini($id, $type){
        echo '<div id="miniConflict">';
        echo '<b>'.$type.'</b> - ';
        $data = Database::getOneData("SELECT name FROM ".$type." WHERE id".$type." = \"".$id."\";");
        echo "<a href=\"details.php?type=".$type."&id=".$id."\">".$data['name']."</a>";
        
        echo '<input type="button" id="deleteR" class="add" value="Delete Reports" style="float:right;" onclick="deleteReport('.$id.', \''.$type.'\')"/>';
        echo '<input type="button" id="deleteO" class="add" value="Delete '.$type.'" style="float:right;" onclick="deleteReportedObject('.$id.', \''.$type.'\')"/>';

        echo '</br> Reported by : </br>';
        
        $bdd = Database::getConnection();
        $sql = "SELECT login, message FROM `reporting` WHERE idReported = \"".$id."\" AND typeReported = \"".$type."\";";
        $result = $bdd->query($sql);
        echo '<div style="padding-left:5em;">';
        $count = 0;
        foreach($result as $row){
            echo $row[0];
            echo '<a href="#" onclick="return showblock(this,'.$count.')" style="text-decoration:none;" >[+]</a>';
            echo '<p hidden>'.$row[1].'</p></br>';
            $count++;
        }
        echo '</div>';
        
        
        echo '</div>';

    }
}
    
