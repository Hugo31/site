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
    <br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">      
        Loïc is from Ariege, he graduated from Blagnac's IUT and the IT license of Paul Sabatier.
        He has worked professionally in the development of applications for UAVs.
        Loïc likes food, skateboarding and to work out.
    </div>
    <h3>> Hugo GUIGNARD</h3>
    <br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Hugo is from Toulouse, he graduated from Blagnac's IUT and the IT license of Paul Sabatier.
        He has worked professionally in the development of applications for UAVs.
        Hugo likes to work out, play tennis and to get cultural enrichment.
    </div>
    <h3>> Laurine MARMISSE</h3>
    <br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Laurine is from Figeac, she graduated from Rodez's IUT and the IT license of Paul Sabatier.
        She has experience in web development and Database. She's specialized in HCI.
        Laurine likes movies, photography and gymnastic.
    </div>
    <h3>> Loïc VIGUIER</h3>
    <br/>
    <div id="zonegrise">
        <img src="/site/img/vrac/guillemet2.png" width="30px" style="padding-right:5px;">
        Loïc is from Labège, he graduated from the IT license of Paul Sabatier.
        He has experience in iOS and web development.
        Loïc likes sport, series and play guitare since 2005.
    </div>
</section>

<?php

include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
