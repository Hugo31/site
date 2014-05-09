<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitAdds.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 

?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
<script>
    
    NB_DP = 0;
    
    function addDPInConflict(id) {
        $.ajax({
            url:'../controller/miniDPTrigger.php',
            type: 'post',
            data: { "idDP": id.options[id.selectedIndex].value},
            complete: function (response) {
               $('#DP2').append(response.responseText);
            },
            error: function () {
               $('#DP2').append('Error!');
            }
        });
        $('<input type="hidden">').attr({
            name: 'listDP[]',
            value: id.options[id.selectedIndex].value
        }).appendTo('#addConflict_form');
        
        NB_DP++;
        if (NB_DP === 1) {
           document.getElementById('go').disabled=false;
           document.getElementById('go').title = "Send";
        }
        id.remove(id.selectedIndex);
        
        if (id.length === 1){
            id.style.display="none";
            document.getElementById('inst').innerHTML = "All available Design Patterns have been added";
        }
        else{
            id.selectedIndex = 0;
        }
        increasesizediv('main', 60);
     }
     
    function increasesizediv(div, size) {//increase height by size
        var c = document.getElementById(div);
        var e = c.style.height;
        e = e.replace('px','');
        var $c = 1;
        var i = 0;
        while($c===1) { i++; if (i===size) { break; } e++; c.style.height = e+'px'; }
    }

</script>

<body onload="javascript:function():">
    
<section id="contenu">
    <?php
    
    if (!isset($session->login)) {//si utilisateur non connecté
        echo '<center><h3>You must be connected in order to use this page</h3></center>';
    } else {
        $bdd = Database::getConnection();
    ?>
    
    <h2> Report conflicts </h2>
    <div id="main" style="width:780px;float:left;height:700px;">
        
        <form id="addConflict_form" method="post">
            
            <h3>Design patterns in conflict</h3>
            <?php
            if (isset($_GET['id'])) {
                ToolkitAdds::displayDesignPatternMini($_GET['id']);
            }
            echo '<div id="DP2"></div>';
            $sql = " SELECT idDesignPattern, name FROM DesignPattern WHERE idDesignPattern <> " . $_GET['id'] . ";";
            $result = $bdd->query($sql);

            echo "<h3>Select a Design pattern in this list to add it</h3>
                <select style='width:300px' name='listDP' onchange='addDPInConflict(this)'>
                    <option selected disabled hidden>Choose</option>";
                    foreach ($result as $row) {
                        echo"<option value='$row[0]'>$row[1]</option>";
                    }
                echo"</select>";
            ?>
            <div id='inst'></div>
            <br/><br/>
            <h3>Add informations</h3>
            <font style="color:#FF4C00">> All fields are required.</font><br/><br/>
            <div id="formulaireAddConflict">
                <table>
                    <tr>
                        <td style="width:100px"><label for="namee">Name: </label></td>
                        <td><input style="width:400px" id="namee" type="text" value="" name="namee" size="40" required autofocus placeholder="Give a concise and clear name to the conflict"></td>
                    </tr>
                    <tr>
                        <td style="width:100px"><label for="description">Description: </label></td>
                        <td><textarea id="description" name="description" style="min-width:400px;min-height:100px;max-width:500px;max-height:400px" required placeholder="Description of the conflict you found. A precise description will help users to clearly understand the problem."></textarea></td>
                    </tr>
                    <tr>
                        <td style="width:100px"><label for="typee">Type: </label></td>
                        <td><select style="width:406px" id="typee" name="typee" required>
                            <option selected disabled hidden>Choose</option>
                            <?php
                                $sql = " SELECT idTypeConflict, name FROM TypeConflict;";
                                $result = $bdd->query($sql);
                                foreach ($result as $row) {
                                    echo"<option value='$row[0]'>$row[1]</option>";
                                }
                            ?>
                        </select></td>
                    </tr>
                </table>
                <br/>
                <input id="DP1" type="text" value="<?php echo $_GET['id']?>" name="DP1" hidden>
                <center>
                    <input id="go" type="submit" class="add" title="You need to select at least 2 DP" disabled value="Add Conflict" style="margin-left: 15px " onclick="this.form.action='../controller/validAddConflict.php'">
                </center>
            </div>
            
        </form>
    </div>
    
    <?php } ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
