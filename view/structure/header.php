<?php
    $session = Session::getInstance();
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolKitDisplay.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="icon" type="image/png" href="/site/img/favicon.ico" />
        <title> UI Design Pattern Community </title>

        <!-- meta -->
        <meta charset="UTF-8">
        <meta name="author" content="Laurine MARMISSE & Loic VIGUIER & Loic FAURE & Hugo GUIGNARD" />
        <meta name="description" content="Site sur la gestion communautaire de design pattern" />
        <meta name="keywords" content="design pattern, ui, user interface, guideline, community, database" />
        <meta name="robots" content="All" />

        <link rel="stylesheet" type="text/css" href="/site/styles/styleBase.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/site/styles/styleStructure.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/site/styles/stylePlus.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/site/styles/styleRate.css" media="screen" />
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/site/javascript/toolkit.js"></script>
    </head>

    <body>

        <div id="global">

            <header id="header">
                <div id="headercontent">
                    <img src="/site/img/header/logo_modif_gris.png" style="height:80px">
                    <div id="navigation">
                        <div style="height:40px">
                            <form id="loginForm2" action="verifCo.php">
                                <input value="Username" id="inpUsernameEmail" class="texte" type="text">
                                <input value="Password" id="inpPasswordPlaceholder" class="texte" type="text">
                                <input value="SIGN IN" type="submit" class="signin" >
                                <input value="SIGN UP" type="button" class="signup">
                            </form>
                        </div>
                        <nav id="menu">
                            <a href="/site/index.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/site/view/news.php">News</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/site/view/currentDP.php">My current Design Pattern (0)</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/site/view/contact.php">Contact</a>
                        </nav>
                    </div>
                </div>
            </header>

            <div id="centre">
