<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();

if (!isset($session->message)) {
    $session->message = array();
}
if (isset($_GET['typeMessage'])) {
    $message = $session->message;
    $message[count($message)] = $_GET['typeMessage'];
}

?>
<div class="message-container">
    <?php
        foreach ($session->message as $m) {
            echo "<div class=\"message\">";
        
            echo "</div>";
        }
    ?>
</div>

