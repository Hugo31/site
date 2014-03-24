<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');
    
/* Si l'utilisateur a bien entré un code */
if (!empty($_REQUEST['userCode'])) {

    /* Conversion en majuscules */
    $userCode = strtoupper($_REQUEST['userCode']);

    /* Cryptage et comparaison avec la valeur stockée dans $_SESSION['captcha'] */
    if (md5($userCode) == $session->captcha) {
        // envoi d'un mail
        $mail = "winckler@irit.fr";
        $messageComplet = 'You just received a new message from '.$_POST['thename'].' '.$_POST['thefirstname'] . '('.$_POST['themail'].')\n\nMessage :\n' . $_POST['themessage'];
        $objet = $_POST['thesubjet'];

        if (mail($mail, $objet, $messageComplet)) {
            echo '<script>alert ("Your message has been sent to Marco WINCKLER.");window.location.href="contact.php";</script>';
        } else {
            print('<script>alert("There was a problem during sending your email. Please try again.");window.location.href="contact.php";</script>');
        }
    } else {
        echo'<script language="javascript" type="text/javascript">alert("Your code is incorrect. You must rewrite the entire form."); window.location.href="contact.php";</script>';
    }
}
?>

<section id="contenu">
    <h1> Contact </h1>
    <div style="width:540px;float:left;height:700px;">
        <h2>How can we help you?</h2>
        <font style="color:#FF4C00">> All fields are required.</font>
        <br/><br/>
        <div id="formulaireContact">
            <form method="post" action="contact.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td style="width:300px"><label for="namee">Your name</label></td>
                        <td><input id="namee" type="text" value="" name="thename" size="40" required autofocus></td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label for="firstnamee">Your firstname</label></td>
                        <td><input id="firstnamee" type="text" value="" name="thefirstname" size="40" required autofocus></td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label for="mail">Your email</label></td>
                        <td><input id="mail" type="email" value="" name="themail" size="40" required></td>
                    </tr>
                    <tr>
                        <td style="width:300px"><label>Your subject</label></td>
                        <td>
                            <select id="subject" name="thesubject">
                                <option value="Choose" selected>Choose a subject</option>
                                <option value="Question">Question</option>
                                <option value="Business proposal">Business proposal</option>
                                <option value="Advertisement">Advertisement</option>
                                <option value="Complaint">Complaint</option>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top;width:300px"><label for="message">Your message</label></td>
                        <td><textarea id="message" name="themessage" style="min-width:400px;max-width:400px;min-height :200px;max-height:200px" required></textarea></td>
                    </tr>
                </table>
                <br/>
                <center>
                    <img src="captcha.php" alt="Captcha" id="captcha" />
                    <a style="cursor:pointer" onclick="document.images.captcha.src = 'captcha.php?id=' + Math.round(Math.random(0) * 1000) + 1"><br><i>Regenerate code</i></a><br/><br/>
                    Enter code : <input name="userCode" id="userCode" type="text" title="Le code comporte exactement 5 lettres ou nombres." size="5" pattern="[a-zA-Z0-9]{5}" required><br/><br/>
                    <br/>
                    <input type="reset" value="RESET" class="reset" style="margin-right: 15px">
                    <input type="submit" value="SEND" class="send" style="margin-left: 15px">
                </center>
            </form>
        </div>
    </div>
    <div id="getintouch">
        <center><h2 style="margin:0 auto;padding:0 auto">Get in touch</h2></center>
        <br/>
        <h4 style="margin: 0px auto;">> Site manager </h4>
        <ul>
            <li>
                <a href="mailto:winckler@irit.fr">Marco WINCKLER</a>
                <ul>
                    <li>CS-IRIT, Paul Sabatier University</li>
                    <li>118 route de Narbonne<br/>31062 Toulouse, France</li>
                </ul>
            </li>
        </ul>
        <h4 style="margin: 0px auto;">> Developpers </h4>
        <ul>
            <li>
                <a href="mailto:loicfaure@hotmail.fr">Loic FAURE</a>
                <ul>
                    <li>M2 Informatique Spécialité DL</li>
                </ul>
            </li>
            <li>
                <a href="mailto:hugo.guignard@gmail.com">Hugo GUIGNARD</a>
                <ul>
                    <li>M2 Informatique Spécialité DL</li>
                </ul>
            </li>
            <li>
                <a href="mailto:laurine.marmisse@gmail.com">Laurine MARMISSE</a>
                <ul>
                    <li>M2 Informatique Spécialité IHM</li>
                </ul>
            </li>
            <li>
                <a href="mailto:loicviguier@gmail.com">Loic VIGUIER</a></a>
                <ul>
                    <li>M2 Informatique Spécialité DL</li>
                </ul>
            </li>
        </ul>
    </div>
</section>

<?php

include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>