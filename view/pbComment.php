<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>
<section id="contenu">
    <?php
    
    ?>
    <h1> Signal a problem </h1>
    
    <?php
        if (isset($_POST['table']) && isset($_POST['id'])) {
            echo $_POST['table'].'<br/>'.$_POST['id'].'<br/>';
            echo 'ok';
        } else {
            echo $_POST['table'].'<br/>'.$_POST['id'].'<br/>';
            echo 'nok';
        }
    ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>