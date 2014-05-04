<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/User.php");

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?>

<section id="contenu">
    <?php
    
    ?>
    <?php
    if (!$user = User::getDB($session->login)) {
        echo '<center><h3>You must be connected in order to use this page</h3></center>';
    } else {
        ?>

        <h1>My contributions</h1>
        <h2 style="margin:0 auto;">My Design Patterns</h2><hr>
        <?php
            $bdd = Database::getConnection();
            $session->typeQuery = "DesignPattern";
            $reponse = Database::getAllData("SELECT * FROM DesignPattern WHERE login = \"" . $session->login . "\";");
            ToolKitDisplay::displayGenericBox($session->typeQuery, $reponse);
        ?>
        <br/><br/>
        <center><a href="/site/view/addDesignPattern.php" style="text-decoration: none">
            <button id="profilAddDP">Create a new Design Pattern</button>
        </a></center><br/><br/>
   
        <h2 style="margin:0 auto;">My conflicts</h2><hr>
        <?php
            $bdd = Database::getConnection();
            $session->typeQuery = "Conflict";
            $reponse = Database::getAllData("SELECT * FROM Conflict WHERE login = \"" . $session->login . "\";");
            ToolKitDisplay::displayGenericBox($session->typeQuery, $reponse);
        ?>
        <br/><br/>
        <h2 style="margin:0 auto;">My solutions</h2><hr>
        <?php
            $bdd = Database::getConnection();
            $session->typeQuery = "Solution";
            $reponse = Database::getAllData("SELECT * FROM Solution WHERE login = \"" . $session->login . "\";");
            ToolKitDisplay::displayGenericBox($session->typeQuery, $reponse);
    }
        ?>
        
        <br/><br/><br/>
</section>
<script>
    $("details").hide();
</script>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');

