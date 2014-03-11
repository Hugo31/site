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
        echo "<h2>Most recent</h2><hr>";
        $reponse = Database::getAllData("SELECT * FROM DesignPattern ORDER BY date DESC LIMIT 0, 3");
        $session->typeQuery = "DesignPattern";
        ToolKitDisplay::displayGenericBox("DesignPattern", $reponse);
        echo "<br><h2>Most popular</h2><hr>";
        $reponse = Database::getAllData("SELECT * FROM DesignPattern ORDER BY nbUsage LIMIT 0, 3");
        
        ToolKitDisplay::displayGenericBox("DesignPattern", $reponse);
        
        $reponse = Database::getAllData("SELECT * FROM DesignPattern ORDER BY rate LIMIT 0, 3");
        echo "<br><h2>Most rated</h2><hr>";
        ToolKitDisplay::displayGenericBox("DesignPattern", $reponse);
        //$session->query = ToolKitProject::searchAllProjects();
        //$result = $bdd->query($session->query);

        //ToolKitDisplay::displayExistingProjects($result);
    ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>