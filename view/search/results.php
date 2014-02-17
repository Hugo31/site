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
        <!--include header-->
        <!--include nav-->
        <?php
            include($_SERVER['DOCUMENT_ROOT']."/site/view/search/viewSearch.php");
        ?>
        
        
        <?php
            $result = $bdd->query($session->query);
            foreach($result as $row){
                echo "NOM : ".$row['name'];
            }
            
            ToolKitDisplay::displayGenericBox("Design Pattern", $result);
        ?>
        <!--include footer-->
    </body>
</html>
