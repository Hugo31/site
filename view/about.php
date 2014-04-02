<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>

<section id="contenu">
    <h1> About us </h1>
    <h2>Context</h2>
    As part of the Master 1 Computer Science at Paul Sabatier University, a group of four students was formed to achieve an IT project 
    in 4 months, from January 2014 to April 2014. At the initiative of Mr Marco Winckler, this project is based on community management 
    of design patterns. In order to achieve this project these students went through an analysis of client needs, followed by a phase of design, 
    development and integration to create the site brought to you today.
    <h2>Our staff</h2>
    <h3>> Loïc FAURE</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Da right PAC in a da right place
        <img src="/site/img/vrac/surprisemotherfucker.png" width="150px" > 
    </div>
    <h3>> Hugo GUIGNARD</h3>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Legends say that Hugo was raised by wolves in the mystical mountains of Saint-Clar. Model of wisdom, 
        goodness and awesomeness, Hugo is considered by his peers as a superior spirit who appeared to 
        help the human race to overcome its challenges.
    </div>
    <h3>> Laurine MARMISSE</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        mon plat stp<br>
        ofet, what else?<br>
        Laurine c'est la plus gentille des membres de l'équipe, en plus elle est juste trop sex :P
    </div>
    <h3>> Loïc VIGUIER</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        La marche des vertueux est semée d'obstacles qui sont les entreprises égoïstes 
        que fait sans fin surgir l'œuvre du Malin. Béni soit-il l'homme de bonne volonté 
        qui, au nom de la charité, se fait le berger des faibles qu'il guide dans la vallée 
        d'ombre de la mort et des larmes... Car il est le gardien de son frère et la providence 
        des enfants égarés. J'abattrai alors le bras d'une terrible colère, d'une vengeance furieuse 
        et effrayante sur les hordes impies qui pourchassent et réduisent à néant les brebis de 
        Dieu. Et tu connaîtras pourquoi mon nom est l'Éternel quand sur toi s'abattra la vengeance 
        du Tout-Puissant !
    </div>
</section>

<?php

include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>
