/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var formulaire;

function validforget(form) {
    formulaire = form;
    
    var email = formulaire.find("#emailforget").prop("value");
    
    $.post("verifemail.php", {email : email}, function(data){
        alert(data);
        var champEmail = formulaire.find("#emailforget");
        var champErreur = document.getElementById("errormsgforget");
        
        champEmail.css("backgroundColor", "#FBA");
        
        champErreur.style.color = '#FBA';
        champErreur.innerHTML = 'No account found with this email';
    });
    
    return false;
}
 
 