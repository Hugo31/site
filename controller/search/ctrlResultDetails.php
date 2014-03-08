<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/conflict/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/solution/Solution.php");
if(isset($_POST['table']) && isset($_POST['id'])){
    if($_POST['table'] == "DesignPattern"){
        $dp = DesignPattern::getDB($_POST['id']);

        if (!empty($dp->getWhenAndHow())) {
            echo "<br/><div><h3>When and How: </h3>".$dp->getWhenAndHow()."</div>";        
        }
        
        if (!empty($dp->getLayout())) {
            echo "<br/><div><h3>Layout: </h3>".$dp->getLayout()."</div>";        
        }
        
        if (!empty($dp->getCopy())) {
            echo "<br/><div><h3>Copy: </h3>".$dp->getCopy()."</div>";     
        }
        if (!empty($dp->getImplementation())) {
            echo "<br/><div><h3>Implementation: </h3>".$dp->getImplementation()."</div><br/>"; 
        }
    }
    else{
        if($_POST['table'] == "Conflict"){
            $cf = Conflict::getDB($_POST['id']);
            
        }
        else{
            if($_POST['table'] == "Solution"){
                $st = Solution::getDB($_POST['id']);
                if(!empty($st->getCodeSolution())){
                    echo "<br/><div><h3>Code of solution: </h3>".$st->getCodeSolution()."</div>"; 
                }
            }
        }
    }
        
}
?>