<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDisplayDesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Project.php");

class ToolkitDetails {
    public static function displayDetailsConflict($id){
        $conflict = Conflict::getDB($id);
        if($conflict != false){
            echo "<article>";
            echo "<h1>".$conflict->getName()."</h1>";
            echo "<article id=\"h3Details\">";
            echo "<table>";
            echo "<tr><td style=\"width:100px\"><h3>Date:</h3></td><td>".$conflict->getDate()."</td></tr>";
            echo "<tr><td><h3>Author:</h3></td><td>".$conflict->getLogin()."</td></tr>";
            echo "<tr><td><h3>Conflict type:</h3></td><td>".$conflict->getType()." times</td></tr>";
            $rqtNb = Database::getOneData("SELECT COUNT(*) as nb FROM DesignPattern dp, ConflictDesignPattern cdp "
                            ."WHERE cdp.idConflict=".$id." AND dp.idDesignPattern = cdp.idDesignPattern;");
            $nombre = $rqtNb['nb'];
            echo "<tr><td valign=\"top\"><h3>".$nombre." DP in conflict:</h3></td><td>";
            ToolKitDisplay::displayDPConflict($id, $nombre);
            echo "</td></tr></table><br/>";
            echo "<img src=\"../img/vrac/propose.png\" style=\"vertical-align:bottom;width:20px\"/>  <a href=\"/site/controller/proposeSol.php?id=".$id."\"><h3>Propose a solution</h3></a><br/><br/>";
            
            ToolKitDisplay::displayText("Description: ", $conflict->getDescription());
            echo "</article>";
                        
            echo "<h2 id=\"h2CommentsConflict\">Solutions</h2><hr/>";
            ToolKitDisplay::displayGenericBox("Solution", Database::getAllData("SELECT DISTINCT s.idSolution, s.name, s.comment, s.rate, s.nbRates, s.nbComments, s.date, s.login FROM Solution s WHERE s.idConflict = ".$conflict->getID().";"));
            
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
            echo "<h1>".$dp->getName()."</h1><br/>";
            echo "<div id=\"contentDP\">";
            echo "<div id=\"contenuHautDP\">";
            echo "<div id=\"contenuGaucheDP\">";
            echo "<table>";
            echo "<tr><td><h3>Date:</h3></td><td>".$dp->getDate()."</td></tr>";
            echo "<tr><td><h3>Author:</h3></td><td>".$dp->getLogin()."</td></tr>";
            echo "<tr><td><h3>Used:</h3></td><td>".$dp->getNbUsage()." times</td></tr>";
            echo "<tr><td><h3>For:</h3></td><td>".$dp->getTarget()."</td></tr>";
            echo "<tr><td><h3>Sources:</h3></td><td>";
            echo "</td></tr></table>";
            ToolkitDisplayDesignPattern::displaySources($id);         
            echo "</div>";
            echo "<div id=\"contenuDroitDP\">";
            ToolkitDisplay::displayRate($id, $dp->getNbRates(), $dp->getRate(), "DesignPattern");
            echo "</div>";
            echo "</div>";
            echo "<div id=\"addProposeDP\">";
            echo "<img src=\"../img/vrac/add.png\" style=\"vertical-align:bottom;width:20px\"/>  <a href=\"/site/controller/addCart.php?id=".$id."\"><h3>Add to my current Design Pattern</h3></a>";
            echo " | <img src=\"../img/vrac/propose.png\" style=\"vertical-align:bottom;width:20px\"/>  <a href=\"/site/view/addConflict.php?id=".$id."\"><h3>Report a conflict</h3></a>";   
            echo "</div><br/><br/>";
            echo "<article id=\"contenuCommentsDP\">";
            ToolKitDisplay::displayText("What : ", $dp->getWhat());
            ToolKitDisplay::displayText("When and How : ", $dp->getWhenAndHow());
            ToolKitDisplay::displayText("Layout : ", $dp->getLayout());
            ToolKitDisplay::displayText("Copy : ", $dp->getCopy());
            ToolKitDisplay::displayText("Implementation : ", $dp->getImplementation());      
            
            ToolkitDisplayDesignPattern::displayImages($id);
            ToolkitDisplay::displayCommentsLittles($id, $dp->getNbComments(), "DesignPattern");
            echo "</article>";
            
            echo "</div>";

            echo "<aside id=\"asideCategorieConflictDP\">";
            ToolkitDisplayDesignPattern::displayCriteria($id);
            echo "<article>";
            $data = Database::getOneData("SELECT COUNT(*) as nb FROM ConflictDesignPattern WHERE idDesignPattern=".$id.";");
            
            if ($data['nb'] != 0) {
                echo "<a href=\"\"><h2>Conflicts (".$data['nb']."):</h2></a>";
                $reponse = Database::getAllData("SELECT c.idConflict, c.name, c.date, c.login FROM Conflict c, ConflictDesignPattern cdp WHERE cdp.idDesignPattern = ".$id." AND c.idConflict = cdp.idConflict ;");
                foreach($reponse as $row){
                    echo "<fieldset style=\"border: 1px solid #96A9B5;box-shadow: 0 1px 0 #FFFFFF;\"><h3><a href=\"details.php?type=Conflict&id=".$row['idConflict']."\">".$row['name']."</a></h3>";
                    echo "Signaled ".$row['date']." by <a href=\"\">".$row['login']."</a><br/>";
                    $data = Database::getOneData("SELECT COUNT(*) as nb FROM Solution WHERE idconflict = ".$row['idConflict']);
                    $dataCom = Database::getOneData("SELECT COUNT(*) as nb FROM CommentConflict WHERE idConflict = ".$row['idConflict']);
                    echo "<a href=\"\">".$data['nb']." solutions</a> | <a href=\"\">".$dataCom['nb']." coms</a><br/>";
                    echo "</fieldset>";
                }
            } else {
                echo "No conflict.";
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
            
            echo "<div id=\"contentSol\">";
            echo "<div id=\"contenuGaucheSol\">";
            echo "<table>";
            echo "<tr><td style=\"width:150px\"><h3>Date:</h3></td><td>".$solution->getDate()."</td></tr>";
            echo "<tr><td><h3>Author:</h3></td><td>".$solution->getLogin()."</td></tr>";
            $data = Database::getOneData("SELECT c.idConflict, c.name FROM Solution s, Conflict c WHERE s.idSolution=".$id." and c.idConflict=s.idConflict;");
            echo "<tr><td valign=\"top\"><h3>Solution to the conflict:</h3></td><td><a href=\"details.php?type=Conflict&id=".$data['idConflict']."\">".$data['name']."</a></td></tr>";
            echo "</td></tr></table>";
            echo "</div>";
            echo "<div id=\"contenuDroitSol\">";
            ToolkitDisplay::displayRate($id, $solution->getNbRates(), $solution->getRate(), "Solution");
            echo "</div>";
            echo "</div>";
            
            ToolKitDisplay::displayText("Comment : ", $solution->getComment());
            ToolKitDisplay::displayText("Code for solution : ", $solution->getCodeSolution());                       
            echo "<div id=\"textDisplay\">";
            $reponse = Database::getAllData("SELECT DISTINCT s.idSolution, s.name, s.date, s.rate, s.nbComments, s.nbRates, s.login FROM Solution s WHERE idConflict = ".$solution->getIDConflict()." AND idSolution != ".$id);
            echo "<h3>Others Solutions :</h3>";
            echo "<ul>";
            foreach($reponse as $row){
                echo "<li>";
                echo "<a href=\"details.php?type=Solution&id=".$row['idSolution']."\">".$row['name']."</a><br/>";
                echo "Posted the ".$row['date']." by ".$row['login']."<br/>";
                echo "".$row['nbComments']." coms | ".$row['nbRates']." rates | ".$row['rate']."/5";
                echo "</li>";
            }
            echo "</ul>";
            echo "</div>";
            
            ToolkitDisplay::displayCommentsLittles($id, $solution->getNbComments(), "Solution");

            echo "</article>";
        }
        else{
            echo "Error 404 !!";
        }
    }
    
    public static function displayDetailsProject($id){
        $project = Project::getDB($id);
        if($project != false){
            echo "<article>";
            echo "<h1>".$project->getName()."</h1>";
            
            echo "<article id=\"h3Details\">";
            echo "<table>";
            echo "<tr><td><h3>Date:</h3></td><td>".$project->getDate()."</td></tr>";
            echo "<tr><td><h3>Author:</h3></td><td>".$project->getLogin()."</td></tr>";
            echo "</td></tr></table><br/>";            
            echo "</article>";
            ToolKitDisplay::displayText("Description : ", $project->getDescription());
            
            ToolKitDisplay::displayDesignPatternBox(Database::getAllData("SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp, ProjectDesignPattern pdp WHERE pdp.idProject = ".$project->getID()." AND pdp.idDesignPattern = dp.idDesignPattern;"));            
            echo "</article>";
        }
        else{
            echo "Error 404 !!";
        }
    }
}

?>
