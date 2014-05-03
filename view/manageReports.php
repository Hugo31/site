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
    
    function deleteReport(id, type) {
        $.ajax({
            url:'../controller/deleteReports.php',
            type: 'post',
            async: false,
            data: { "idReported": id, "typeReported": type},
            complete: function(data) {
                setTimeout(
                    function() {
                       location.reload();
                    }, 1);    
            }
                
       });
   }
   
   function deleteReportedObject(id, type) {
        $.ajax({
            url:'../controller/deleteReportedObject.php',
            type: 'post',
            async: false,
            data: { "idReported": id, "typeReported": type},
            complete: function(data) {
                setTimeout(
                    function() {
                       location.reload();
                    }, 1);    
            }
                
       });
   }
    
   hideblock = function(a, index) {
        $(a).attr("onclick","return showblock($(this)," + index + ");");
        $(a).text("[+]");
        $(a).parent().children("p").eq(index).hide().end();
        
        return!1;
    };
    
    showblock = function(a, index) {
        $(a).attr("onclick","return hideblock($(this)," + index + ");");
        $(a).text("[-]");
        $(a).parent().children("p").eq(index).show().end();
        $(a).show();

        return!1;
    };
</script>

<section id="contenu">
    <?php
    
    
    if (!isset($session->admin)) { //si utilisateur non connecté
        echo '<center><h3>You must be connected in order to use this page</h3></center>';
    } else {
        echo '<h1> Users reports </h1>';

        $bdd = Database::getConnection();
        $sql = "SELECT idReported, typeReported FROM `reporting` GROUP BY idReported, typeReported";
        $result = $bdd->query($sql);
        if ($result->rowCount() != 0) {
            foreach ($result as $row) {
                ToolkitAdds::displayReportMini($row[0], $row[1]);
            }
        } else {
            echo 'No report found';
        }
        
        
        
        
    }?>  
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php'); 
