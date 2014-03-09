<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 
    
    
    if(1){//si utilisateur non connecté
    //renvoyer vers page login avec message erreur
        //header('Location: /site/index.php');
        echo '<h3>Not logged!</h3>';
    }
?>

<section id="contenu">
    <h2> Add a Design Pattern </h2>
    
    <div style="width:540px;float:left;height:700px;">
        <font style="color:#FF4C00">> All fields are required.</font>
        <br/><br/>
        <div id="formulaireAddDP">
            <form id="addDP_form" method="post">
                <table>
                    <tr>
                        <td style="width:300px"><label for="namee">Name</label></td>
                        <td><input id="namee" type="text" value="" name="namee" size="40" required autofocus placeholder="Name of this Design Pattern"></td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label for="what">What</label></td>
                        <td><input id="what" type="text" value="" name="what" size="40" required autofocus placeholder="Resume of this Design Pattern"></td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label for="wah">When And How</label></td>
                        <td><input id="wah" type="text" value="/" name="wah" size="40" required placeholder="?"></td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label for="layout">Layout</label></td>
                        <td><input id="layout" type="text" value="/" name="layout" size="40" required placeholder="?"></td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label for="copy">Copy</label></td>
                        <td><input id="copy" type="text" value="/" name="copy" size="40" required placeholder="?"></td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label for="impl">Implementation</label></td>
                        <td><input id="impl" type="text" value="/" name="impl" size="40" required placeholder="?"></td>
                    </tr>                    
                    <tr>
                        <td style="width:300px"><label>Target</label></td>
                        <td>
                            <select id="subject" name="thetarget" required placeholder="?">
                                <option value="Designer" selected>Designer</option>
                                <option value="Evaluator">Evaluator</option>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label for="img">(Optional) Image</label></td>
                        <td><input id="img" type="url" value="" name="img" size="40" placeholder="Copy the image url"></td>
                    </tr>                    
                    <tr>
                </table>
                <br/>
                <center>
                    <input type="submit" value="Preview" class="addDP" style="margin-right: 15px" onclick="this.form.action='previewAddDP.php'">
                    <input type="submit" value="Finish" class="addDP" style="margin-left: 15px " onclick="this.form.action='../ajoutsDB/validAddDP.php'">
                </center>
            </form>
        </div>
    </div>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 