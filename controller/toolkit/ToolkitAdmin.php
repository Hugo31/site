<?php

class ToolkitAdmin{
    
    public static function displayAdminBox($id, $type) {
        echo "<form action=\"/site/controller/deleteAdmin.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"type\" value=\"".$type."\"/>";
        echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\"/>";
        echo "<input type=\"submit\" value=\"Modify\"/>";
        echo "<input type=\"submit\" value=\"Remove\"/>";
        echo "</form>";
    }
    
    public static function displayUserBox($dataToDisplay) {
        if ($dataToDisplay->rowCount() == 0) {
            echo 'No results.';
        } else {
            $session = Session::getInstance();
            foreach ($dataToDisplay as $row) {
                echo "<article class=\"box\" id=\"article_".$row['login']."\">";
                echo "<div id='headerAsideUser'>";
                echo "<header id='headerBox'>";
                echo "<a href=\"details.php?type=User&id=".$row['login']."\"><h2>".$row['login']."</h2></a>";
                
                if (isset($session->admin)) {
                    echo "<br/><div id=\"lienDescr\"><img src=\"../img/vrac/croix.png\" style=\"vertical-align:middle;width:20px\"/>  <a href=\"/site/controller/deleteUser.php?login=".$row['login']."\">Remove user</a></div>";
                }
                echo "</header>";
                echo "</div>";
                echo "<article id=\"articleBox\">".$row['mail']."</article>";
                echo "</article>";
            }
        }
    }
}
