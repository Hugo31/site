<?php

if (isset($_GET['typeMessage'])) {
    echo "<div class=\"message\">";
    //Faire un système de type.
    echo $_GET['typeMessage'];
    echo "</div>";
}

?>


