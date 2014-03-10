<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDisplayDesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Solution.php");

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
            echo "<article>";
            ToolKitDisplay::displayGenericBox("DesignPattern", Database::getAllData("SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.date, dp.login FROM DesignPattern dp, ConflictDesignPattern c WHERE dp.idDesignPattern = c.idDesignPattern AND c.idConflict = ".$conflict->getID().";"));
            echo "</article>";
            
            echo "<article>";
            ToolKitDisplay::displayGenericBox("Solution", Database::getAllData("SELECT DISTINCT s.idSolution, s.name, s.comment, s.rate, s.nbRates, s.nbComments, s.date, s.login FROM Solution s WHERE s.idConflict = ".$conflict->getID().";"));
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
            echo "<article>";
            echo "<h2>Conflict :</h2>";
            $reponse = Database::getAllData("SELECT c.idConflict, c.name, c.date, c.login FROM Conflict c, ConflictDesignPattern cdp WHERE cdp.idDesignPattern = ".$id." AND c.idConflict = cdp.idConflict ;");
            foreach($reponse as $row){
                echo "<div>";
                echo "<a href=\"details.php?type=Conflict&id=".$row['idConflict']."\">".$row['name']."</a><br>";
                echo "Signalé le ".$row['date']." par ".$row['login']."<br>";
                $data = Database::getOneData("SELECT COUNT(*) as nb FROM Solution WHERE idconflict = ".$row['idConflict']);
                $dataCom = Database::getOneData("SELECT COUNT(*) as nb FROM CommentConflict WHERE idConflict = ".$row['idConflict']);
                echo "".$data['nb']." solutions | ".$dataCom['nb']." coms<br>";
                echo "</div>";
            }
            echo "</article>";
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