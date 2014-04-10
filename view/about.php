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
        Hola ! Soy Juan Martinez, comó esta dans la casa? 
    </div>
    <h3>> Hugo GUIGNARD</h3>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Senor guignaro de la hoya !
    </div>
    <h3>> Laurine MARMISSE</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Pur énergie de swag
    </div>
    <h3>> Loïc VIGUIER</h3>
    // faire sa présentation
    <br/><br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        La bible toussa toussa
        Catholicisme, islamomusulmanoterroriste
    </div>
</section>

<?php

include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>
