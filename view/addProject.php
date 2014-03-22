<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 
    
    
    
?>

<section id="contenu">
    
    <?php
    if(!isset($session->login)){//si utilisateur non connecté
        echo '<h3>You must be connected in order to use this page</h3>';
    }
    else{
    ?>
    
    <h2> Create your project </h2>
    
    <div style="width:540px;float:left;height:700px;">
        <br/><br/>
        <div id="formulaireAddProject">
            <form id="addProject_form" method="post">
                <table>
                    <tr>
                        <td style="width:400px"><label for="namee">Name</label></td>
                        <td><input id="namee" type="text" value="" name="namee" size="40" required autofocus placeholder="Name of your project"></td>
                    </tr>
                    <tr>
                        <td style="width:400px"><label for="description">Description</label></td>
                        <td><textarea id="description" name="description" style="width:256px;height:100px" required placeholder="Description of your project"></textarea></td>
                    </tr>
                </table>
                <br/>
                <center>
                    <input type="submit" value="Create" class="addProject" style="margin-left: 15px " onclick="this.form.action='../controller/validAddProject.php'">
                </center>
            </form>
        </div>
    </div>
    <?php } ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
