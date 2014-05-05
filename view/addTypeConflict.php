<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>
<section id="contenu">
    <?php

    echo "<h1> Add a new conflict type</h1>";
        echo "<font style=\"color:#FF4C00\">* Required fields.</font><br/><br/>";
        if (isset($session->login)) {
            echo "<form action=\"/site/controller/addConflictType.php\" method=\"post\">";
            echo "<br/><center><table>";
            echo "<tr><td><label for=\"name\">Name: <font color=\"#FF4C00\"\">*</font></label></td><td><input id=\"name\" type=\"text\" name=\"name\" size=\"40\" required autofocus></td></tr>";
            echo "<tr><td style=\"vertical-align:top\"><label for=\"description\">Description:</label></td><td><textarea id=\"description\" name=\"description\" onkeyup=\"limite(this,500);\" 
                                onkeydown=\"limite(this,500);\" style=\"min-width:400px;max-width:500px;min-height:100px;max-height:400px\"></textarea><br/><span id=\"max_desc\">500</span> remaining characters</td></tr></table>";
            echo "<br/><br/><input type=\"submit\" class=\"send\" value=\"Save it\"/></center>";
            echo"</form>";
        } else {
            header('Location: 404.php');
        }
    ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>