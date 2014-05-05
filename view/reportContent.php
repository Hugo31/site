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
    } else if (!(isset($_GET['type']) && isset($_GET['name']) && isset($_GET['id']))) {
        echo '<center><h3>Error 400 : Bad request &nbsp;&nbsp; =(</h3></center>';
    } else {
        ?>
<h1>Report on <?php echo $_GET['type'] . ' : ' . $_GET['name']; ?></h1>
Please report problem description in the next field...<br/><br/>
<form id="formReportContent" name="formReportContent" method="post" action="../controller/addReport.php">
<?php
      echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"".$_GET['id']."\"/>";
      echo "<input type=\"hidden\" id=\"type\" name=\"type\" value=\"".$_GET['type']."\"/>";
      echo "<input type=\"hidden\" id=\"name\" name=\"name\" value=\"".$_GET['name']."\"/>"; ?>
<table>
<tr>
<td style="vertical-align:top;"><label for="repportMessage">Message&nbsp;&nbsp;</label></td>
<td><textarea id="repportMessage" name="repportMessage" style="min-width:400px;max-width:600px;min-height:200px;max-height:400px" autofocus required placeholder="Repport Message"></textarea></td>
</tr>
</table>
<br/>
<center><input type="submit" class="add" value="Send" style="padding: 0px 20px; margin-left: 0px; height: 30px; font-size: 0.85em;"></center>
</form>

<?php
    }
    ?>
</section>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');