<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>

<script language='javascript'>
function affichIcon() {
    if(document.getElementById('searchcriteria').value == "Category") {
        document.getElementById("Category").style.display = "inline";
        document.getElementById("person").style.display = "inline";
        document.getElementById("nom").style.display = "inline";
    }
}
</script>
<section id="contenu">
    <?php

    echo "<h1> Add a new search criteria</h1>";
        echo "<font style=\"color:#FF4C00\">* Required fields.</font><br/><br/>";
        if (isset($session->login)) {
            echo "<form action=\"/site/controller/addSearchCriteria.php\" method=\"post\">";
            echo "<br/><center><table>";
            echo "<tr>
                    <td><label for=\"searchcriteria\">Criteria type: <font color=\"#FC40000\">*</font></label></td>
                    <td>
                        <select id=\"searchcriteria\" name=\"searchcriteria\" onchange=\"affichIcon()\" required>
                            <option selected disabled hidden>Choose</option>
                            <option value=\"Category\">Category</option>
                            <option value=\"Component\">Component</option>
                            <option value=\"Platform\">Platform</option>
                            <option value=\"Property\">Property</option>
                            <option value=\"System\">System</option>
                        </select> 
                    </td></tr>";
            echo "<tr><td><label for=\"name\">Name: <font color=\"#FF4C00\"\">*</font></label></td><td><input id=\"name\" type=\"text\" name=\"name\" size=\"40\" required autofocus></td></tr>";
            echo "<tr><td style=\"vertical-align:top\"><label for=\"description\">Description:</label></td><td><textarea id=\"description\" name=\"description\" onkeyup=\"limite(this,100);\" 
                                onkeydown=\"limite(this,100);\" style=\"min-width:400px;max-width:500px;min-height:100px;max-height:400px\"></textarea><br/><span id=\"max_desc\">100</span> remaining characters</td></tr>";
            echo "<tr><td style=\"vertical-align:top\"><label for=\"icon\">Icon: </td><td><input type=\"file\" id=\"icon\" name=\"icon\" size=\"40\"><br/>Just for criterias: platform, system.</td></tr></table>";
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