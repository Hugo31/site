/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var formulaire;

function validforget(form) {
    formulaire = form;
    
    var email = formulaire.find("#emailforget").prop("value");
    
    $.post("/site/controller/sign/ctrlForgetEmail.php", {email : email}, function(data){
        var champEmail = formulaire.find("#emailforget");
        var champSubmit = document.getElementById("sendforget");
        var champErreur = document.getElementById("errormsgforget");
        
        if(data != '0'){
            champEmail.css("backgroundColor", "#B2D487");
            champErreur.style.color = '#B2D487';
            champErreur.innerHTML = 'An email has been sent';
            champSubmit.disabled = true;
            champSubmit.hidden = true;
        } else {
            champEmail.css("backgroundColor", "#FBA");
            champErreur.style.color = '#FBA';
            champErreur.innerHTML = 'No account found with this email';
        }
        
        
    });
    
    return false;
}

function desactivateEnterKey(event)
{
    // Compatibilité IE / Firefox
    if(!event && window.event) {
        event = window.event;
    }
    // IE
    if(event.keyCode == 13) {
        event.returnValue = false;
        event.cancelBubble = true;
    }
    // DOM
    if(event.which == 13) {
        event.preventDefault();
        event.stopPropagation();
    }
}
