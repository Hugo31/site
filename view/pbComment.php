<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>
<section id="contenu">
    <?php

    echo "<h1> Signal a problem on this comment</h1>";
    
    
        if (isset($session->login) && isset($_POST['table']) && isset($_POST['id'])) {
            echo "<form action=\"/site/controller/addReport.php\" method=\"post\">";
            echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"".$_POST['id']."\"/>";
            echo "<input type=\"hidden\" id=\"type\" name=\"type\" value=\"Comment".$_POST['table']."\"/>";
            echo "<input type=\"hidden\" id=\"name\" name=\"name\" value=\"null\"/>";
            echo "<br/><center><table><tr><td style=\"vertical-align:top\"><label for=\"repportMessage\">Description:</label></td><td><textarea id=\"repportMessage\" name=\"repportMessage\" onkeyup=\"limite(this,500);\" 
                                onkeydown=\"limite(this,500);\" style=\"min-width:400px;max-width:500px;min-height:100px;max-height:400px\" required></textarea><br/><span id=\"max_desc\">500</span> remaining characters</td></tr></table>";
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