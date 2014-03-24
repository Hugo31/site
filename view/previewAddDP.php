<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();
    
    
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 
    
    
?>

<section id="contenu">
    <?php
    if(!isset($session->login)){//si utilisateur non connecté
        echo '<h3>You must be connected in order to use this page</h3>';
    }
    else{
    ?>
    <h2> Preview </h2>
    
    <div id="previewAddDP">
        <?php
            ToolkitDetails::displayDetailsDesignPattern(2, $session);
        ?>
    
        <form id="previewAddDP_form" method="post">
            <center>
                    <input type="button" value="Modify input" class="previewDP" style="margin-right: 15px" onclick="history.go(-1);">
                    <input type="submit" value="Create Design Pattern" class="previewDP" style="margin-left: 15px " 
                           onclick="this.form.action='../ajoutsDB/validAddDP.php'">
            </center>
            <script>
                $.post('../ajoutsDB/validAddDP.php', {key: 'foo'}{});
            </script>
        </form>
    </div>
    <?php } ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
