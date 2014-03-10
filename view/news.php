<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');      
?>

<section id="contenu">
    <h1> News </h1>
    
    <?php
        $bdd = Database::getConnection();
        //$session->query = ToolKitProject::searchAllProjects();
        //$result = $bdd->query($session->query);

        //ToolKitDisplay::displayExistingProjects($result);
    ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>