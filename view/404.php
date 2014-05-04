<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>

<section id="contenu">
    
    <h1> Oh snap....</h1>
    <center>
        <img src="/site/img/vrac/404.png" name="img404" onmouseover="img404.src = '/site/img/vrac/404_up.png'" onmouseout="img404.src = '/site/img/vrac/404.png'">
        <h2>We don't know what you are looking for, but don't be sad.<br/>
            We can take you <a href="/site/index.php">home</a> ! ;)</h2>
    </center>
    
</section>

<?php

include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
