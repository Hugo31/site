<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>
<section id="contenu">
    <?php
    
    ?>
    <h1> Comments </h1>
    
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/site/controller/commentAafficher.php');  
    ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>