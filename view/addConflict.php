<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitAdds.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php'); 

?>

<script>
    
    function displayDP2(sel){
        
        document.getElementById('DP2').innerHTML = '<?php ToolkitAdds::displayDesignPatternMini($_GET['id']) ?>';
        
        //var value = sel.options[sel.selectedIndex].value;
    }
</script>

<body onload="javascript:function():">
    
<section id="contenu">
    
    <?php
    if(!isset($session->login)){//si utilisateur non connecté
        echo '<h3>You must be connected in order to use this page</h3>';
    }
    else{
        $bdd = Database::getConnection();
    ?>
    
    <h2> Report conflicts </h2>
    <div style="width:540px;float:left;height:700px;">
        <form id="addConflict_form" method="post">
            
            <?php
            if (isset($_GET['id'])){
                ToolkitAdds::displayDesignPatternMini($_GET['id']);
            }

            $sql = " SELECT idDesignPattern, name FROM DesignPattern WHERE idDesignPattern <> " . $_GET['id'] . ";";
            $result = $bdd->query($sql);

            echo "
            <table>
                <tr><td> DP en conflit : 
                <select name='selectDP2' required onchange='displayDP2(this)'>
                    <option selected disabled hidden>Choose</option>";
                    foreach($result as $row){
                        echo"<option value='$row[0]'>$row[1]</option>";
                    }
                echo"</select></td></tr>
            </table>";
            ?>
            <div id="DP2"></div>
            <br/><br/>
            <div id="formulaireAddConflict">
                <table>
                    <tr>
                        <td style="width:400px"><label for="namee">Name</label></td>
                        <td><input id="namee" type="text" value="" name="namee" size="40" required autofocus placeholder="Name the conflict"></td>
                    </tr>
                    <tr>
                        <td style="width:400px"><label for="description">Description</label></td>
                        <td><textarea id="description" name="description" style="width:256px;height:100px" required placeholder="Add a description of this conflict"></textarea></td>
                    </tr>
                    <tr>
                        <td style="width:400px"><label for="typee">Type</label></td>
                        <td><select id="typee" name="typee" required>
                            <option selected disabled hidden>Choose</option>
                            <?php
                                $sql = " SELECT idTypeConflict, name FROM TypeConflict;";
                                $result = $bdd->query($sql);
                                foreach($result as $row){
                                    echo"<option value='$row[0]'>$row[1]</option>";
                                }
                            ?>
                        </select></td>
                    </tr>
                </table>
                <br/>
                <input id="DP1" type="text" value="<?php echo $_GET['id']?>" name="DP1"  hidden>
                <center>
                    <input type="submit" value="Add Conflict" style="margin-left: 15px " onclick="this.form.action='../controller/validAddConflict.php'">
                </center>
            </div>
        </form>
    </div>
    
    <?php } ?>
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
