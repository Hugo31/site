<?php

    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');   
?>
<section id="contenu">
    <h1> Results </h1>
    <form id="sort_form">
        <label>Sort by : </label>
        <select name="typeSort">
            <option value="nothing">Name</option>
            <option value="date">Most recent</option>
            <?php
            if($session->typeQuery == "DesignPattern" || $session->typeQuery == "Solution"){ 
            ?>
            <option value="rate">Hightest rated</option>
            <?php
                if($session->typeQuery == "DesignPattern"){
            ?>
            <option value="nbUsage">Most popular</option>
            <?php
                }
            }
            ?>
            
            
        </select><br>
        
        <input type="submit" value="SORT" class="sort" style="float:left;"/>
    </form>
    <br><br>
    <?php
        $bdd = Database::getConnection();
        if(isset($_GET['typeSort'])){
            if($_GET['typeSort'] != "nothing"){
                $result = $bdd->query($session->query." ORDER BY ".$_GET['typeSort']." DESC");
            }
            else{
                $result = $bdd->query($session->query);
            }
            
        }
        else{
            $result = $bdd->query($session->query);
        }
        
        

        ToolKitDisplay::displayGenericBox($session->typeQuery, $result);
    ?>
    
</section>
<script>
    $("details").hide();
</script>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');   
?>
