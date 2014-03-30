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
}
    
