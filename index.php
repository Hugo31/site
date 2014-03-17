<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');   

?>

<section id="contenu">
    <h1> Home </h1>
    Welcome to UI Design Pattern Community
    <br/><?php echo ' > login : ' . $_SESSION['login'] .'' ?>
    <br/>
    <br/><a href="/site/testJquery/testModelPage.php">Test Model</a>
    <br/><a href="/site/view/addDesignPattern.php">Page test ajout de DP</a>
    <br/><a href="/site/view/addProject.php">Page test ajout de projet</a>
    <h2>Website goals</h2>
    This site allows sharing and community management of design patterns. It allows you to search design patterns based on several criteria
    and specific needs related to a project. It should also allow to comment on design patterns, report conflicts between them 
    and provide solutions to these conflicts.
    
    <h2>Contribute to the community</h2>
    <h3>> Why?</h3>
    You will find on this website peoples sharing an interest for user's interfaces and human centered interactions. By sharing your design patterns 
    you may get constructive discussions about them and help on whatever problems you might get. On the other hand you can help others users by rating 
    and commenting, suggest solutions and report conflicts you might find.
    
    <h3>> How?</h3>
    All you need to do is create a free account and login. All new members and contributions to our community are welcomed.
    
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');   
?>
