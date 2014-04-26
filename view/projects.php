<?php

    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');   
?>
<section id="contenu">
    <h1> My projects </h1>
    
    <br><br>
    <?php
        if (!isset($session->login)) {
           echo '<center><h3>You must be connected in order to use this page</h3></center>'; 
        } else {
            $bdd = Database::getConnection();
            
            $result = $bdd->query("SELECT DISTINCT p.idProject, p.name, p.description, p.date, p.login FROM Project p WHERE p.login = \"".$session->login."\";");
            
            ToolKitDisplay::displayGenericBox("Project", $result);
        }
        
    ?>
    
</section>
<script>
    $("details").hide();
</script>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');   
?>
