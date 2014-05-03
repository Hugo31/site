<?php

    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>
<section id="contenu">
    <?php
    
    ?>
<h1> Results </h1>
<form id="sort_form">
<label>Sort by: </label>
<select name="typeSort">
<option value="name" <?php if (isset($_GET['typeSort'])) { if ($_GET['typeSort'] == "name") { echo "selected";}} ?>>Name</option>
<option value="date" <?php if (isset($_GET['typeSort'])) { if ($_GET['typeSort'] == "date") { echo "selected";}} ?>>Most recent</option>
<?php
            if ($session->typeQuery == "DesignPattern" || $session->typeQuery == "Solution") {
            ?>
<option value="rate" <?php if (isset($_GET['typeSort'])) { if ($_GET['typeSort'] == "rate") { echo "selected";}} ?>>Hightest rated</option>
<?php
                if ($session->typeQuery == "DesignPattern") {
            ?>
<option value="nbUsage" <?php if (isset($_GET['typeSort'])) { if ($_GET['typeSort'] == "nbUsage") { echo "selected";}} ?>>Most popular</option>
<?php
                }
            }
            ?>
</select>
<input type="submit" value="SORT" class="sort"/>
</form>
<br><br>
<?php
        
        $bdd = Database::getConnection();
        $req = $session->query;
        if (isset($_GET['typeSort'])) {
            $req .= " ORDER BY ".$_GET['typeSort'];
            if ($_GET['typeSort'] != "name") {
                $req .= " DESC";
            }
        }
        else{
            $result = $bdd->query($session->query);
        }
        
        $result = $bdd->query($req);

        ToolKitDisplay::displayGenericBox($session->typeQuery, $result);
    ?>
</section>
<script>
$("details").hide();
</script>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');
?>