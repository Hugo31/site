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
        if($_GET['type'] == "Conflict"){
            
        }
        else{
            if($_GET['type'] == "DesignPattern"){
                
            }
            else{
                if($_GET['type'] == "Solution"){
                    
                }
            }
        }
    ?>
    
</section>
<script>
    
</script>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');   
?>
