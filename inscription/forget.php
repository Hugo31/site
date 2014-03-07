<?php

include('header.php');
include('search.php');
?>

<section id="contenu">
    <h1>Forgotten password ?</h1>
    <form method="post" id="forgetform" name="forgetform"
          action="#" onsubmit="return validforget($(this));">
        <p>
            <label for="emailforget" id="eforget">Your email</label><br/>
            <input type="email" id="emailforget" name="emailforget" 
                   required="required" size="30" maxlength="30" 
                   placeholder="JeanMi@univ-tlse.fr" />
        </p>
            <div id="errormsgforget"></div>
        <p>
            <input type="submit" value="SEND" class="sendforget" id="sendforget"/>
        </p>
    </form>
</section>

<?php

include ('footer.php');



