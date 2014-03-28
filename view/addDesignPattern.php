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
    
    function increasesizediv(div, size){//increase height by size
        var c = document.getElementById(div);
        var e = c.style.height;
        e = e.replace('px','');
        var $c = 1;
        var i = 0;
        while($c===1){ i++; if(i===size){ break; } e++; c.style.height = e+'px'; }
    }
    
    function decreasesizediv(div, size){//decrease height by size
        var c = document.getElementById(div);
        var e = c.style.height;
        e = e.replace('px','');
        var $c = 1;
        var i = 0;
        while($c===1){ i++; if(i===size){ break; } e--; c.style.height = e+'px'; }
    }
    
    function addsources() {
        var myForm = document.getElementsByName("source[]");
        var originalFormLength = myForm.length;
        var tmpValues = new Array();

        for(var i = 0; i < originalFormLength; i++){
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
        
        for(var j = 0; j < originalFormLength; j++){
           myForm.item(j).value = tmpValues[j];
        }
    };
    function addimagelink() {
        var myForm = document.getElementsByName("image[]");
        var originalFormLength = myForm.length;
        var tmpValues = new Array();

        for(var i = 0; i < originalFormLength; i++){
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
        
        for(var j = 0; j < originalFormLength; j++){
           myForm.item(j).value = tmpValues[j];
        }
    };
    
    function addimageupload() {
        var myForm = document.getElementsByName("image[]");
        var originalFormLength = myForm.length;
        var tmpValues = new Array();

        for(var i = 0; i < originalFormLength; i++){
           tmpValues[i] = myForm.item(i).value;
        }
    
        if (images !== MAXIMAGES) {
            document.getElementById('tableImages').innerHTML += '<tr><td style="width:100px"><label for="imageup">Image upload</label></td><td><input type="file" name="file[]"></td></tr>';            
            images += 1;
            increasesizediv('main', 30);
            if (images === MAXIMAGES) {
                document.getElementById('addImageLink').disabled=true;
                document.getElementById('addImageUpload').disabled=true;
                document.getElementById('addImageLink').title = "You can't add more than " + MAXIMAGES + " images";
                document.getElementById('addImageUpload').title = "You can't add more than " + MAXIMAGES + " images";
            }
        }
        
        for(var j = 0; j < originalFormLength; j++){
           myForm.item(j).value = tmpValues[j];
        }
    };
    
    hideblock = function(a){
        $(a).attr("onclick","return showblock($(this));");
        $(a).text("[+]");
        $(a).parent().children("p").first().hide().end();
        
        decreasesizediv('main', $(a).parent().children("p").first().height());
        
        return!1;
    };
    
    showblock = function(a){
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
    if(!isset($session->login)){//si utilisateur non connecté
        echo '<h3>You must be connected in order to use this page</h3>';
    }
    else{
        //$bdd = Database::getConnection();
    ?>
        <h2> Add a Design Pattern </h2>
        <div id="main" style="width:780px;float:left;height:1250px;">
            
            <div id="formulaireAddDP">
                <form id="addDP_form" name="addDP_form" method="post" enctype="multipart/form-data">
                    
                    <h3> Main informations </h3>
                    
                    <table id="tableAddDP">
                        <tr>
                            <td style="width:100px"><label for="namee">Name</label></td>
                            <td><input style="width:400px" id="namee" type="text" value="" name="namee" size="40" required autofocus placeholder="Name of this Design Pattern"></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="what">What</label></td>
                            <td><textarea id="what" name="what" style="width:400px;height:200px" required placeholder="Resume of this Design Pattern"></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="wah">When And How</label></td>
                            <td><textarea id="wah" name="wah" style="width:400px;height:80px" required placeholder="?"></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="layout">Layout</label></td>
                            <td><textarea id="layout" name="layout" style="width:400px;height:80px" required placeholder="?"></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="copy">Copy</label></td>
                            <td><textarea id="copy" name="copy" style="width:400px;height:80px" required placeholder="?"></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100px"><label for="impl">Implementation</label></td>
                            <td><textarea id="impl" name="impl" style="width:400px;height:80px" required placeholder="?"></textarea></td>
                        </tr>                    
                        <tr>
                            <td style="width:100px"><label>Target</label></td>
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
                    <input type="button" onclick="addimagelink()" id="addImageLink" name="addImageLink" value="Add image link" />
                    <input type="button" onclick="addimageupload()" id="addImageUpload" name="addImageUpload" value="Upload image" />
                    <input type="button" onclick="addsources()" id="addSource" name="addSource" value="Add source" />
                    
                    
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
                        <input type="submit" value="Add Design Pattern" style="margin-left: 15px " onclick="this.form.action='../controller/validAddDP.php'">
                    </center>
                </form>
            </div>
        </div>
    <?php } ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
