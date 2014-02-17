<?php
    include('header.php');   
    include('search.php');   
?>

<section id="contenu">
    <h1> Contact </h1>
    <div style="width:560px;float:left;height:700px;">
        <h2>How can we help you?</h2>
        <font style="color:#FF4C00">> All fields are required.</font>
        <br/><br/>
        <div style="padding:10px">
            <table>
                <tr>
                    <td><label for="namee">Your name</label></td>
                    <td><input id="namee" type="text" value="" name="namee" size="40" required autofocus></td>
                </tr>
                <tr>
                    <td><label for="mail">Your email</label></td>
                    <td><input id="mail" type="email" value="" name="mail" size="40" required></td>
                </tr>
                <tr>
                    <td><label>Your subject</label></td>
                    <td>
                         <select id="subject" class="jqTransformHidden" name="subject" style="" required>
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
                    <td><textarea id="message" name="message" style="min-width:400px;max-width:400px;min-height :200px;max-height:200px" required></textarea></td>
                </tr>
            </table>
            <br/>
            <center>
                <img src="./captcha.php" alt="Captcha" id="captcha" />
                <a style="cursor:pointer" onclick="document.images.captcha.src='./captcha.php?id='+Math.round(Math.random(0)*1000)+1"><br><i>Regenerate code</i></a><br/><br/>
                Enter code : <input name="userCode" id="userCode" type="text" title="Le code comporte exactement 5 lettres ou nombres." size="5" pattern="[a-zA-Z0-9]{5}" required><br/><br/>
                <br/>
                <input type="button" value="Reset" style="margin-right: 15px">
                <input type="button" value="Send" style="margin-left: 15px">
            </center>
        </div>
    </div>
    <div style="margin-top:20px;margin-left:10px;padding:10px;width:180px;float:left;height:280px;background: #eee;color: #555;">
        <center><h2 style="margin:0 auto;padding:0 auto">Get in touch</h2></center>
        <br/>
        <h4 style="margin: 0px auto;">> Site manager </h4>
        <ul>
            <li><a href="mailto:winckler@irit.fr">winckler@irit.fr</a></li>
        </ul>
        <br/>
        <h4 style="margin: 0px auto;">> Developpers </h4>
        <ul>
            <li><a href="mailto:hugo.guignard@gmail.com">hugo.guignard@gmail.com</a></li>
            <li><a href="mailto:laurine.marmisse@gmail.com">laurine.marmisse@gmail.com</a></li>
            <li><a href="mailto:loicfaure@hotmail.fr">loicfaure@hotmail.fr</a></li>
            <li><a href="mailto:loicviguier@gmail.com">loicviguier@gmail.com</a></li>
        </ul>
    </div>
</section>

<?php
    include('footer.php');   
?>