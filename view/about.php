<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>

<section id="contenu">
    <h1> About us </h1>
    <h2>Context</h2>
    Dans le cadre du Master 1 Informatique à l'Université Paul Sabatier, un groupe
    de 4 étudiants a été formé afin de réaliser un projet informatique sur 4 mois, de janvier 2014 à avril 2014. 
    A l'initiative de Mr Marco Winckler, ce projet porte sur la gestion communautaire de design patterns. 
    Ces étudiants ont réalisé un projet complet avec une phase d’analyse et d’écoute du besoin, suivie 
    d’une phase de création, de développement et d'intégration pour arriver au site qui vous est présenté aujourd'hui.
    <h2>Our staff</h2>
    <h3>> Loïc FAURE</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site 
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site 
    </div>
    <h3>> Hugo GUIGNARD</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site 
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site 
    </div>
    <h3>> Laurine MARMISSE</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site 
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site 
    </div>
    <h3>> Loïc VIGUIER</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site 
        Donner son avis sur ce site Donner son avis sur ce site Donner son avis sur ce site 
    </div>
</section>

<?php

include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>
