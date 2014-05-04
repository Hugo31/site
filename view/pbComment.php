<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>
<section id="contenu">
    <?php
    
    ?>
    <h1> Signal a problem </h1>
    
    <?php
        if (isset($_POST['table']) && isset($_POST['id'])) {
            echo "<form action=\"/site/controller/addPbComment.php\" method=\"post\">";
            echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"".$_POST['id']."\"/>";
            echo "<input type=\"hidden\" id=\"table\" name=\"table\" value=\"".$_POST['table']."\"/>";
            echo "<br/><center><table><tr><td><label for=\"name\">Name: </label></td><td><input name=\"name_project\" id=\"name\" type=\"text\" autofocus required/></td></tr>";
            echo "<tr><td style=\"vertical-align:top\"><label for=\"description\">Description:</label></td><td><textarea id=\"description\" name=\"desc_project\" onkeyup=\"limite(this,500);\" 
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