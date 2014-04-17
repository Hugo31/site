<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?>

<section id="contenu">
    <?php
    if (!isset($session->login)) {//si utilisateur non connecté
        echo '<center><h3>You must be connected in order to use this page</h3></center>';
    } else if (!(isset($_GET['type']) && isset($_GET['name']) && isset($_GET['id']))){
        echo '<center><h3>Error 400 : Bad request &nbsp;&nbsp; =(</h3></center>';
    } else {
        ?>
        <h1>Report on <?php echo $_GET['type'] . ' : ' . $_GET['name']; ?></h1>
        <h2>Please report problem description in the next field...</h2>
        <form id="formReportContent" name="formReportContent" method="post"
              <?php echo "action=\"../controller/addReport.php?type=" . $_GET['type'] . "&amp;name=" . $_GET['name'] . "&amp;id=" . $_GET['id']."\"" ?> >
            <p>
                <label for="repportMessage" style="font-size: 1.3em;font-weight: normal;color: #FF4C00; font-family: 'YanoneKaffeesatz-Regular';">Message *</label><br/>
            <textarea id="repportMessage" name="repportMessage" style="width:400px;height:200px" required placeholder="Repport Message"></textarea>
            </p>
            <input type="submit" class="add" value="Send" style="padding: 0px 20px; margin-left: 0px; height: 30px; font-size: 0.85em;">
        </form>

        <?php
    }
    ?>
</section>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
