<?php

class ToolkitAdmin{
    
    public static function displayAdminBox($id, $type) {
        echo "<div class=\"message message-admin\">";
        echo "<form action=\"/site/controller/modifyAdmin.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"type\" value=\"".$type."\"/>";
        echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\"/>";
        echo "<input type=\"submit\" class=\"send\" value=\"MODIFY\"/>";
        echo "</form>";
        echo "<form action=\"/site/controller/deleteAdmin.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"type\" value=\"".$type."\"/>";
        echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\"/>";
        echo "<input type=\"submit\" class=\"reset\" value=\"REMOVE\"/>";
        echo "</form>";
        echo "</div>";
    }
    
    public static function displayUserBox($dataToDisplay) {
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No conflicts.';
        } else {
            $session = Session::getInstance();
            $bdd = Database::getConnection();
            
            echo "<center><table style=\"text-align:center\">";
            $i = 0;
            foreach ($dataToDisplay as $row) {
                if ($i == 0) {
                    echo "<tr><td width=\"300px\" style=\"padding-right:10px\">";
                    echo "<article class=\"boxUsers\" id=\"article_".$row['login']."\">";
                    echo "<h2><a href=\"user.php?user=".$row['login']."\">".$row['login']."</a></h2>".$row['mail']."";
                    echo "<br/><div id=\"lienDescr\"><img src=\"../img/vrac/croix.png\" style=\"vertical-align:middle;width:20px\"/>  <a href=\"/site/controller/deleteUser.php?login=".$row['login']."\">Remove user</a></div>";
                    echo "</article></td>";
                    $i++;
                } else {
                    echo "<td width=\"300px\">";
                    echo "<article class=\"boxUsers\" id=\"article_".$row['login']."\">";
                    echo "<h2><a href=\"user.php?user=".$row['login']."\">".$row['login']."</a></h2>".$row['mail']."";
                    echo "<br/><div id=\"lienDescr\"><img src=\"../img/vrac/croix.png\" style=\"vertical-align:middle;width:20px\"/>  <a href=\"/site/controller/deleteUser.php?login=".$row['login']."\">Remove user</a></div>";
                    echo "</article>";
                    echo "</td></tr>";
                    $i = 0;
                } 
            }
            if ($i != 0) {
                echo "</tr>";
            }
            echo "</table></center>";
        }
    }
    
    
}
