<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo $session->query;
        ?>
    </body>
</html>
