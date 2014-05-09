<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitAdds.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 
    
?>

<script type="text/javascript">
    
    sources = 0;
    images = 0;
    
    MAXSOURCES = 7;
    MAXIMAGES = 10;
    
    function increasesizediv(div, size) {//increase height by size
        var c = document.getElementById(div);
        var e = c.style.height;
        e = e.replace('px','');
        var $c = 1;
        var i = 0;
        while($c===1) { i++; if (i===size) { break; } e++; c.style.height = e+'px'; }
    }
    
    function decreasesizediv(div, size) {//decrease height by size
        var c = document.getElementById(div);
        var e = c.style.height;
        e = e.replace('px','');
        var $c = 1;
        var i = 0;
        while($c===1) { i++; if (i===size) { break; } e--; c.style.height = e+'px'; }
    }
    
    function addsources() {
        var myForm = document.getElementsByName("source[]");
        var originalFormLength = myForm.length;
        var tmpValues = new Array();

        for (var i = 0; i < originalFormLength; i++) {
           tmpValues[i] = myForm.item(i).value;
        }

        if (sources !== MAXSOURCES) {
            document.getElementById('tableSources').innerHTML += '<tr><td style="width:100px"><label for="source">Source</label></td><td><input id="source" type="url" value="" name="source[]" size="50" style="width:400px" required placeholder="Source url"></td></tr>';            
            sources += 1;
            increasesizediv('main', 30);
            if (sources === MAXSOURCES) {
                document.getElementById('addSource').disabled=true;
                document.getElementById('addSource').title = "You can't add more than " + MAXSOURCES + " sources";
            }
        }
        
        for (var j = 0; j < originalFormLength; j++) {
           myForm.item(j).value = tmpValues[j];
        }
    };
    function addimagelink() {
        var myForm = document.getElementsByName("image[]");
        var originalFormLength = myForm.length;
        var tmpValues = new Array();

        for (var i = 0; i < originalFormLength; i++) {
           tmpValues[i] = myForm.item(i).value;
        }
    
        if (images !== MAXIMAGES) {
            document.getElementById('tableImages').innerHTML += '<tr><td style="width:100px"><label for="imagelink">Image link</label></td><td><input id="imagelink" type="url" value="" name="image[]" size="50" style="width:400px" required placeholder="Image url"></td></tr>';            
            images += 1;
            increasesizediv('main', 30);
            if (images === MAXIMAGES) {
                document.getElementById('addImageLink').disabled=true;
                document.getElementById('addImageUpload').disabled=true;
                document.getElementById('addImageLink').title = "You can't add more than " + MAXIMAGES + " images";
                document.getElementById('addImageUpload').title = "You can't add more than " + MAXIMAGES + " images";
            }
        }
        
        for (var j = 0; j < originalFormLength; j++) {
           myForm.item(j).value = tmpValues[j];
        }
    };
    
    function addimageupload() {
        var myForm = document.getElementsByName("image[]");
        var originalFormLength = myForm.length;
        var tmpValues = new Array();

        for (var i = 0; i < originalFormLength; i++) {
           tmpValues[i] = myForm.item(i).value;
        }
    
        if (images !== MAXIMAGES) {
            document.getElementById('tableImages').innerHTML += '<tr><td style="width:100px"><label for="imageup">Image upload</label></td><td><input type="file" accept="image/*" name="file[]"></td></tr>';            
            images += 1;
            increasesizediv('main', 30);
            if (images === MAXIMAGES) {
                document.getElementById('addImageLink').disabled=true;
                document.getElementById('addImageUpload').disabled=true;
                document.getElementById('addImageLink').title = "You can't add more than " + MAXIMAGES + " images";
                document.getElementById('addImageUpload').title = "You can't add more than " + MAXIMAGES + " images";
            }
        }
        
        for (var j = 0; j < originalFormLength; j++) {
           myForm.item(j).value = tmpValues[j];
        }
    };
    
    hideblock = function(a) {
        $(a).attr("onclick","return showblock($(this));");
        $(a).text("[+]");
        $(a).parent().children("p").first().hide().end();
        
        decreasesizediv('main', $(a).parent().children("p").first().height());
        
        return!1;
    };
    
    showblock = function(a) {
        $(a).attr("onclick","return hideblock($(this));");
        $(a).text("[-]");
        $(a).parent().children("p").first().show().end();
        $(a).show();
        increasesizediv('main', $(a).parent().children("p").first().height());

        return!1;
    };
