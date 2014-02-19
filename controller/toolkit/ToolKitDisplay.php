<?php

class ToolKitDisplay {
    
    public static function displayCheckBoxCriteria($criteria, $dataToDisplay){
        $i = 0;
        echo "<ul id=\"search_sort_".$criteria."\">\n";
        foreach($dataToDisplay as $row){
            echo "<li>\n";
            echo "<input class=\"classic\" type=\"checkbox\" name=\"id".$criteria.$i."\" value=\"".$row["id"]."\">";
            echo "<label>".$row["name"]."</label><br>";
            echo "</li>\n";
            $i++;
        }
        echo "</ul>\n";
    }
    
    
    public static function displayCheckboxesComplete($bdd, $criteria){
        echo "<li>\n";
        $req = "SELECT COUNT(*) AS nb FROM ".$criteria;
        $data = $bdd->query($req);
        echo "<a href=\"#\" onclick=\"runEffect('#search_sort_".$criteria."'); return false;\">[+]</a>";
        echo "<input class=\"tri-state\" type=\"checkbox\" name=\"idCategory\" value=\"".$data->fetch()["nb"]."\"/>";
        echo "<label>".$criteria."</label>";
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
        foreach($dataToDisplay as $row){
            echo "<article id=\"article_".$row['idDesignPattern']."\">";
            echo "<header>";
            echo "<a href=\"details.php?type=DesignPattern&id=".$row['idDesignPattern']."\">".$row['name']."</a>";
            //Requete pour avoir toutes les images de system et platform.
            echo "</header>";
            echo "<article>".$row['what']."</article>";
            echo "<aside>";
            echo "<div id=\"note\">NOTE</div>";
            echo "<div id=\"otherInfo\">20 notes<br>10coms</div>";
            echo "</aside>";
            echo "<summary><a href=\"#\">See more</a></summary>";
            echo "<details></details>";
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
