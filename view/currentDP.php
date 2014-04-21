<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Project.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
$session = Session::getInstance();

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?>

<script type="text/javascript">
    hideblock = function(a){
        $(a).attr("onclick","return showblock($(this));");
        $(a).text("Show conflicts");
        $(a).parent().children("div").first().hide().end();
        
        return!1;
    };
    
    showblock = function(a){
        $(a).attr("onclick","return hideblock($(this));");
        $(a).text("Hide conflicts");
        $(a).parent().children("div").first().show().end();
        $(a).show();

        return!1;
    };
</script>

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
        echo "<label>Description : </label><textarea name=\"desc_project\"></textarea><br/>";
        echo "<input type=\"submit\" value=\"Save it\"/>";
        echo"</form>";
        
        $req = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp, ProjectDesignPattern proj "
                . "WHERE dp.idDesignPattern = proj.idDesignPattern AND proj.idProject = " . $data['idProject'] . ";";
        $reponse = Database::getAllData($req);
        
        $result = Database::getAllData($req);
        $save = [];
        $conf = array();
        $i = 0;
        $trouv = false;
        foreach($result as $row){
            foreach($save as $dps){
                $reqConf = "SELECT DISTINCT cdp.idConflict FROM conflictdesignpattern cdp, conflictdesignpattern cdp2 WHERE cdp.idDesignPattern = " . $dps[0] . " AND cdp2.idDesignPattern = " . $row[0];
                $reponseConf = Database::getAllData($reqConf);
                foreach($reponseConf as $conflicts){
                    if (!$trouv){
                        echo '</br><cC>Warning! You may encounter conflicts between your Design Patterns. </cC></br><a href="#" onclick="return showblock(this)" style="text-decoration:none;" >Show conflicts</a>';
                        echo '<div id="conflictsCart" hidden = true>';
                        $trouv = true;
                    }
                    $reponseConf2 = Database::getAllData("SELECT * FROM Conflict WHERE idConflict = " . $conflicts['idConflict']. ";");
                    foreach($reponseConf2 as $conflicts2){
                        if (!in_array($conflicts2['idConflict'], $conf)) {
                            array_push($conf, $conflicts2['idConflict']);
                            $reponseConf3 = Database::getAllData("SELECT * FROM Conflict WHERE idConflict = " . $conflicts['idConflict']. ";");
                            ToolKitDisplay::displayConflictBox($reponseConf3);
                        }
                    }
                    
                }
            }
            $save[$i] = $row[0];
            $i++;
        }
        if ($trouv){
            echo '</div>';
        }
        
        echo "<article><h2>Description: </h2>" . $data['description'] . "<br/><br/></article>";
        if ($reponse != false) {
            ToolKitDisplay::displayDesignPatternBox($reponse, true);
        }
    } 
    else {
        ?>
        <h1>My current Design Pattern</h1>
        <p id="cartDescription">
            This is your current cart where all previously selected Design Pattern has been save...<br/>
            To add a new Design Pattern you just need to clic on the link "Add to ..." in the description of any Design Pattern.<br/><br/>
            You want to save your project ? Nothing more simple! Creat now an account to save it and make many other!<br/>
        </p><br/><br/>
        <?php
    
        if (count($session->currentDP) > 0) {
            $req = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp WHERE ";
            for ($i = 0; $i < count($session->currentDP) - 1; $i ++) {
                $req .= "dp.idDesignPattern = " . $session->currentDP[$i] . " OR ";
            }
            $req .= "dp.idDesignPattern = " . $session->currentDP[$i] . ";";
            $reponse = Database::getAllData($req);
            
            $result = Database::getAllData($req);
            $save = [];
            $conf = array();
            $i = 0;
            $trouv = false;
            foreach($result as $row){
                foreach($save as $dps){
                    $reqConf = "SELECT DISTINCT cdp.idConflict FROM conflictdesignpattern cdp, conflictdesignpattern cdp2 WHERE cdp.idDesignPattern = " . $dps[0] . " AND cdp2.idDesignPattern = " . $row[0];
                    $reponseConf = Database::getAllData($reqConf);
                    foreach($reponseConf as $conflicts){
                        if (!$trouv){
                            echo '<cC>Warning! You may encounter conflicts between your Design Patterns. </cC></br><a href="#" onclick="return showblock(this)" style="text-decoration:none;" >Show conflicts</a>';
                            echo '<div id="conflictsCart" hidden = true>';
                            $trouv = true;
                        }
                        $reponseConf2 = Database::getAllData("SELECT * FROM Conflict WHERE idConflict = " . $conflicts['idConflict']. ";");
                        foreach($reponseConf2 as $conflicts2){
                            if (!in_array($conflicts2['idConflict'], $conf)) {
                                array_push($conf, $conflicts2['idConflict']);
                                $reponseConf3 = Database::getAllData("SELECT * FROM Conflict WHERE idConflict = " . $conflicts['idConflict']. ";");
                                ToolKitDisplay::displayConflictBox($reponseConf3);
                            }
                        }

                    }
                }
                $save[$i] = $row[0];
                $i++;
            }
            if ($trouv){
                echo '</div></br>';
            }
            
            if ($reponse != false) {
                ToolKitDisplay::displayDesignPatternBox($reponse, true);
            }

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
