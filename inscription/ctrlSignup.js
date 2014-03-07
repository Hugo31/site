/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var formulaire;

function validSignup(form) {

    formulaire = form;
    
    alert('pop');

    var veriff = verifFirstname(form.find("#firstnamesignup"));
    var verifl = verifLastname(form.find("#lastnamesignup"));
    var verifu = verifUsername(form.find("#usernamesignup"));
    var verife = verifEmail(form.find("#emailsignup"));
    var verifp = verifSimilarity(form.find("#passwordsignup"),
            form.find("#passwordsignup_confirm"));

    if (veriff && verifl && verifu && verife && verifp) {
        return true;
    } else {
        return false;
    }
}

function verifFirstname(champ) {
    var champErreur = document.getElementById("errormsgsignup_firstname");
    var firstname = champ.prop("value");
    var regex = new RegExp('[A-z]{30}+[\S]');
    
    alert('popf');
    
    if (regex.test(firstname)) {
        champ.css("backgroundColor", "#FFF");
        champErreur.innerHTML = '';
        return true;
    } else {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Your firstname must not contain special characters</br>';
        return false;
    }
}

function verifLastname(champ) {
    var champErreur = document.getElementById("errormsgsignup_lastname");
    var lastname = champ.prop("value");
    var regex = new RegExp('[A-z]{30}+[\S]');
    
    alert('popl');
    
    if (regex.test(lastname)) {
        champ.css("backgroundColor", "#FFF");
        champErreur.innerHTML = '';
        return true;
    } else {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Your lastname must not contain special characters</br>';
        return false;
    }
}

function verifUsername(champ) {
    var username = champ.prop("value");
    var champErreur = document.getElementById("errormsgsignup_username");
    
    alert('popu');

    // Verification syntaxique
    if (username.length < 4 || username.length > 30) {
        champ.css("backgroundColor", "#FBA");
        champ.focus();
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Your username is too short or too longer</br>';
        return false;
    } else {
        // Verification d'unicité de l'username dans la BD
        if ($.post('ctrlSignupUsername.php', {username: username}, function(data) {
            var champUsername = formulaire.find('#usernamesignup');
            var champErreur = document.getElementById("errormsgsignup_username");
            if (data[0] == '1') {
                champUsername.focus();
                champUsername.css("backgroundColor", "#FBA");
                champErreur.style.color = '#FBA';
                champErreur.innerHTML = 'Your username is already exist</br>';
                return true;
            } else {
                champ.css("backgroundColor", "#FFF");
                champErreur.innerHTML = '';
                return false;
            }
        }))
            return false;
        return true;
    }
}

function verifEmail(champ) {
    var email = champ.prop("value");
    var champErreur = document.getElementById("errormsgsignup_email");
    var regex = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    
    alert('pope');
    
    // Vérification syntaxique
    if (!regex.test(email)) {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'please, put a valid email address</br>';
        return false;
    } else {
        // Verification d'unicité de l'email dans la BD
        if ($.post('ctrlSignupEmail.php', {email: email}, function(data) {
            var champEmail = formulaire.find('#emailsignup');
            var champErreur = document.getElementById("errormsgsignup_email");
            if (data[0] == '1') {
                champEmail.focus();
                champEmail.css("backgroundColor", "#FBA");
                champErreur.style.color = '#FBA';
                champErreur.innerHTML = 'This email is already exist</br>';
                return true;
            } else {
                champ.css("backgroundColor", "#FFF");
                champErreur.innerHTML = '';
                return false;
            }
        }))
            return false;
        return true;
    }
}

function verifSimilarity(champ1, champ2) {
    var champErreur = document.getElementById("errormsgsignup_password");
    
    alert('popp');
    
    if (champ1.prop("value") == '' || champ2.prop("value") == '') {
        champ1.css("backgroundColor", "#FBA");
        champ2.css("backgroundColor", "#FBA");
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Please, put the same password</br>';
        champ1.focus();
        return false;
    } else if (champ1.prop("value") == champ2.prop("value")) {
        champ1.css("backgroundColor", "#FFF");
        champ2.css("backgroundColor", "#FFF");
        return true;
    } else {
        champ1.css("backgroundColor", "#FBA");
        champ2.css("backgroundColor", "#FBA");
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Please, put the same password</br>';
        champ1.focus();
        return false;
    }
}
