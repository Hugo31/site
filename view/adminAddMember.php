<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitAdmin.php");

require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
$session = Session::getInstance();

?>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');   
?>
<section id="contenu">
   <?php
   if (isset($session->admin)) {
   ?>
   <h1> Add a member </h1>
   This part has not been implemented. You can just add a classic member (not an administrator) through the public part. <br/><br/>
   <h2>Procedure</h3>
   <ol>
       <li>Log out.</li>
       <li>Click on "Sign up" button</li>
       <li>Fill all fields of the form.</li>
       <li>You will receive an email to confirm the registration of the new member.</li>
   </ol>
   <?php
   } else {
       header('Location: 404.php');
   }
   ?>
</section>
<script>
    
</script>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');   
?>
