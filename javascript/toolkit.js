
function toggleObject(identifiant) {
    $(identifiant).toggle('blind');
}

function toggleTree(identifiant, handlerLink) {
    if(handlerLink.text() == "[+]"){
        handlerLink.text("[-]");
    }
    else{
        handlerLink.text("[+]");
    }
    $(identifiant).toggle('blind');
}

function requestDetails(identifiant, type, idSearch){
    if($(identifiant).html() == ""){
        $.post("/site/controller/search/ctrlResultDetails.php", {table: type, id: idSearch}, 
            function(data) {
                $(identifiant).empty();
                $(identifiant).prepend(data);
                $(identifiant).toggle('blind');
            }
        );
    }
    else{
        $(identifiant).toggle('blind', function(e){
            $(identifiant).empty();
        });
    }
}
    
function enableTriStateCheckBox(object){
    container = object.parent();
    var value = object.prop("checked");
    container.find("ul>li>:checkbox").each(function(e){
        $(this).prop("checked", value);
    });
}

function enableCheckBoxChild(object){
    var nbCheck = 0;
    container = object.parent().parent();
    container.find(".classic").each(function(e){
        if($(this).prop("checked")){ nbCheck += 1; }
    });
    container = container.parent();
    container.find(".tri-state").each(function(e){
        $(this).prop("checked", nbCheck > 0);
        $(this).prop("indeterminate", (nbCheck > 0) && (nbCheck < $(this).prop("value")));
    });
}

function addToCart(idDP, frame){
    $.post("/site/controller/addCart.php", {idDesignPattern : idDP}, function(data){
        
        if(data == true){
            alert("You add one design pattern");
        }
        else{
            alert("An error occured when adding the design pattern");
        }
    });
    return false;
}

function removeFromCart(idDP){
    $.post("/site/controller/removeCart.php", {idDesignPattern : idDP}, function(data){
        
        if(data == true){
            alert("You remove one design pattern");
        }
        else{
            alert("An error occured when removing the design pattern");
        }
    });
    return false;
}

function addRate(id, loginRate, input){
    $.post("/site/controller/addRate.php", {idDesignPattern: id, login : loginRate, rate : input.prop("value")}, function(data){
        if(data == true){
            alert("You have rate that one");
        }    
        else{
            alert("Impossible to rate");
        }
    });
}