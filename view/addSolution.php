<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 
    
    
    
?>

<section id="contenu">
    <h2> Propose a solution </h2>
    
    
    <?php
    if(1){//si utilisateur non connecté
    //renvoyer vers page login avec message erreur
        //header('Location: /site/index.php');
        echo '<h3>Not logged!</h3>';
    }
    
    if (isset($_GET['id'])){
        ToolkitDisplay::displayConflictMini($_GET['id']);
    }
    ?>
    
    <div style="width:540px;float:left;height:700px;">
        <br/><br/>
        <div id="formulaireAddSolution">
            <form id="addSolution_form" method="post">
                <table>
                    <tr>
                        <td style="width:400px"><label for="namee">Name</label></td>
                        <td><input id="namee" type="text" value="" name="namee" size="40" required autofocus placeholder="Name of the solution"></td>
                    </tr>
                    <tr>
                        <td style="width:400px"><label for="comment">Comment</label></td>
                        <td><textarea id="comment" name="comment" style="width:256px;height:100px" required placeholder="Comment your solution"></textarea></td>
                    </tr>
                    <tr>
                        <td style="width:400px"><label for="code">Code</label></td>
                        <td><textarea id="code" name="code" style="width:256px;height:100px" required placeholder="Solution's code"></textarea></td>
                    </tr>
                </table>
                <br/>
                <input id="DP1" type="text" value="<?php echo $_GET['id']?>" name="conflict"  hidden>
                <center>
                    <input type="submit" value="Post Solution" class="addSolution" style="margin-left: 15px " onclick="this.form.action='../controller/validAddSolution.php'">
                </center>
            </form>
        </div>
    </div>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
