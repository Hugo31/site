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
    
    ?>
    <?php
    if (!isset($session->admin)) { //si utilisateur non connecté
        echo '<center><h3>You must be connected in order to use this page</h3></center>';
    } else {
    ?>
        <h1> Manage users </h1>
        <div id="manageUsers">
        <img src="/site/img/vrac/add.png" style="vertical-align:middle;">  <a href="adminAddMember.php">Add a new member</a>
        | <img src="/site/img/vrac/mail.png" style="vertical-align:middle;">  <a href="adminSendEmail.php">Send email to members</a>
        </div>
        <br/>
        
        
    <?php 
    ToolkitAdmin::displayUserBox(Database::getAllData("SELECT * FROM User"));
    
    
    }  ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
