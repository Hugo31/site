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
        if (isset($session->admin)) {
            $table = $_GET['table'];
            $id = $_GET['id'];
            echo "<div id=\"containerComment\">";
            $resComment = Database::getOneData("SELECT * FROM ".$table." WHERE idComment = \"".$id."\"");
            $data = Database::getOneData("SELECT logo FROM User WHERE login = \"".$resComment['login']."\"");
            echo "<div id=\"logoComment\">";
            echo "<img src=\"".$data['logo']."\" style=\"width:50px;height:50px;\"/><br><a href=\"\">".$resComment['login']."</a>";
            echo "</div>";
            echo "<div id=\"textComment\">";
            echo "<i>Posted ".$resComment['date']."</i><br>";
            echo $resComment['comment'];
            echo "</div>";
            echo "<div class=\"clear\"></div> ";
            echo "</div>";    
        } else {
            header('Location: 404.php');
        }
?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>