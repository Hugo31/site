<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
class ToolKitDisplay {
    
    public static function displayCheckBoxCriteria($criteria, $dataToDisplay, $values){
        $i = 0;
        echo "<ul id=\"search_sort_".$criteria."\">\n";
        foreach($dataToDisplay as $row){
            echo "<li>\n";
            echo "<input id=\"id".$criteria.$i."\" class=\"classic\" type=\"checkbox\" name=\"id".$criteria.$i."\" value=\"".$row["id"]."|".$row['name']."\" ";
            if(isset($values[$row["name"]])){
                echo " checked ";
            }
            echo ">";
            echo "<label for=\"id".$criteria.$i."\"> ".$row["name"]."</label><br>";
            echo "</li>\n";
            $i++;
        }
        echo "</ul>\n";
    }
    
    
    public static function displayCheckboxesComplete($bdd, $criteria, $values){
        echo "<li>\n";
        $req = "SELECT COUNT(*) AS nb FROM ".$criteria;
        $data = $bdd->query($req);
        echo "<a id=\"search_sort_".$criteria."_a\" href=\"#\" style=\"text-decoration:none;\" onclick=\"toggleTree('#search_sort_".$criteria."', $(this)); return false;\">[+]</a>";
        echo "<input class=\"tri-state\" type=\"checkbox\" name=\"id".$criteria."\" value=\"".$data->fetch()["nb"]."\"/>";
        echo $criteria;
        ToolKitDisplay::displayCheckBoxCriteria($criteria, $bdd->query("SELECT id".$criteria." AS id, name FROM ".$criteria.""), $values);
        echo "</li>\n";
        
    }
    
    
    public static function displayGenericBox($type, $dataToDisplay){
        if($type == "Conflict"){
            ToolKitDisplay::displayConflictBox($dataToDisplay);
        }
        else{
            if($type == "DesignPattern"){
                ToolKitDisplay::displayDesignPatternBox($dataToDisplay);
            }
            else{
                ToolKitDisplay::displaySolutionBox($dataToDisplay);
            }
        }
    }
    
    public static function displayConflictBox($dataToDisplay){
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No results.';
        } else {
            $bdd = Database::getConnection();
            foreach($dataToDisplay as $row){
                echo "<article class=\"conflitBox\" id=\"article_".$row['idConflict']."\">";
                echo "<header id='headerConflitBox'>";
                echo "<a href=\"details.php?type=Conflict&id=".$row['idConflict']."\"><h2>".$row['name']."</h2></a>";
                $dateConflict = new DateTime($row['date']);
                echo "<br/><div id=\"lienDP\">Date of reporting : ".$dateConflict->format('d/m/Y')." | Author : <a href=\"\">".$row['login']."</a> | <img src=\"../img/vrac/propose.png\" style=\"vertical-align:middle;width:20px\"/>  <a href=\"/site/controller/addCart.php?id=".$row['idConflict']."\">Propose a solution</a></div>";
                echo "</header>";
                $reqNbConflict = "SELECT COUNT(*) FROM Solution s WHERE s.idConflict=".$row['idConflict'];
                $reponse = $bdd->query($reqNbConflict);
                $nb = $reponse->fetch();
                $reponse->closeCursor();
                echo "<aside id='asideConflictBox'>";
                echo "<div id=\"otherInfo\"><a href=\"\">".$nb[0]." solution(s)</a><br/><a href=\"\">".$row['nbComments']." com(s)</a></div>";
                echo "</aside>";
                echo "<div id=\"typeConflict\"> DP in conflict: ";
                $reqPlatform = "SELECT dp.idDesignPattern, dp.name FROM DesignPattern dp, ConflictDesignPattern cdp "
                        ."WHERE cdp.idConflict=".$row['idConflict']." AND dp.idDesignPattern = cdp.idDesignPattern";
                $reponse = $bdd->query($reqPlatform);
                foreach($reponse as $res){
                    echo "<a href=\"".$res['idDesignPattern']."\">".$res['name']."</a> & ";
                }
                $reponse->closeCursor();
                echo "</div>";
                echo "<article>".$row['description']."</article>";
                echo "</article>";
            }
        }
    }
    
    public static function displayDesignPatternBox($dataToDisplay){
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No results.';
        } else {
            $bdd = Database::getConnection();
            foreach($dataToDisplay as $row){
                echo "<article class=\"designPatternBox\" id=\"article_".$row['idDesignPattern']."\">";
                echo "<div id='headerAside'>";
                echo "<header id='headerDesignPatternBox'>";
                echo "<a href=\"details.php?type=DesignPattern&id=".$row['idDesignPattern']."\"><h2>".$row['name']."</h2></a>";
                $reqSystem = "SELECT icon FROM System s, SystemDesignPattern sdp "
                        ."WHERE sdp.idDesignPattern=".$row['idDesignPattern']." AND s.idSystem = sdp.idSystem";
                $reponse = $bdd->query($reqSystem);
                foreach($reponse as $img){
                    echo "<sup><img src=\"".$img['icon']."\" alt=\"\" style=\"padding-right:5px;\"/></sup>";
                }
                $reponse->closeCursor();

                $reqPlatform = "SELECT icon FROM Platform p, PlatformDesignPattern pdp "
                        ."WHERE pdp.idDesignPattern=".$row['idDesignPattern']." AND p.idPlatform = pdp.idPlatform";
                $reponse = $bdd->query($reqPlatform);
                foreach($reponse as $img){
                    echo "<sup><img src=\"".$img['icon']."\" alt=\"\"/ style=\"padding-right:5px;width:20px;\"></sup>";
                }
                $reponse->closeCursor();
                $dateDP = new DateTime($row['date']);
                echo "<br/><div id=\"lienAdd\">Date of last update : ".$dateDP->format('d/m/Y')." | Author : <a href=\"\">".$row['login']."</a> | <img src=\"../img/vrac/add.png\" style=\"vertical-align:middle;width:20px\"/>  <a href=\"/site/controller/addCart.php?id=".$row['idDesignPattern']."\">Add to my current Design Pattern</a></div>";
                echo "</header>";
                echo "<aside id='asideDesignPatternBox'>";
                echo "<div id=\"note\">".$row['rate']."/5</div>";
                echo "<div id=\"otherInfo\"><a href=\"\">".$row['nbRates']." rate(s)</a><br/><a href=\"\">".$row['nbComments']." com(s)</a></div>";
                echo "</aside>";
                echo "</div>";
                echo "<article id=\"articleDesignPatternBox\">".$row['what']."</article>";
                echo "<summary><a href=\"#\" onclick=\"requestDetails('#DesignPattern".$row['idDesignPattern']."', 'DesignPattern', '".$row['idDesignPattern']."');\" style=\"float:right\">See more</a></summary><br/>";
                echo "<details class=\"detailsDP\" id=\"DesignPattern".$row['idDesignPattern']."\"></details>";
                echo "</article>";
            }
        }
    }
    
    public static function displaySolutionBox($dataToDisplay){
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No results.';
        } else {
            foreach($dataToDisplay as $row){
                echo "<article id=\"article_".$row['idSolution']."\">";
                echo "<header>";
                echo "<a href=\"details.php?type=Solution&id=".$row['idSolution']."\">".$row['name']."</a>";
                echo "</header>";
                echo "<article>".$row['comment']."</article>";
                echo "<summary><a href=\"#\">See more</a></summary>";
                echo "<details></details>";
                echo "</article>";
            }
        }
    }
    
    public static function checkItem($item, $value){
        if($item == $value){
            echo "checked";
        }
    }
    
    public static function addValue($value){
        echo "value=\"".$value."\"";
    }
}
