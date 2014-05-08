<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
?>
<section id="contenu">
    <?php
    
    ?>
    <h1> Comments </h1>
    
    <?php
        $table = $_GET['table'];
        $id = $_GET['id'];
        echo "<div id=\"containerComment\">";
        $row = Database::getAllData("SELECT * FROM ".$table." WHERE idComment = \"".$id."\"");
        $data = Database::getOneData("SELECT logo FROM User WHERE login = \"".$row['login']."\"");
        echo "<div id=\"logoComment\">";
        echo "<img src=\"".$data['logo']."\" style=\"width:50px;height:50px;\"/><br><a href=\"\">".$row['login']."</a>";
        echo "</div>";
        echo "<div id=\"textComment\">";
        echo "<i>Posted ".$row['date']."</i><br>";
        echo $row['comment'];
        echo "</div>";
        echo "<div class=\"clear\"></div> ";
        echo "</div>";    ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>