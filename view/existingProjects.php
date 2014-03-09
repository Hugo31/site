<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitProject.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDisplay.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');      
?>

<section id="contenu">
    <h1> Existing Projects </h1>
    <?php
        $bdd = Database::getConnection();
        $session->query = ToolKitProject::searchAllProjects();
        $result = $bdd->query($session->query);

        ToolKitDisplay::displayExistingProjects($result);
    ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>