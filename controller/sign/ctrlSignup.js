/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var formulaire;
var verifUsernameReturn;
var verifEmailReturn;

function validSignup(form) {

    formulaire = form;
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
    var regex = new RegExp('^([A-z]+([ |\-]{1}([A-z])+)*){2,30}$');
    // Verification de longueur
    if (firstname.length < 2 || firstname.length > 30) {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.color = '#FBA';
        champErreur.style.padding = '0px 0px 0px 84px';
        champErreur.innerHTML = 'Your firstname is too short or too long</br>';
        return false;
    }

    if (regex.test(firstname)) {
        champ.css("backgroundColor", "#FFF");
        champErreur.innerHTML = '';
        return true;
    } else {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.padding = '0px 0px 0px 148px';
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Your firstname must not contain special characters</br>';
        return false;
    }
}

function verifLastname(champ) {
    var champErreur = document.getElementById("errormsgsignup_lastname");
    var lastname = champ.prop("value");
    var regex = new RegExp('^([A-z]+([ |\-]{1}([A-z])+)*){2,30}$');
    // Verification de longueur
    if (lastname.length < 2 || lastname.length > 30) {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.color = '#FBA';
        champErreur.style.padding = '0px 0px 0px 84px';
        champErreur.innerHTML = 'Your lastname is too short or too long</br>';
        return false;
    }

    if (regex.test(lastname)) {
        champ.css("backgroundColor", "#FFF");
        champErreur.innerHTML = '';
        return true;
    } else {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.padding = '0px 0px 0px 148px';
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Your lastname must not contain special characters</br>';
        return false;
    }
}

function verifUsername(champ) {
    var username = champ.prop("value");
    var champErreur = document.getElementById("errormsgsignup_username");
    var regex = new RegExp('^[A-z0-9]{3,30}$');
    // Verification de longueur
    if (username.length < 3 || username.length > 30) {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.padding = '0px 0px 0px 84px';
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Your username is too short or too long</br>';
        return false;
    }

    // Verification syntaxique
    if (regex.test(username)) {
        // Verification d'unicité de l'username dans la BD
        $.ajax({
            type: 'POST',
            url: '/site/controller/sign/ctrlSignupUsername.php',
            data: {username: username},
            async: false,
            success: function(data) {
                var champUsername = formulaire.find('#usernamesignup');
                var champErreur = document.getElementById("errormsgsignup_username");
                if (data[0] == '0') {
                    champ.css("backgroundColor", "#FFF");
                    champErreur.innerHTML = '';
                    verifUsernameReturn = true;
                } else {
                    champUsername.focus();
                    champUsername.css("backgroundColor", "#FBA");
                    champErreur.style.padding = '0px 0px 0px 48px';
                    champErreur.style.color = '#FBA';
                    champErreur.innerHTML = 'Your username is already exist</br>';
                    verifUsernameReturn = false;
                }
            }
        });
        return verifUsernameReturn;
    } else {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.padding = '0px 0px 0px 148px';
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Your username must not contain special characters</br>';
        return false;
    }
}

function verifEmail(champ) {
    var email = champ.prop("value");
    var champErreur = document.getElementById("errormsgsignup_email");
    var regex = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    // Vérification syntaxique
    if (regex.test(email)) {
        // Verification d'unicité de l'email dans la BD
        $.ajax({
            type: 'POST',
            url: '/site/controller/sign/ctrlSignupEmail.php',
            data: {email: email},
            async: false,
            success: function(data) {
                var champEmail = formulaire.find('#emailsignup');
                var champErreur = document.getElementById("errormsgsignup_email");
                if (data[0] == '0') {
                    champ.css("backgroundColor", "#FFF");
                    champErreur.innerHTML = '';
                    verifEmailReturn = true;
                } else {
                    champEmail.focus();
                    champEmail.css("backgroundColor", "#FBA");
                    champErreur.style.padding = '0px 0px 0px 20px';
                    champErreur.style.color = '#FBA';
                    champErreur.innerHTML = 'This email is already exist</br>';
                    verifEmailReturn = false;
                }
            }
        });
        return verifEmailReturn;
    } else {
        champ.focus();
        champ.css("backgroundColor", "#FBA");
        champErreur.style.padding = '0px 0px 0px 54px';
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Please, put a valid email address</br>';
        return false;
    }
}

function verifSimilarity(champ1, champ2) {
    var pass1 = champ1.prop("value");
    var pass2 = champ2.prop("value");
    var champErreur = document.getElementById("errormsgsignup_password");
    var regex = new RegExp('^[A-z0-9]{4,30}$');
    if (regex.test(pass1)) {
        if (pass1 == pass2) {
            champ1.css("backgroundColor", "#FFF");
            champ2.css("backgroundColor", "#FFF");
            champErreur.innerHTML = '';
            return true;
        }

        if (pass1 != pass2) {
            champ2.focus();
            champ1.css("backgroundColor", "#FBA");
            champ2.css("backgroundColor", "#FBA");
            champErreur.style.padding = '0px 0px 0px 49px';
            champErreur.style.color = '#FBA';
            champErreur.innerHTML = 'Please, give the same password</br>';
            champ1.focus();
            return false;
        }

        if (pass1 == '' && pass2 == '') {
            champ1.css("backgroundColor", "#FBA");
            champ2.css("backgroundColor", "#FBA");
            champErreur.style.padding = '0px 0px 0px 49px';
            champErreur.style.color = '#FBA';
            champErreur.innerHTML = 'Please, give a password</br>';
            champ1.focus();
            return false;
        }
    } else {
        champ1.css("backgroundColor", "#FBA");
        champ2.css("backgroundColor", "#FBA");
        champErreur.style.padding = '0px 0px 0px 122px';
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'Password must not contain special characters</br>';
        return false;
    }
}
