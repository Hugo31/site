<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitAdds.php");

    if (isset($_POST['idDP'])) {
        ToolkitAdds::displayDesignPatternMini($_POST['idDP']);
    }

    