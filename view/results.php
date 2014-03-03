<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();

?>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');   
?>
<section id="contenu">
    <h1> Results </h1>
    <?php
        $bdd = Database::getConnection();
        $result = $bdd->query($session->query);

        ToolKitDisplay::displayGenericBox($session->typeQuery, $result);
    ?>
    
</section>
<script>
    $("details").hide();
</script>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');   
?>
