<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
if(isset($_POST['table']) && isset($_POST['id'])){
    $dp = DesignPattern::getDB($_POST['id']);

    $res = $dp->getWhenAndHow();
    if (!empty($res)) {
        echo "<br/><div><h3>When and How: </h3>".$res."</div>";        
    }
    $res = $dp->getLayout();
    if (!empty($res)) {
        echo "<br/><div><h3>Layout: </h3>".$res."</div>";        
    }
    $res = $dp->getCopy();
    if (!empty($res)) {
        echo "<br/><div><h3>Copy: </h3>".$res."</div>";     
    }
    $res = $dp->getImplementation();
    if (!empty($res)) {
        echo "<br/><div><h3>Implementation: </h3>".$res."</div><br/>"; 
    }
}
?>