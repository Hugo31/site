<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');   
?>

<section id="contenu">
    <h1> Home </h1>
    Welcome to uidesignpatterncommunity
    <a href="/site/testJquery/testModelPage.php">Test Model</a>
    <br/><a href="/site/view/addDesignPattern.php">Page test Ajout de DP</a>
    <h2>Website goals</h2>
    This site allows sharing and community management of design patterns. It allows you to search on several criteria required design patterns 
    to specific needs related to a project. It should also allow comment these design patterns, report conflicts between different design patterns 
    and provide solutions to these conflicts.
    
    <h2>Contribute to the community</h2>
    <h3>> Why?</h3>
    You will find in our community peoples sharing an interest for user's interfaces and human centered interactions. By sharing your design patterns you may
    get constructive discussions about it and help on whatever problems you might get. On the other hand you can help others users by rating and commenting, 
    suggest solutions and signal conflicts you might find.
    
    <h3>> How?</h3>
    <div id="zonegrise">
        All you need to do is to create a free account and login. All new members and contributions to our community are welcomed.
    </div>
    
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');   
?>
