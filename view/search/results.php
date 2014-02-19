<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDisplay.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
$session = Session::getInstance();
$bdd = Database::getConnection();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/site/javascript/toolkit.js"></script>
        <!--include header-->
        <!--include nav-->
        <?php
            include($_SERVER['DOCUMENT_ROOT']."/site/view/search/viewSearch.php");
        ?>
        
        
        <?php
            echo $session->query."<br>";
            $result = $bdd->query($session->query);
            foreach($result as $row){
                echo "NOM : ".$row['name']."<br>";
            }
            
            ToolKitDisplay::displayGenericBox("Design Pattern", $result);
        ?>
        <!--include footer-->
    </body>
</html>
