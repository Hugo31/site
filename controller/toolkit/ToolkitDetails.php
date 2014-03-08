<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDisplayDesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/conflict/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/solution/Solution.php");

class ToolkitDetails {
    public static function displayDetailsConflict($id){
        $conflict = Conflict::getDB($id);
        if($conflict != false){
            echo "<article>";
            echo "<h1>".$conflict->getName()."</h1>";
            echo "<article>";
            echo "Date : ".$conflict->getDate()."<br>Author : ".$conflict->getLogin()."<br>Type : ".$conflict->getType()."<br>";
            echo "</article>";
            echo "<article>";
            ToolKitDisplay::displayText("Description : ", $conflict->getDescription());
            
            echo "</article>";
            
            ToolkitDisplay::displayCommentsLittles($id, $conflict->getNbComments(), "Conflict");
            echo "</article>";
            
        }
        else{
            echo "Error 404 !!";
        }
    }
    
    public static function displayDetailsDesignPattern($id){
        $dp = DesignPattern::getDB($id);
        
        if($dp != false){
            echo "<article>";
            echo "<h1>".$dp->getName()."</h1>";
            echo "<article>";
            echo "Date : ".$dp->getDate()."<br>Author : ".$dp->getLogin()."<br>Used : ".$dp->getNbUsage()."<br>For : ".$dp->getTarget()."<br>";
            ToolkitDisplayDesignPattern::displaySources($id);
            ToolkitDisplay::displayRate($id, $dp->getNbRates(), $dp->getRate(), "DesignPattern");
            echo "</article>";
            echo "<article>";
            ToolKitDisplay::displayText("What : ", $dp->getWhat());
            ToolKitDisplay::displayText("When and How : ", $dp->getWhenAndHow());
            ToolKitDisplay::displayText("Layout : ", $dp->getLayout());
            ToolKitDisplay::displayText("Copy : ", $dp->getCopy());
            ToolKitDisplay::displayText("Implementation : ", $dp->getImplementation());
            
            echo "</article>";
            
            ToolkitDisplayDesignPattern::displayImages($id);
            ToolkitDisplay::displayCommentsLittles($id, $dp->getNbComments(), "DesignPattern");
            echo "</article>";
            
            echo "<aside>";
            ToolkitDisplayDesignPattern::displayCriteria($id);
            echo "</aside>";
            
        }
        else{
            echo "Error 404 !!";
        }
    }
    	
    public static function displayDetailsSolution($id){
        $solution = Solution::getDB($id);
        if($solution != false){
            echo "<article>";
            echo "<h1>".$solution->getName()."</h1>";
            echo "<article>";
            echo "Date : ".$solution->getDate()."<br>Author : ".$solution->getLogin()."<br>";
            ToolkitDisplay::displayRate($id, $solution->getNbRates(), $solution->getRate(), "Solution");
            echo "</article>";
            echo "<article>";
     
            ToolKitDisplay::displayConflictBox(Database::getAllData("SELECT * FROM Conflict WHERE idConflict = ".$solution->getIDConflict()));
            echo "</article>";
            
            echo "<article>";
            ToolKitDisplay::displayText("Comment : ", $solution->getComment());
            ToolKitDisplay::displayText("Code for solution : ", $solution->getCodeSolution());
            
            echo "</article>";
            
            ToolkitDisplay::displayCommentsLittles($id, $solution->getNbComments(), "Solution");
            echo "</article>";
            
            echo "<aside>";
            //Display other solution for that conflict
            echo "</aside>";
        }
        else{
            echo "Error 404 !!";
        }
    }
    
    public static function displayDetailsProject($id){
        
    }
}

?>