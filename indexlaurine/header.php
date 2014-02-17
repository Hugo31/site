<?php

?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="icon" type="image/png" href="./img/favicon.ico" />
        <title> UI Design Pattern Community </title>

        <!-- meta -->
        <meta charset="UTF-8">
        <meta name="author" content="Laurine MARMISSE & Loic VIGUIER & Loic FAURE & Hugo GUIGNARD" />
        <meta name="description" content="Site sur la gestion communautaire de design pattern" />
        <meta name="keywords" content="design pattern, ui, user interface, guideline, community, database" />
        <meta name="robots" content="All" />

        <link rel="stylesheet" type="text/css" href="styles/styleBase.css" media="all" />
        <link rel="stylesheet" type="text/css" href="styles/styleStructure.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/stylePlus.css" media="screen" />
    </head>

    <body>

        <div id="global">

            <header id="header">
                <div id="headercontent">
                    <img src="./img/header/logo_modif_gris.png" style="height:80px">
                    <div id="navigation">
                        <div style="height:40px">
                            <form id="loginForm2" action="#">
                                <input value="Username" id="inpUsernameEmail" class="texte" type="text">
                                <input value="Password" id="inpPasswordPlaceholder" class="texte" type="text">
                                <input value="SIGN IN" class="signin" type="button">
                                <input value="SIGN UP" type="button" class="signup">
                            </form>
                        </div>
                        <nav id="menu">
                            <a href="#">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#">News</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#">My current Design Pattern (0)</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#">Existing Projects</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="contact.php">Contact</a>
                        </nav>
                    </div>
                </div>
            </header>

            <div id="centre">
