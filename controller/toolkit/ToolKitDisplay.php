<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
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
                if($type == "Solution"){
                    ToolKitDisplay::displaySolutionBox($dataToDisplay);
                }
                else{
                    ToolKitDisplay::displayProjectBox($dataToDisplay);
                }  
            }
        }
    }
    
    public static function displayConflictBox($dataToDisplay){
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No results.';
        } else {
            $bdd = Database::getConnection();
            foreach($dataToDisplay as $row){
                echo "<article class=\"box\" id=\"article_".$row['idConflict']."\">";
                
                echo "<div id='headerAside'>";
                echo "<header id='headerBox'>";
                echo "<a href=\"details.php?type=Conflict&id=".$row['idConflict']."\"><h2>".$row['name']."</h2></a>";
                $dateConflict = new DateTime($row['date']);
                echo "<br/><div id=\"lienDescr\">Date of reporting: ".$dateConflict->format('d/m/Y')." | Author: <a href=\"\">".$row['login']."</a> | <img src=\"../img/vrac/propose.png\" style=\"vertical-align:middle;width:20px\"/>  <a href=\"/site/controller/proposeSol.php?id=".$row['idConflict']."\">Propose a solution</a></div>";
                echo "</header>";
                
                $data = Database::getOneData("SELECT COUNT(*) as nb FROM Solution WHERE idconflict = ".$row['idConflict']);
                echo "<aside id='asideBox'>";
                echo "<div id=\"otherInfo2\"><a href=\"\">".$data['nb']." solution(s)</a><br/><a href=\"\">".$row['nbComments']." com(s)</a></div>";
                echo "</aside>";
                echo "</div>";
                
                echo "<div>DP in conflict: ";
  
                $nombre = $data['nb'];
                
                $rqtConflict = Database::getAllData("SELECT dp.idDesignPattern, dp.name FROM DesignPattern dp, ConflictDesignPattern cdp "
                        ."WHERE cdp.idConflict=".$row['idConflict']." AND dp.idDesignPattern = cdp.idDesignPattern;");
                foreach($rqtConflict as $res){
                    if ($nombre > 1) {
                        echo "<a href=\"".$res['idDesignPattern']."\">".$res['name']."</a> & ";
                        $nombre--;
                    } else {
                        echo "<a href=\"".$res['idDesignPattern']."\">".$res['name']."</a>";
                    }
                }
                $rqtConflict->closeCursor();
                echo "</div><br/>";
                
                echo "<summary><a href=\"#\" onclick=\"requestDetails('#Conflict".$row['idConflict']."', 'Conflict', '".$row['idConflict']."');return false;\" style=\"float:right\">See description</a></summary><br/>";
                echo "<details class=\"details\" id=\"Conflict".$row['idConflict']."\"></details>";
                echo "</article>";
            }
        }
    }
    
    public static function displayDesignPatternBox($dataToDisplay){
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No results.';
        } else {
            foreach($dataToDisplay as $row){
                echo "<article class=\"box\" id=\"article_".$row['idDesignPattern']."\">";
                echo "<div id='headerAside'>";
                echo "<header id='headerBox'>";
                echo "<a href=\"details.php?type=DesignPattern&id=".$row['idDesignPattern']."\"><h2>".$row['name']."</h2></a>";
 
                $reqSystem = Database::getAllData("SELECT icon FROM System s, SystemDesignPattern sdp "
                        ."WHERE sdp.idDesignPattern=".$row['idDesignPattern']." AND s.idSystem = sdp.idSystem;");   
                foreach($reqSystem as $img){
                    echo "<sup><img src=\"".$img['icon']."\" alt=\"\" style=\"padding-right:5px;\"/></sup>";
                }
                $reqSystem->closeCursor();

                $reqPlatform = Database::getAllData("SELECT icon FROM Platform p, PlatformDesignPattern pdp "
                        ."WHERE pdp.idDesignPattern=".$row['idDesignPattern']." AND p.idPlatform = pdp.idPlatform;");
                foreach($reqPlatform as $img){
                    echo "<sup><img src=\"".$img['icon']."\" alt=\"\"/ style=\"padding-right:5px;width:20px;\"></sup>";
                }
                $reqPlatform->closeCursor();
                $dateDP = new DateTime($row['date']);
                echo "<br/><div id=\"lienDescr\">Date of last update: ".$dateDP->format('d/m/Y')." | Author: <a href=\"\">".$row['login']."</a> | <img src=\"../img/vrac/add.png\" style=\"vertical-align:middle;width:20px\"/>  <a href=\"/site/controller/addCart.php?id=".$row['idDesignPattern']."\">Add to my current Design Pattern</a></div>";
                echo "</header>";
                echo "<aside id='asideBox'>";
                echo "<div id=\"note\">".$row['rate']."/5</div>";
                echo "<div id=\"otherInfo\"><a href=\"\">".$row['nbRates']." rate(s)</a><br/><a href=\"\">".$row['nbComments']." com(s)</a><br>".$row['nbUsage']." used</div>";
                echo "</aside>";
                echo "</div>";
                echo "<article id=\"articleBox\">".$row['what']."</article>";
                echo "<summary><a href=\"#\" onclick=\"requestDetails('#DesignPattern".$row['idDesignPattern']."', 'DesignPattern', '".$row['idDesignPattern']."');return false;\" style=\"float:right\">See more</a></summary><br/>";
                echo "<details class=\"details\" id=\"DesignPattern".$row['idDesignPattern']."\"></details>";
                echo "</article>";
            }
        }
    }
    
    public static function displaySolutionBox($dataToDisplay){
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No results.';
        } else {
            $bdd = Database::getConnection();
            foreach($dataToDisplay as $row){
                
                echo "<article class=\"box\" id=\"article_".$row['idSolution']."\">";
                echo "<div id='headerAside'>";
                
                echo "<header id='headerBox'>";
                echo "<a href=\"details.php?type=Solution&id=".$row['idSolution']."\"><h2>".$row['name']."</h2></a>";
                $dateS = new DateTime($row['date']);
                echo "<br/><div id=\"lienDescr\">Date of last update: ".$dateS->format('d/m/Y')." | Author: <a href=\"\">".$row['login']."</a> </div>";
                echo "</header>";
                
                echo "<aside id='asideBox'>";
                echo "<div id=\"note\">".$row['rate']."/5</div>";
                echo "<div id=\"otherInfo\"><a href=\"\">".$row['nbRates']." rate(s)</a><br/><a href=\"\">".$row['nbComments']." com(s)</a></div>";
                echo "</aside>";
                echo "</div>";
                
                echo "<div id=\"solutionConflict\">Solution of the conflict: ";
                
                $data = Database::getOneData("SELECT c.idConflict, c.name FROM Solution s, Conflict c WHERE s.idSolution=".$row['idSolution']." and c.idConflict=s.idConflict;");
                echo "<a href=\"".$data['idConflict']."\">".$data['name']."</a>";
                echo "</div>";  
                                
                echo "<article id=\"articleBox\">".$row['comment']."</article>";
                echo "<summary><a href=\"#\" onclick=\"requestDetails('#Solution".$row['idSolution']."', 'Solution', '".$row['idSolution']."');return false;\" style=\"float:right\">See more</a></summary><br/>";
                echo "<details class=\"details\" id=\"Solution".$row['idSolution']."\"></details>";
                echo "</article>";
            }
        }
    }
    
    public static function displayProjectBox($dataToDisplay){
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No existing projects.';
        } else {
            $bdd = Database::getConnection();
            foreach($dataToDisplay as $row){
                
                echo "<article class=\"box\" id=\"article_".$row['idProject']."\">";
                echo "<div id='headerAside'>";
                
                echo "<header id='headerBox'>";
                echo "<a href=\"details.php?type=Project&id=".$row['idProject']."\"><h2>".$row['name']."</h2></a>";
                $dateS = new DateTime($row['date']);
                echo "<br/><div id=\"lienDescr\">Date of creation: ".$dateS->format('d/m/Y')." | Author: <a href=\"\">".$row['login']."</a> </div>";
                echo "</header>";

                $data = Database::getOneData("SELECT COUNT(*) as nb FROM ProjectDesignPattern pdp WHERE pdp.idProject=".$row['idProject'].";");
                echo "<aside id='asideBox'>";
                echo "<div id=\"otherInfo2\"><a href=\"\">".$data['nb']." Design Pattern(s)</a></div>";
                echo "</aside>";
                echo "</div>";
                
                echo "<div id=\"dpProjects\">Design Patterns in this project: ";
                $nombreDP = $data['nb'];

                $rqtDPProjects = Database::getAllData("SELECT dp.idDesignPattern, dp.name FROM DesignPattern dp, ProjectDesignPattern pdp "
                        ."WHERE pdp.idProject=".$row['idProject']." AND dp.idDesignPattern = pdp.idDesignPattern;");
                foreach($rqtDPProjects as $res){
                    if ($nombreDP > 1) {
                        echo "<a href=\"".$res['idDesignPattern']."\">".$res['name']."</a> & ";
                        $nombreDP--;
                    } else {
                        echo "<a href=\"".$res['idDesignPattern']."\">".$res['name']."</a>";
                    }
                }
                $rqtDPProjects->closeCursor();
                echo "</div><br/>";  
                                
                echo "<summary><a href=\"#\" onclick=\"requestDetails('#Project".$row['idProject']."', 'Project', '".$row['idProject']."');return false;\" style=\"float:right\">See description</a></summary><br/>";
                echo "<details class=\"details\" id=\"Project".$row['idProject']."\"></details>";
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
    
    public static function displayText($name, $data){
        echo "<div id=\"textDisplay\">";
        echo "<h3>".$name."</h3>";
        echo $data;
        echo "</div><br/>";
    }
    
    public static function displayRate($id, $nbRates, $rate, $tableAsk){
        echo "<div id=\"details_rate\">";
        echo "<h3>Rate: </h3><br/><br/>";
        
        echo "<div class=\"rating-box\">";
        echo "<div class=\"score-container\"><span class=\"score\">".$rate."</span><br>".$nbRates." au total</div>";
        echo "<div class=\"rating-histogram\">";
        $five = Database::getOneData("SELECT COUNT(*) as nb FROM Note".$tableAsk." WHERE id".$tableAsk." = ".$id." AND note = 5;")['nb'];
        $four = Database::getOneData("SELECT COUNT(*) as nb FROM Note".$tableAsk." WHERE id".$tableAsk." = ".$id." AND note = 4;")['nb'];
        $three = Database::getOneData("SELECT COUNT(*) as nb FROM Note".$tableAsk." WHERE id".$tableAsk." = ".$id." AND note = 3;")['nb'];
        $two = Database::getOneData("SELECT COUNT(*) as nb FROM Note".$tableAsk." WHERE id".$tableAsk." = ".$id." AND note = 2;")['nb'];
        $one = Database::getOneData("SELECT COUNT(*) as nb FROM Note".$tableAsk." WHERE id".$tableAsk." = ".$id." AND note = 1;")['nb'];
        $max = $five;
        if($four > $max){ $max = $four; }
        if($three > $max){ $max = $three; }
        if($two > $max){ $max = $two; }
        if($one > $max){ $max = $one; }
        if($max == 0){ $max = 1; }
        ToolKitDisplay::displayRateBar($five, 5, ($five*100)/$max, "five");
        ToolKitDisplay::displayRateBar($four, 4, ($four*100)/$max, "four");
        ToolKitDisplay::displayRateBar($three, 3, ($three*100)/$max, "three");
        ToolKitDisplay::displayRateBar($two, 2, ($two*100)/$max, "two");
        ToolKitDisplay::displayRateBar($one, 1, ($one*100)/$max, "one");
        echo "</div>";
        echo "</div>";
        /*if(isset($session->login)){
            $alreadyRate = Database::getOneData("SELECT rate FROM Note".$tableAsk." WHERE id".$tableAsk." = ".$id." AND login = \"".$session->login."\"");
            echo"<center><h3>You already rate:</h3> <input type=\"number\" value=\"".$alreadyRate['rate']."\"/><a>Modify !</a></center>";
        }
        else{*/
            echo "<center><h3>Give a rate:</h3> <input type=\"number\"/> <a>Rate !</a></center>";
        //}
        
        //Jquery right here !!
        echo "</div>";
        
    }
    
    public static function displayRateBar($nb, $rateSearch, $percent, $nameStyle){
        echo "<div class=\"rating-bar-container ".$nameStyle."\">";
        echo "<span class=\"bar-label\">".$rateSearch."</span>";
        echo "<span class=\"bar\" style=\"width : ".$percent."%\"></span>";
        echo "<span class=\"bar-number\">".$nb."</span>";
        echo "</div>";
    }
    
    public static function displayCommentsLittles($id, $nbComments, $tableAsk){
        $reponse = Database::getAllData("SELECT * FROM Comment".$tableAsk." WHERE id".$tableAsk." = ".$id." ORDER BY DATE LIMIT 0, 3");
        echo "<article>";
        echo "<h2>Comments (".$nbComments.") : </h2><br>";
        foreach($reponse as $row){
            echo "<div id=\"containerComment\">";
            echo "<div id=\"logoComment\">";
            $data = Database::getOneData("SELECT logo FROM User WHERE login = \"".$row['login']."\"");
            echo "<img src=\"".$data['logo']."\" style=\"width:50px;\"/><br><a href=\"\">".$row['login']."</a>";
            echo "</div>";
            echo "<div id=\"textComment\">";
            echo "<i>Posted ".$row['date']."</i><br>";
            echo $row['comment'];
            echo "</div>";
            echo "</div>";
        }
        echo "</article>";
        $reponse->closeCursor();
    }
          
}
