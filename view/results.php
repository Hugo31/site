<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();

?>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');   
?>
<section id="contenu">
    <?php
        $bdd = Database::getConnection();
        echo $session->query."<br>";
        $result = $bdd->query($session->query);


        ToolKitDisplay::displayGenericBox($session->typeQuery, $result);
    ?>
    
</section>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');   
?>
