<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Project.php");
if(isset($_POST['table']) && isset($_POST['id'])){
    if($_POST['table'] == "DesignPattern"){
        $dp = DesignPattern::getDB($_POST['id']);
        $resDP = $dp->getWhenAndHow();
        if (!empty($resDP)) {
            echo "<br/><div><h3>When and How: </h3>".$resDP."</div>";        
        }
        $resDP = $dp->getLayout();
        if (!empty($resDP)) {
            echo "<br/><div><h3>Layout: </h3>".$resDP."</div>";        
        }
        $resDP = $dp->getCopy();
        if (!empty($resDP)) {
            echo "<br/><div><h3>Copy: </h3>".$resDP."</div>";     
        }
        $resDP = $dp->getImplementation();
        if (!empty($resDP)) {
            echo "<br/><div><h3>Implementation: </h3>".$resDP."</div><br/>"; 
        }
        echo "<a href=\"details.php?type=DesignPattern&id=".$_POST['id']."\" style=\"float:right\">See really more</a><br/>";
    }
    else{
        if($_POST['table'] == "Conflict"){
            $cf = Conflict::getDB($_POST['id']);
            $resConflict = $cf->getDescription();
            if(!empty($resConflict)){
                echo "<br/><div><h3>Description: </h3>".$resConflict."</div>"; 
            }
        }
        else{
            if($_POST['table'] == "Solution"){
                $st = Solution::getDB($_POST['id']);
                $resSol = $st->getCodeSolution();
                if(!empty($resSol)){
                    echo "<br/><div><h3>Code of solution: </h3>".$resSol."</div>"; 
                }
                echo "<a href=\"details.php?type=Solution&id=".$_POST['id']."\" style=\"float:right\">See really more</a><br/>";                
            } 
            else {
                if($_POST['table'] == "Project"){
                    $pr = Project::getDB($_POST['id']);
                    $resPro = $pr->getDescription();
                    if(!empty($resPro)){
                        echo "<br/><div><h3>Description: </h3>".$resPro."</div>"; 
                    }
                }
            } 
        } 
        
    }
        
}
?>