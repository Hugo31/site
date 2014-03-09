<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
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
    
    public static function displayImages($id){
        $reponse = Database::getAllData("SELECT link FROM ImageDesignPattern WHERE idDesignPattern = ".$id.";");
        foreach($reponse as $row){
            echo "<img src=\"".$row['link']."\", alt=\"img design\"/>";
        }
        $reponse->closeCursor();
    }
    
    public static function displaySources($id){
        $reponse = Database::getAllData("SELECT link FROM Source WHERE idDesignPattern = ".$id.";");
        foreach($reponse as $row){
            echo "<a>".$row['link']."</a>";
        }
        $reponse->closeCursor();
    }
    
    public static function displayCriteria($id){
        echo "<article>";
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "Category");
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "Component");
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "Platform");
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "Property"); // A changer car rate dans property
        ToolkitDisplayDesignPattern::displayOneCriterion($id, "System");
        echo "</article>";
    }
    
    public static function displayOneCriterion($id, $name){
        $reponse = Database::getAllData("SELECT n.name FROM ".$name."DesignPattern nDP, ".$name." n WHERE nDP.id".$name." = n.id".$name." AND idDesignPattern = ".$id.";");
        echo "<div><h3>".$name."</h3>";
        foreach($reponse as $row){
            echo "> ".$row['name'];
        }
        echo "</div>";
        $reponse->closeCursor();
    }
    
    
}
