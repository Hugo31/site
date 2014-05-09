<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/controller/toolkit/Session.php");
$session = Session::getInstance();
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/search.php');
?> 

<section id="contenu">
    <h1> Welcome to UI Design Pattern Community </h1>
    <div style="border:1px solid #fc4000;padding:10px;">
        <center><h3 style="margin:0 auto">This site is a beta version. Please, accept our apologies for various inconveniences that you could meet.</h3></center>
    </div>
    <h2>Website goals</h2>
    <p style="font-size: 1.05em">
        Hi ! This site allows sharing and community management of design patterns. It allows you to search design patterns based on several criteria
        and specific needs related to a project. It should also allow you to comment design patterns, to report conflicts between them 
        and to provide solutions. All of these tools has been developped to expends an open and free database to help people to 
        conceive their own interfaces.
    </p>

    <h2>Contribute to the community</h2>
    <h3>> Why?</h3>
    <p style="font-size: 1.05em">
        You will find on this website for peoples sharing an interest for user's interfaces and human centered interactions. By sharing your design patterns 
        you will actively participate in the expansion of the open and free database and may get constructive discussions about them and help on whatever 
        problems you might get by adding comments. On the other hand you can help others users by rating, report conflicts betwen designs 
        patterns and suggest solutions that you might find.
    </p>

    <h3>> How?</h3>
    <p style="font-size: 1.05em">
        All you need to do is to create a free account by clicking on the button "SIGN UP", complete the form and wait an email 
        to confirme your identity. After that, you are ready to share design pattern, report conflict, make solutions and projet just by logging 
        on the top right of the website "UI Design Pattern Community".<br/><br/>
    </p>
    <center><h4>All new members and contributors on our community website are welcomed !</h4></center>
    <br/>
</section>

<?php

include($_SERVER['DOCUMENT_ROOT'] . '/site/view/structure/footer.php');
?>
