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
        <h2> Add a Design Pattern </h2>
        <div style="width:540px;float:left;height:700px;">
            <br/><br/>
            <div id="formulaireAddDP">
                <form id="addDP_form" method="post">
                    <table>
                        <tr>
                            <td style="width:400px"><label for="namee">Name</label></td>
                            <td><input id="namee" type="text" value="" name="namee" size="40" required autofocus placeholder="Name of this Design Pattern"></td>
                        </tr>
                        <tr>
                            <td style="width:400px"><label for="what">What</label></td>
                            <td><textarea id="what" name="what" style="width:400px;height:300px" required placeholder="Resume of this Design Pattern"></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:400px"><label for="wah">When And How</label></td>
                            <td><input id="wah" type="text" value="/" name="wah" size="40" required placeholder="?"></td>
                        </tr>
                        <tr>
                            <td style="width:400px"><label for="layout">Layout</label></td>
                            <td><input id="layout" type="text" value="/" name="layout" size="40" required placeholder="?"></td>
                        </tr>
                        <tr>
                            <td style="width:400px"><label for="copy">Copy</label></td>
                            <td><input id="copy" type="text" value="/" name="copy" size="40" required placeholder="?"></td>
                        </tr>
                        <tr>
                            <td style="width:400px"><label for="impl">Implementation</label></td>
                            <td><input id="impl" type="text" value="/" name="impl" size="40" required placeholder="?"></td>
                        </tr>                    
                        <tr>
                            <td style="width:400px"><label>Target</label></td>
                            <td>
                                <select id="subject" name="thetarget" required placeholder="?">
                                    <option value="Designer" selected>Designer</option>
                                    <option value="Evaluator">Evaluator</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td style="width:400px"><label for="img">(Optional) Image</label></td>
                            <td><input id="img" type="url" value="" name="img" size="40" placeholder="Copy the image url"></td>
                        </tr>
                    </table>
                    <br/>
                    <center>
                        <input type="submit" value="Preview" class="addDP" style="margin-right: 15px" onclick="this.form.action='previewAddDP.php'">
                        <input type="submit" value="Add Design Pattern" class="addDP" style="margin-left: 15px " onclick="this.form.action='../controller/validAddDP.php'">
                    </center>
                </form>
            </div>
        </div>
    <?php } ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
