<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitAdmin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 
?>

<section id="contenu">
    <?php
    if (!isset($session->admin)) { //si utilisateur non connecté
        header('Location: 404.php');
    } else {
    ?>
        <h1> Manage users </h1>
        <div id="manageUsers">
        <img src="/site/img/vrac/add.png" style="vertical-align:middle;">  <a href="adminAddMember.php">Add a new member</a>
        </div>
        <br/>    
    <?php 
        ToolkitAdmin::displayUserBox(Database::getAllData("SELECT * FROM User order by typeUser desc, login asc"));
    }  
    ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
