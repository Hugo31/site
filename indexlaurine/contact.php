<?php
    include('header.php');   
    include('search.php');   
?>

<section id="contenu">
    <h1> Contact </h1>
    <div style="width:560px;float:left;">
        <h2>How can we help you?</h2>
        <div style="padding:10px">
            <table>
                <tr>
                    <td><label for="namee">Your name</label></td>
                    <td><input id="namee" type="text" value="" name="namee"></td>
                </tr>
                <tr>
                    <td><label for="mail">Your email</label></td>
                    <td><input id="mail" type="email" value="" name="mail"></td>
                </tr>
                <tr>
                    <td><label>Your subject</label></td>
                    <td>
                         <select id="subject" class="jqTransformHidden" name="subject" style="">
                            <option selected="selected" value="Choose">Choose</option>
                            <option value="Question">Question</option>
                            <option value="Business proposal">Business proposal</option>
                            <option value="Advertisement">Advertisement</option>
                            <option value="Complaint">Complaint</option>
                         </select> 
                    </td>
                </tr>
                <tr>
                    <td><label for="message">Your message</label></td>
                    <td><textarea id="message" name="message" style="min-width:400px;max-width:400px;min-height :200px;max-height:200px"></textarea></td>
                </tr>
            </table>
            <br/>
            <center>
            <img src="./captcha.php" alt="Captcha" id="captcha" />
            <a style="cursor:pointer" onclick="document.images.captcha.src='./captcha.php?id='+Math.round(Math.random(0)*1000)+1"><br><i>Regenerate code</i></a><br/><br/>
            Entrez le code : <input name="userCode" id="userCode" type="text" title="Le code comporte exactement 5 lettres ou nombres." size="5" pattern="[a-zA-Z0-9]{5}" required><br/><br/>
            </center>
            <input type="button" value="Send" style=float:right;">
            <input type="button" value="Reset" style=float:left;">
            <br/><br/><br/><br/>
        </div>
    </div>
    <div style="margin-top:20px;margin-left:10px;padding:10px;width:180px;float:left;height:200px;background: #eee;color: #555;">
        <h2 style="margin:0 auto;padding:0 auto">Get in touch</h2>
    </div>
</section>

<?php
    include('footer.php');   
?>