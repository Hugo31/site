<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Project.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
$session = Session::getInstance();

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?>

<section id="contenu">

    <?php
    $reponse = false;
    $req = "";

    if (isset($session->login)) {
        $reqP = "SELECT idProject, name, description FROM Project WHERE login = \"" . $session->login . "\" AND current = 1;";
        $data = Database::getOneData($reqP);

        echo "<h1>" . $data['name'] . "</h1>";
        echo "This is your current cart where all previously selected Design Pattern has been save...<br/>";
        echo "To add a new Design Pattern you just need to clic on the link \"Add to ...\" in the description of any Design Pattern.<br/><br/>";
        if (count($session->currentDP)) {
            echo "<p>";
            echo "Your current cart when you weren't connected contains some design patterns. What do you want to do? ";
            echo "Be aware that only your connected cart will be saved when you will create a new project.";
            echo "</p>";
            echo "<p>";
            echo "<form action=\"/site/controller/mergeProject.php\" method=\"post\">";
            echo "<input type=\"radio\" name=\"merge\" value=\"mergeAll\">Merge current cart into your connected cart<br>";
            echo "<input type=\"radio\" name=\"merge\" value=\"replaceCurrent\">Replace your current cart with your connected cart<br>";
            echo "<input type=\"radio\" name=\"merge\" value=\"replaceConnected\">Replace your connected cart with your current cart<br>";
            echo "<input type=\"submit\" name=\"submit\" value=\"Execute\"/>";
            echo"</form>";
            echo "</p>";
        }
        echo "<form action=\"/site/controller/saveProject.php\" method=\"post\">";
        echo "<label>Name : </label><input name=\"name_project\" type=\"text\"/><br/>";
        echo "<label>Description : </label><input name=\"desc_project\" type=\"textarea\"/><br/>";
        echo "<input type=\"submit\" value=\"Save it\"/>";
        echo"</form>";
        echo "<article><h2>Description: </h2>" . $data['description'] . "<br/><br/></article>";
        $req = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp, ProjectDesignPattern proj "
                . "WHERE dp.idDesignPattern = proj.idDesignPattern AND proj.idProject = " . $data['idProject'] . ";";
        $reponse = Database::getAllData($req);
        if ($reponse != false) {
            ToolKitDisplay::displayDesignPatternBox($reponse, true);
        }
    } else {
        ?>
        <h1>My current Design Pattern</h1>
        <div id="cartDescription">
            This is your current cart where all previously selected Design Pattern has been save...<br/>
            To add a new Design Pattern you just need to clic on the link "Add to ..." in the description of any Design Pattern.<br/><br/>
            You want to save your project ? Nothing more simple! Creat now an account to save it and make many other!<br/>
        </div><br/><br/>
        <?php
    }

    if (count($session->currentDP) > 0) {
        $req = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp WHERE ";
        for ($i = 0; $i < count($session->currentDP) - 1; $i ++) {
            $req .= "dp.idDesignPattern = " . $session->currentDP[$i] . " OR ";
        }
        $req .= "dp.idDesignPattern = " . $session->currentDP[$i] . ";";
        $reponse = Database::getAllData($req);
        if ($reponse != false) {
            ToolKitDisplay::displayDesignPatternBox($reponse, true);
        }
    }
    ?>

    <script>
        $("details").hide();
    </script>

</section>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
?>
