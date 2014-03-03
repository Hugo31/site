<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
if(isset($_POST['table']) && isset($_POST['id'])){
    $dp = DesignPattern::getDB($_POST['id']);
    
    echo "<div>".$dp->getWhenAndHow()."</div>";
    echo "<div>".$dp->getLayout()."</div>";
    echo "<div>".$dp->getCopy()."</div>";
    echo "<div>".$dp->getImplementation()."</div>"; 
}
?>