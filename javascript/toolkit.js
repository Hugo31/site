
function runEffect(identifiant) {
        $(identifiant).toggle('blind');
        
        if($(identifiant).text() == "[+]"){
            $(identifiant).text("[-]");
        }
        else{
            if($(identifiant).text() == "[-]"){
                $(identifiant).text("[+]");
            }
            
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