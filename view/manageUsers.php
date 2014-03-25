<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 
?>

<section id="contenu">
    
    <?php
    if(isset($session->admin)){//si utilisateur non connecté
    ?>
        <h1> Manage users </h1>
        <br/><img src="/site/img/vrac/people.png" width="200px" style="float:left;vertical-align:middle;margin-left:20px; margin-top:10px;">
        <div style="margin-left:200px;">
            <blockquote>
                <a href="adminVisualizeMembers.php"><img src="/site/img/vrac/v.png" width="20px" style="vertical-align:middle;"> Visualize all members</a>
                <br/><br/>
                <a href="adminAddMember.php"><img src="/site/img/vrac/add.png" width="20px" style="vertical-align:middle;"> Add a new member</a>
                <br/><br/>
                <a href="adminSendEmail.php"><img src="/site/img/vrac/mail.png" width="20px" style="vertical-align:middle;"> Send email to members</a>
            </blockquote>
        </div>
        
    <?php } else{
        echo "You must be connected.";
    } ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
