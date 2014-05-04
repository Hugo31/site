<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ToolkitDisplayDesignPattern
 *
 * @author loic
 */
class ToolkitDisplayDesignPattern {
    
    public static function displayImages($id) {
        $reponse = Database::getAllData("SELECT link FROM ImageDesignPattern WHERE idDesignPattern = ".$id.";");
        echo "<table style=\"text-align:center\">";
        $i = 0;
        foreach ($reponse as $row) {
            if ($i == 0) {
                echo "<tr><td width=\"300px\"><img class=\"img_pattern\" width=\"250px\" src=\"".$row['link']."\" alt=\"img design\" style=\"border:1px solid #FF4C00;\"/></td>";
                $i++;
            } else {
                echo "<td width=\"300px\"><img class=\"img_pattern\" width=\"250px\" src=\"".$row['link']."\" alt=\"img design\" style=\"border:1px solid #FF4C00;\"/></td></tr>";
                $i = 0;
            } 
        }
        if ($i != 0) {
            echo "</tr>";
        }
        echo "</table>";
        $reponse->closeCursor();
    }
    
    public static function displaySources($id) {
        $reponse = Database::getAllData("SELECT link FROM Source WHERE idDesignPattern = ".$id.";");
        if ($reponse->rowCount() != 0) {
            echo '<ul>';
            foreach ($reponse as $row) {
                echo "<li><a href=\"".$row['link']."\" target='_blank'>".$row['link']."</a></li>";
            }
            echo '</ul>';
        } else {
            echo "<ul><li>Unsourced.</li></ul>";
        }
        $reponse->closeCursor();
    }
    
    public static function displayCriteria($id) {
        echo "<article>";
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "Category");
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "Component");
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "Platform");
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "Property"); // A changer car rate dans property
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "System");
        echo "</article>";
    }
    
    public static function displayOneCriterion($id, $name) {
        $reponse = Database::getAllData("SELECT n.name FROM ".$name."DesignPattern nDP, ".$name." n WHERE nDP.id".$name." = n.id".$name." AND idDesignPattern = ".$id.";");
        if ($reponse->rowCount() != 0) {
            echo "<fieldset style=\"border: 1px solid #96A9B5;box-shadow: 0 1px 0 #FFFFFF;\"><legend style=\"font-size: 1.3em;color:#FF4C00;\">".$name."</legend>";
            foreach ($reponse as $row) {
                echo "<font style=\"padding-left:10px\">> ".$row['name']."</font><br/>";
            }
            echo "</fieldset><br/>";
        }
        $reponse->closeCursor();
    }
    
}
