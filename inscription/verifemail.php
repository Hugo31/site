<?php
$email = $_POST['email'];

echo $email;

//$donnees = Database::getOneData("SELECT COUNT(mail) AS nbMail FROM User WHERE mail = \"" . $email . "\";");

/*if ($donnees != false) {
    //if ($donnees['nbMail'] == 1) {
        // Generer un mdp aléatoire
        //$mdpaleat = uniqid();
        
        // Remplacer dans la bd pour l'user
        //Database::getOneData("UPDATE User SET pwd = \"" . $mdpaleat . "\" WHERE mail = \"" . $email . "\";");
        
        // Envoyer un mail avec nouveau mdp
        $sujet = "Password Renewal";
        $header = "From: \"WeaponsB\"<sansreponse@mail.fr>";
        $message.= "Your new password : " . $mdpaleat . "\n";
        mail($email, $sujet, $message, $header);
        
    //}
}*/