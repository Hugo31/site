
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

function addToCart(idDP, selector, removeIt){
    $.post("/site/controller/addCart.php", {idDesignPattern : idDP}, function(data){
        
        if(data == true){
            
            $('.currentDP_numberIn').each(function(e){
                var numb = parseInt($(this).text(), 10);
                numb++;
                $(this).text(numb);
            });
            selector.text("Remove from my current Design Pattern");
            selector.attr("onclick", "return removeFromCart("+ idDP + ", $(this), " + removeIt.toString() + ");");
            selector.prev().attr("src", "/site/img/vrac/croix.png");
        }
        else{
            alert("An error occured when adding the design pattern");
        }
    });
    return false;
}

function removeFromCart(idDP, selector, removeIt){
    $.post("/site/controller/removeCart.php", {idDesignPattern : idDP}, function(data){
        if(data == true){
            $('.currentDP_numberIn').each(function(e){
                var numb = parseInt($(this).text(), 10);
                numb--;
                $(this).text(numb);
            });
            selector.text("Add to my current Design Pattern");
            selector.attr("onclick", "return addToCart("+ idDP + ", $(this), " + removeIt.toString() + ");");
            selector.prev().attr("src", "/site/img/vrac/add.png");
            if(removeIt){
                $('#article_' + idDP + '').remove();
            }
        }
        else{
            alert("An error occured when removing the design pattern");
        }
    });
    return false;
}

function addRate(table, id, login, input){
    $.post("/site/controller/addRate.php", {table: table, id: id, login : login, rate : input.val()}, function(data){
        
        if(data == true){
            $('#details_rate').remove();
            $.post("/site/controller/reupRating.php", {table: table, id: id, login : login, rate : input.val()}, function(data){
                if(table == "DesignPattern"){
                    $('#contenuDroitDP').append(data);
                }
                else{
                    $('#contenuDroitSol').append(data);
                }
            });
        }    
        else{
            alert("Impossible to rate");
        }
    });
    return false;
}

function removeRate(table, id, login, input){
    $.post("/site/controller/removeRate.php", {table: table, id: id, login : login, rate : input.val()}, function(data){
        if(data == true){
            $('#details_rate').remove();
            $.post("/site/controller/reupRating.php", {table: table, id: id, login : login, rate : input.val()}, function(data){
                if(table == "DesignPattern"){
                    $('#contenuDroitDP').append(data);
                }
                else{
                    $('#contenuDroitSol').append(data);
                }
            });
        }    
        else{
            alert("Impossible to remove the rate");
        }
    });
    return false;
}

function changeValueSpanSearch(selector){
    if($(selector).text() == "[+]"){
        $(selector).text("[-]");
    }
    else{
        $(selector).text("[+]");
    }
}


function addCommentToDP(comment, id, table, nbComments, articleComment){
    $.post("/site/controller/addComment.php", {id: id, comment: comment.val(), table: table}, 
    function(boolAdded){
        alert(boolAdded);
        if(boolAdded == true){
            $.post("/site/controller/reupdateComments.php", {id: id, table: table, nbComments: nbComments}, 
            function(containerComments){
                parent = articleComment.parent();
                articleComment.remove();
                parent.append(containerComments);
            });
        }
        
    });
    return false;
}