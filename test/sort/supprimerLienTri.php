<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
    if(isset($_POST['triTable']) and isset($_POST['designPattern'])){
        $chaine = explode("-", $_POST['triTable']);
        
        $st = SortTable::getDB($chaine[1], ESortTable::getValueEnum($chaine[0]));
        $dp = DesignPattern::getDB($_POST['designPattern']);
        SortTable::removeLink($dp, $st);
    }
?>
