/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* A faire :
 * Verification de syntaxe sur les données utilisateurs rentrées dans les champs (eviter les $, etc..)
 * 
 */

var formulaire;
var postReturn;

function validSignin(form) {
    formulaire = form;
    postReturn = false;

    var login = formulaire.find("#loginsignin").prop("value");
    var password = formulaire.find("#passwordsignin").prop("value");

    var anEmail = typeEmail(login);

    if (anEmail) {
        $.ajax({
            type: 'POST',
            url: '/site/controller/sign/ctrlSigninEmail.php',
            data: {email: login, password: password},
            async: false,
            success: function(data) {
                var champLogin = formulaire.find("#loginsignin");
                var champPassword = formulaire.find("#passwordsignin");
                var champErreur = document.getElementById("errorlogin");

                if (data[0] != '0') {
                    champPassword.css("backgroundColor", "#FFF");
                    champLogin.css("backgroundColor", "#FFF")
                    champErreur.style.color = '#FFF';
                    champErreur.innerHTML = '';
                    postReturn = true;
                } else {
                    champPassword.css("backgroundColor", "#FBA");
                    champLogin.css("backgroundColor", "#FBA");
                    champErreur.style.color = '#FBA';
                    champErreur.innerHTML = 'Wrong password or email !';
                    postReturn = false;
                }
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: '/site/controller/sign/ctrlSigninUsername.php',
            data: {username: login, password: password},
            async: false,
            success: function(data) {
                var champLogin = formulaire.find("#loginsignin");
                var champPassword = formulaire.find("#passwordsignin");
                var champErreur = document.getElementById("errorlogin");

                if (data[0] != '0') {
                    champPassword.css("backgroundColor", "#FFF");
                    champLogin.css("backgroundColor", "#FFF")
                    champErreur.style.color = '#FFF';
                    champErreur.innerHTML = '';
                    postReturn = true;
                } else {
                    champPassword.css("backgroundColor", "#FBA");
                    champLogin.css("backgroundColor", "#FBA");
                    champErreur.style.color = '#FBA';
                    champErreur.innerHTML = 'Wrong password or username !';
                    postReturn = false;
                }
            }
        });
    }
    return postReturn;
}

function typeEmail(value) {
    // Expression d'un email
    var regex = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    // Vérification syntaxique
    return(regex.test(value));
}
