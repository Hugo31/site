<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitAdds.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 
    
    if (!isset($session->login)) {//si utilisateur non connecté
        echo '<center><h3>You must be connected in order to use this page</h3></center>';
    } else {   
        if (!isset($_GET['id'])) {
            echo '<h3>Error</h3>';
        } else {
    
?>

<section id="contenu">

    <h2> Propose a solution </h2>
    <h3>Solution to : </h3>
    <?php ToolkitAdds::displayConflictMini($_GET['id']); ?>
    
    <div style="width:780px;float:left;height:700px;">
        <br/><br/>
        <div id="formulaireAddSolution">
            <form id="addSolution_form" method="post">
                <table>
                    <tr>
                        <td style="width:100px"><label for="namee">Name</label></td>
                        <td><input id="namee" style="width:400px" type="text" value="" name="namee" size="40" required autofocus placeholder="Name of the solution"></td>
                    </tr>
                    <tr>
                        <td style="width:100px"><label for="comment">Comment</label></td>
                        <td><textarea id="comment" name="comment" style="width:400px;height:200px" required placeholder="Comment your solution"></textarea></td>
                    </tr>
                    <tr>
                        <td style="width:100px"><label for="code">Code</label></td>
                        <td><textarea id="code" name="code" style="width:400px;height:300px" required placeholder="Solution's code"></textarea></td>
                    </tr>
                </table>
                <br/>
                <input id="DP1" type="text" value="<?php echo $_GET['id']?>" name="conflict"  hidden>
                <center>
                    <input type="submit" class="add" value="Post Solution" style="margin-left: 15px " onclick="this.form.action='../controller/validAddSolution.php'">
                </center>
            </form>
        </div>
    </div>
    <?php }} ?>
    
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
