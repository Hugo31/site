<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDisplay.php");   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Page de test</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/site/javascript/toolkit.js"></script>
        
        
        <a href="indexlaurine/home.php">Index laurine</a><br/><br/>
        <a href="test/pagetestuser.php">Page de test user</a><br/>
        <a href="test/pagetestdp.php">Page de test Design Pattern</a><br/>
        <a href="test/pagetestproject.php">Page de test projet</a><br/>
        <a href="test/pagetestsort.php">Page de test table de tri</a><br/>
        <a href="test/pagetestimgsrc.php">Page de test Image et Source</a><br/>
        <a href="test/pagetestcomnote.php">Page de test comment et note</a><br/>
        <a href="test/pagetestconflict.php">Page de test conflict</a><br/>
        <a href="test/pagetestsolution.php">Page de test solution</a><br/>
        
        <a href="test/testsgenerals.php">Page de tests générals</a><br/>
        
        <a href="testJQuery/testjquery1.php">Test jquery</a><br/>
        <?php
            include($_SERVER['DOCUMENT_ROOT']."/site/view/search/viewSearch.php");
        ?>
    </body>
</html>
