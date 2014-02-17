<?php

class ToolKitDisplay {
    
    public static function displayCheckBoxCriteria($criteria, $dataToDisplay){
        $i = 0;
        foreach($dataToDisplay as $row){
            echo "<input type=\"checkbox\" name=\"id".$criteria.$i."\" value=\"".$row["id"]."\">".$row["name"]."<br>";
            $i++;
            
        }
    }
    
    public static function displayGenericBox($type, $dataToDisplay){
        $i = 0;
        echo "<article>";
        echo "<header>";
        echo "<a href=\"details.php?type=designpattern?id=5\">Nom</a>";
        echo "<img src=\"XXXX\" alt=\"\"/>";
        echo " </header>";
        echo "<article id=\"what\">";
        echo "Ceci est le what d'un design pattern.";
       
        echo "</article>";
        echo "<aside>";
        echo "<div id=\"note\">NOTE</div>";
        echo "<div id=\"otherInfo\">20 notes<br>10coms</div>";
        echo "</aside>";
        echo "<summary><a href=\"#\">Plus d'info</a></summary>";
        echo "<details><!-- Remplit par JS lors de click sur plus d'info -->Info complémentaires</details>";
        echo "</article>";
    }
    
    public static function displayConflictBox($dataToDisplay){
        foreach($dataToDisplay as $row){
            echo "<article id=\"article_".$row['id']."\">";
            echo "<header>";
            echo "<a href=\"details.php?type=Conflict&id=".$row['id']."\">".$row['name']."</a>";
            //Requete pour choper tout les systems et tout les platform
            echo "</header>";
            echo "<article>".$row['description']."</article>";
            
            echo "</article>";
        }
        
    }
    
    public static function displayDesignPatternBox($dataToDisplay){
        
    }
    
    public static function displaySolutionBox($dataToDisplay){
        
    }
    
    
    
    
}
