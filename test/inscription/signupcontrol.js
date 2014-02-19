/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function valider(form) {

    var username = form.find("#usernamesignup");
    var email = form.find("#emailsignup");
    var pass1 = form.find("#passwordsignup");
    var pass2 = form.find("#passwordsignup_confirm");

    var verifp = verifSimilarity(pass1, pass2);
    var verife = verifEmail(email);
    var verifu = verifUsername(username);

    if (verifu && verife && verifp) {
        return true;
    } else {
        return false;
    }
}

function verifUsername(champ) {
    if (champ.prop("value").length < 4 || champ.prop("value").length > 30) {
        surligne(champ, true);
        champ.focus();
        return false;
    } else {
        surligne(champ, false);
        return true;
    }
}

function verifEmail(champ) {
    var regex = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    if (regex.test(champ.prop("value"))) {
        surligne(champ, false);
        return true;
    } else {
        surligne(champ, true);
        champ.focus();
        return false;
    }
}

function verifSimilarity(champ1, champ2) {
    if (champ1.prop("value") == '' || champ2.prop("value") == '') {
        surligne(champ1, true);
        surligne(champ2, true);
        champ1.focus();
        return false;
    } else if (champ1.prop("value") == champ2.prop("value")) {
        surligne(champ1, false);
        surligne(champ2, false);
        return true;
    } else {
        surligne(champ1, true);
        surligne(champ2, true);
        champ1.focus();
        return false;
    }
}

function surligne(champ, erreur) {
    if (erreur) {
        champ.css("backgroundColor", "#FBA");
    } else {
        champ.css("backgroundColor", "#FFF");
    }
}