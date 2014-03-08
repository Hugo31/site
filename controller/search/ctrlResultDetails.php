<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/conflict/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/solution/Solution.php");
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
    }
    else{
        if($_POST['table'] == "Conflict"){
            $cf = Conflict::getDB($_POST['id']);
            
        }
        else{
            if($_POST['table'] == "Solution"){
                $st = Solution::getDB($_POST['id']);
                $resDp = $st->getCodeSolution();
                if(!empty($resDp)){
                    echo "<br/><div><h3>Code of solution: </h3>".$resDp."</div>"; 
                }
            }
        }
    }
        
}
?>