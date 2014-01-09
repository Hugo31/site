<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
    if(isset($_POST['triTable']) and isset($_POST['designPattern'])){
        
        $st = SortTable::getDB($_POST['triTable']);
        $dp = DesignPattern::getDB($_POST['designPattern']);
        SortTable::addLink($dp, $st);
    }
    
?>