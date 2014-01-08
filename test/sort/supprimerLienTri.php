<?php
    header('Location: ../pagetestsort.php'); 
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/SortTable.php");
    if(isset($_POST['triTable'])){
        $chaine = explode("-", $_POST['triTable']);
        $st = SortTable::getDB($chaine[1], ESortTable::getValueEnum($chaine[0]));
        $dp = DesignPattern::getDB($chaine[2]);

        SortTable::removeLink($dp, $st);
    }
?>
