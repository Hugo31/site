<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');      
?>

<section id="contenu">
    <?php
    
    ?>
    <h1> News </h1>
    
    <?php
        $bdd = Database::getConnection();
        $session->typeQuery = "DesignPattern";
        
        echo "<h2 style=\"margin:0 auto;\">Most recent</h2><hr>";
        $reponse = Database::getAllData("SELECT * FROM DesignPattern ORDER BY date DESC LIMIT 0, 3");     
        ToolKitDisplay::displayGenericBox($session->typeQuery, $reponse);
        
        echo "<br/><h2 style=\"margin:0 auto;\">Most popular</h2><hr>";
        $reponse = Database::getAllData("SELECT * FROM DesignPattern ORDER BY nbUsage DESC LIMIT 0, 3");    
        ToolKitDisplay::displayGenericBox($session->typeQuery, $reponse);
        
        echo "<br><h2 style=\"margin:0 auto;\">Most rated</h2><hr>";
        $reponse = Database::getAllData("SELECT * FROM DesignPattern ORDER BY rate DESC LIMIT 0, 3");
        ToolKitDisplay::displayGenericBox($session->typeQuery, $reponse);
    ?>
</section>
<script>
    $("details").hide();
</script>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>