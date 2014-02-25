<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
class ToolKitDisplay {
    
    public static function displayCheckBoxCriteria($criteria, $dataToDisplay){
        $i = 0;
        echo "<ul id=\"search_sort_".$criteria."\">\n";
        foreach($dataToDisplay as $row){
            echo "<li>\n";
            echo "<input id=\"id".$criteria.$i."\" class=\"classic\" type=\"checkbox\" name=\"id".$criteria.$i."\" value=\"".$row["id"]."\">";
            echo "<label for=\"id".$criteria.$i."\"> ".$row["name"]."</label><br>";
            echo "</li>\n";
            $i++;
        }
        echo "</ul>\n";
    }
    
    
    public static function displayCheckboxesComplete($bdd, $criteria){
        echo "<li>\n";
        $req = "SELECT COUNT(*) AS nb FROM ".$criteria;
        $data = $bdd->query($req);
        echo "<input class=\"tri-state\" type=\"checkbox\" name=\"id".$criteria."\" value=\"".$data->fetch()["nb"]."\"/>";
        echo "<a href=\"#\" onclick=\"toggleObject('#search_sort_".$criteria."'); return false;\"> ".$criteria."<label> [+]</label></a>";
        ToolKitDisplay::displayCheckBoxCriteria($criteria, $bdd->query("SELECT id".$criteria." AS id, name FROM ".$criteria.""));
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
        foreach($dataToDisplay as $row){
            echo "<article id=\"article_".$row['idConflict']."\">";
            echo "<header>";
            echo "<a href=\"details.php?type=Conflict&id=".$row['idConflict']."\">".$row['name']."</a>";
            
            echo "</header>";
            echo "<article>".$row['description']."</article>";
            
            echo "</article>";
        }
        
    }
    
    public static function displayDesignPatternBox($dataToDisplay){
        $bdd = Database::getConnection();
        foreach($dataToDisplay as $row){
            echo "<article id=\"article_".$row['idDesignPattern']."\">";
            echo "<header>";
            echo "<a href=\"details.php?type=DesignPattern&id=".$row['idDesignPattern']."\">".$row['name']."</a>";
            $reqSystem = "SELECT icon FROM System s, SystemDesignPattern sdp "
                    ."WHERE sdp.idDesignPattern=".$row['idDesignPattern']." AND s.idSystem = sdp.idSystem";
            $reponse = $bdd->query($reqSystem);
            foreach($reponse as $img){
                echo "<img src=\"".$img['icon']."\" alt=\"\"/>";
            }
            $reponse->closeCursor();
            
            $reqPlatform = "SELECT icon FROM Platform p, PlatformDesignPattern pdp "
                    ."WHERE pdp.idDesignPattern=".$row['idDesignPattern']." AND p.idPlatform = pdp.idPlatform";
            $reponse = $bdd->query($reqPlatform);
            foreach($reponse as $img){
                echo "<img src=\"".$img['icon']."\" alt=\"\"/>";
            }
            $reponse->closeCursor();
            echo "<a href=\"/site/controller/addCart.php?id=".$row['idDesignPattern']."\">Add</a>";
            echo "</header>";
            echo "<article>".$row['what']."</article>";
            echo "<aside>";
            echo "<div id=\"note\">".$row['rate']."</div>";
            echo "<div id=\"otherInfo\">".$row['nbRates']." rates<br/>".$row['nbComments']." coms</div>";
            echo "</aside>";
            echo "<summary><a href=\"#\" onclick=\"requestDetails('#DesignPattern".$row['idDesignPattern']."', 'DesignPattern', '".$row['idDesignPattern']."');\">See more</a></summary>";
            echo "<details id=\"DesignPattern".$row['idDesignPattern']."\"></details>";
            echo "</article>";
        }
    }
    
    public static function displaySolutionBox($dataToDisplay){
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
