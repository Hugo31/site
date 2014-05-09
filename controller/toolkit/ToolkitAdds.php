<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();

class ToolKitAdds {
    
    public static function displayDesignPatternMini($id) {
        echo '<div id="miniDP">';
        
        $donnees = Database::getOneData('SELECT * FROM DesignPattern WHERE idDesignPattern = '.$id.'');
        
        echo $donnees['name'];
        echo ' | '.$donnees['what'];
        echo '</div>';

    }
    
    public static function displayConflictMini($id) {
        echo '<div id="miniConflict">';
        
        $donnees = Database::getOneData('SELECT * FROM Conflict WHERE idConflict = '.$id.'');
        
        echo $donnees['name'];
        echo ' | '.$donnees['description'];
        echo '</div>';

    }
    
    public static function displayCriteriaAddDP($name) {
        echo '<div style="display: block;">';
        $bdd = Database::getConnection();
        $sql = " SELECT id".$name.", name FROM ".$name;
        $result = $bdd->query($sql);
        if ($result->rowCount() != 0) {
            echo '<a href="#" onclick="return showblock(this)" style="text-decoration:none;" >[+]</a>'.$name;
            echo '<p hidden style="padding-left: 130px;">';
            foreach ($result as $row) {
                echo '<input type="checkbox" name="'.$name.'DP[]" value='.$row[0].'>'.$row[1].'</br>';
            }
            echo '</p>';
        } else {
            echo 'No '.$name.' found';
        }
        echo '</div>';
    }
    
    public static function displayReportMini($id, $type) {
        echo '<div id="miniConflict">';
        echo '<b>'.$type.'</b> - ';
        $data = Database::getOneData("SELECT name FROM ".$type." WHERE id".$type." = \"".$id."\";");
        echo "<a href=\"details.php?type=".$type."&id=".$id."\">".$data['name']."</a>";
        
        echo '<input type="button" id="deleteR" class="add" value="Delete Reports" style="float:right;" onclick="deleteReport('.$id.', \''.$type.'\')"/>';
        echo '<input type="button" id="deleteO" class="add" value="Delete '.$type.'" style="float:right;" onclick="deleteReportedObject('.$id.', \''.$type.'\')"/>';

        echo '</br> Reported by : </br>';
        
        $bdd = Database::getConnection();
        $sql = "SELECT login, message,date FROM `reporting` WHERE idReported = \"".$id."\" AND typeReported = \"".$type."\";";
        $result = $bdd->query($sql);
        echo '<div style="padding-left:5em;">';
        $count = 0;
        foreach ($result as $row) {
            echo "> ".$row[0]." - ".$row[2]."&nbsp;&nbsp;";
            echo '<a href="#" onclick="return showblock(this,'.$count.')" style="text-decoration:none;" >[+]</a>';
            echo '<p hidden>'.$row[1].'</p></br>';
            $count++;
        }
        echo '</div>';
        
        
        echo '</div>';

    }
    
    public static function displayReportCommentMini($id, $type) {
        echo '<div id="miniConflict">';
        echo '<b>'.$type.'</b> - ';
        echo "<a href=\"/site/view/commentDetails.php?table=".$type."&id=".$id."\">Voir le commentaire</a>";
        
        echo '<input type="button" id="deleteR" class="add" value="Delete Reports" style="float:right;" onclick="deleteReport('.$id.', \''.$type.'\')"/>';
        echo '<input type="button" id="deleteO" class="add" value="Delete '.$type.'" style="float:right;" onclick="deleteReportedObject('.$id.', \''.$type.'\')"/>';

        echo '</br> Reported by : </br>';
        
        $bdd = Database::getConnection();
        $sql = "SELECT login, message,date FROM `reporting` WHERE idReported = \"".$id."\" AND typeReported = \"".$type."\";";
        $result = $bdd->query($sql);
        echo '<div style="padding-left:5em;">';
        $count = 0;
        foreach ($result as $row) {
            echo "> ".$row[0]." - ".$row[2]."&nbsp;&nbsp;";
            echo '<a href="#" onclick="return showblock(this,'.$count.')" style="text-decoration:none;" >[+]</a>';
            echo '<p hidden>'.$row[1].'</p></br>';
            $count++;
        }
        echo '</div>';  
        
        echo '</div>';
    }
    
    public static function displayCriteriaBox($user) {
        $reponse = Database::getAllData("SELECT * FROM Category WHERE login = \"" . $user . "\";");
        if ($reponse->rowCount() != 0) {
            echo "<h3 style=\"margin:0 auto;\">> Category</h3>";
            echo "<ul style=\"margin-bottom:10px\">";
            foreach ($reponse as $row) {
                echo "<li style=\"color:black\">".$row['name'];
                if ($row['description'] != "") {
                    echo " : ".$row['description'];
                }
                echo "</li>";
            }
            echo "</ul>";
        }
        $reponse = Database::getAllData("SELECT * FROM Component WHERE login = \"" . $user . "\";");
        if ($reponse->rowCount() != 0) {
            echo "<h3 style=\"margin:0 auto;\">> Component</h3>";
            echo "<ul style=\"margin-bottom:10px\">";
            foreach ($reponse as $row) {
                echo "<li style=\"color:black\">".$row['name'];
                if ($row['description'] != "") {
                    echo " : ".$row['description'];
                }
                echo "</li>";
            }
            echo "</ul>";
        }
        $reponse = Database::getAllData("SELECT * FROM Platform WHERE login = \"" . $user . "\";");
        if ($reponse->rowCount() != 0) {
            echo "<h3 style=\"margin:0 auto;\">> Platform</h3>";
            echo "<ul style=\"margin-bottom:10px\">";
            foreach ($reponse as $row) {
                echo "<li style=\"color:black\">".$row['name'];
                if ($row['description'] != "") {
                    echo " : ".$row['description'];
                }
                echo "</li>";
            }
            echo "</ul>";
        }
        $reponse = Database::getAllData("SELECT * FROM Property WHERE login = \"" . $user . "\";");
        if ($reponse->rowCount() != 0) {
            echo "<h3 style=\"margin:0 auto;\">> Property</h3>";
            echo "<ul style=\"margin-bottom:10px\">";
            foreach ($reponse as $row) {
                echo "<li style=\"color:black\">".$row['name'];
                if ($row['description'] != "") {
                    echo " : ".$row['description'];
                }
                echo "</li>";
            }
            echo "</ul>";
        }
        $reponse = Database::getAllData("SELECT * FROM System WHERE login = \"" . $user . "\";");
        if ($reponse->rowCount() != 0) {
            echo "<h3 style=\"margin:0 auto;\">> System</h3>";
            echo "<ul style=\"margin-bottom:10px\">";
            foreach ($reponse as $row) {
                echo "<li style=\"color:black\">".$row['name'];
                if ($row['description'] != "") {
                    echo " : ".$row['description'];
                }
                echo "</li>";
            }
            echo "</ul>";
        }
    }
}
    