</script>


<section id="contenu">
    <?php
    
    
    if (!isset($session->login)) {//si utilisateur non connecté
        header('Location: 404.php');
    } else {
        //$bdd = Database::getConnection();
    ?>
        <h2> Add a Design Pattern </h2>
        <div id="main" style="width:800px;float:left;height:1250px;">
            
            <div id="formulaireAddDP">
                <form id="addDP_form" name="addDP_form" method="post" enctype="multipart/form-data">
                    
                    <h3> Main informations </h3>
                    <font style="color:#FF4C00">* Required fields.</font><br/><br/>
                    <table id="tableAddDP">
                        <tr>
                            <td style="width:150px"><label for="namee">Name: <font color="#FC40000">*</font></label></td>
                            <td><input style="width:400px" id="namee" type="text" value="" name="namee" size="40" required autofocus placeholder="Give a concise and clear name to the Design Pattern"></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="what">What: <font color="#FC40000">*</font></label></td>
                            <td><textarea id="what" name="what" style="min-width:400px;min-height:100px;max-width:500px;max-height:400px" required placeholder="Description of the pattern. A precise and large description will help users to clearly understand the pattern."></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="wah">When And How: </label></td>
                            <td><textarea id="wah" name="wah" style="min-width:400px;min-height:100px;max-width:500px;max-height:400px" placeholder="Examples and rationale for cases when this pattern must be applied, when it should, when it shouldn’t and when it mustn’t (anti-patterns)."></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="layout">Layout: </label></td>
                            <td><textarea id="layout" name="layout" style="min-width:400px;min-height:100px;max-width:500px;max-height:400px" placeholder="Advices about visual implementation of the pattern."></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="copy">Copy: </label></td>
                            <td><textarea id="copy" name="copy" style="min-width:400px;min-height:100px;max-width:500px;max-height:400px" placeholder="Advices about the copywriting."></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="impl">Implementation: </label></td>
                            <td><textarea id="impl" name="impl" style="min-width:400px;min-height:100px;max-width:500px;max-height:400px" placeholder="Technical advices."></textarea></td>
                        </tr>                    
                        <tr>
                            <td style="width:100px"><label>Target: <font color="#FC40000">*</font></label></td>
                            <td>
                                <select id="subject" style="width:406px" name="thetarget" required>
                                    <option selected disabled hidden>Choose</option>
                                    <option value="Designer">Designer</option>
                                    <option value="Evaluator">Evaluator</option>
                                </select> 
                            </td>
                        </tr>
                        
                    </table>
                    
                    <br/><h3> Optional informations </h3>
                    <h4>Images & Sources</h4>
                    <input class="add" type="button" onclick="addimagelink()" id="addImageLink" name="addImageLink" value="Add image link" />
                    <input class="add" type="button" onclick="addimageupload()" id="addImageUpload" name="addImageUpload" value="Upload image" />
                    <input class="add" type="button" onclick="addsources()" id="addSource" name="addSource" value="Add source" />
                    
                    
                    <table id="tableImages"></table>
                    <table id="tableSources"></table>
                    
                    <h4>Criteria</h4>
                    <?php
                        ToolKitAdds::displayCriteriaAddDP("Category");
                        ToolKitAdds::displayCriteriaAddDP("Component");
                        ToolKitAdds::displayCriteriaAddDP("Platform");
                        ToolKitAdds::displayCriteriaAddDP("Property");
                        ToolKitAdds::displayCriteriaAddDP("System");
                    ?>
                        
                    <br/>
                    <center>
                        <input type="submit" class="add" value="Add Design Pattern" style="margin-left: 15px " onclick="this.form.action='../controller/validAddDP.php'">
                    </center>
                </form>
            </div>
        </div>
    <?php } ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
