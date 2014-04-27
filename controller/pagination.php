<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/Database.php");
$bdd = Database::getConnection();

if (isset($_POST['page']) && isset($_POST['table']) && isset($_POST['id'])) {
    $page = $_POST['page'];
    $table = $_POST['table'];
    $id = $_POST['id'];
    $cur_page = $page;
    $page -= 1;
    $per_page = 5;
    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $per_page;


    $result_pag_data = Database::getAllData("SELECT * from Comment".$table." WHERE id".$table." = ".$id." LIMIT ".$start.",".$per_page.";");
    $msg = "";
    foreach ($result_pag_data as $row) {
        echo "<div id=\"containerComment\">";
        $data = Database::getOneData("SELECT logo FROM User WHERE login = \"".$row['login']."\"");
        echo "<div id=\"logoComment\">";
        echo "<img src=\"".$data['logo']."\" style=\"width:50px;height:50px;\"/><br><a href=\"\">".$row['login']."</a>";
        echo "</div>";
        echo "<div id=\"textComment\">";
        echo "<i>Posted ".$row['date']."</i><br>";
        echo $row['comment'];
        echo "</div>";
        echo "<div class=\"clear\"></div> ";
        echo "</div>";

    }

    /* --------------------------------------------- */
    $row = Database::getOneData("SELECT COUNT(*) AS count FROM Comment".$table." WHERE id".$table." = ".$id."");
    $count = $row['count'];
    $no_of_paginations = ceil($count / $per_page);

    /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
    if ($cur_page >= 7) {
        $start_loop = $cur_page - 3;
        if ($no_of_paginations > $cur_page + 3)
            $end_loop = $cur_page + 3;
        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
            $start_loop = $no_of_paginations - 6;
            $end_loop = $no_of_paginations;
        } else {
            $end_loop = $no_of_paginations;
        }
    } else {
        $start_loop = 1;
        if ($no_of_paginations > 7)
            $end_loop = 7;
        else
            $end_loop = $no_of_paginations;
    }
    /* ----------------------------------------------------------------------------------------------------------- */
    $msg .= "<div class='pagination'><ul>";

    // FOR ENABLING THE FIRST BUTTON
    if ($first_btn && $cur_page > 1) {
        $msg .= "<li p='1' class='active'>First</li>";
    } else if ($first_btn) {
        $msg .= "<li p='1' class='inactive'>First</li>";
    }

    // FOR ENABLING THE PREVIOUS BUTTON
    if ($previous_btn && $cur_page > 1) {
        $pre = $cur_page - 1;
        $msg .= "<li p='$pre' class='active'>Previous</li>";
    } else if ($previous_btn) {
        $msg .= "<li class='inactive'>Previous</li>";
    }
    for ($i = $start_loop; $i <= $end_loop; $i++) {

        if ($cur_page == $i)
            $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
        else
            $msg .= "<li p='$i' class='active'>{$i}</li>";
    }

    // TO ENABLE THE NEXT BUTTON
    if ($next_btn && $cur_page < $no_of_paginations) {
        $nex = $cur_page + 1;
        $msg .= "<li p='$nex' class='active'>Next</li>";
    } else if ($next_btn) {
        $msg .= "<li class='inactive'>Next</li>";
    }

    // TO ENABLE THE END BUTTON
    if ($last_btn && $cur_page < $no_of_paginations) {
        $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
    } else if ($last_btn) {
        $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
    }
    $goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
    $total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
    $msg = $msg . "</ul>" . $goto . $total_string . "</div>"; // Content for pagination
    echo $msg.'<br/><br/>';
}