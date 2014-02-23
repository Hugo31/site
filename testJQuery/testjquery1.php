<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/site/javascript/toolkit.js"></script>
        <link rel="stylesheet" href="newCSS.css" />
        <title></title>
    </head>
    <body>

        
        Test BRO
        <p id="text">TEST</p>
        <div id="titre">J'aime les frites.</div>
        <select>
            <option value="Category">Category</option>
            <option value="Property">Property</option>
        </select>
        <input type="text" name="firstnameUser" id="firstnameUser" placeholder="Votre prénom..." size="30" maxlength="30" required/><br/>
            
        <ul id="menu">
  
            <li class="premier" id="premierElement" style="float:left;overflow:hidden;">
                <a href="#">Élément du menu sans sous-menu</a>
            </li>
 
            <li class="premier" id="secondElement" style="float:left;overflow:hidden;">
    
                <a href="#" class="">Élément du menu avec sous-menu</a>
                <ul class="sousmenu" style="position:relative;">
                    <li style="position:relative;"><a>Élément du sous-menu</a></li>
                    <li style="position:relative;"><a>Élément du sous-men</a></li>
                </ul>
    
            </li>
  
        </ul>
        <div style="display: block;">
            <a href="#" onclick="return hidecomment(this)" style="text-decoration:none;">[-]</a>Le bloc à cacher
            <p style="padding-left: 20px;">
                TEST1<br/>
                TEST2<br/>
                <a href="#" onclick="return hidecomment(this)" style="text-decoration:none;padding-left:20px;">[-]</a> <span>Un sous bloc</span>
                <p style="padding-left: 20px;">
                    TEST3<br/>
                    TEST4<br/>
                </p>
            </p>
        </div>
        <div style="display: block;">
            <a href="#" onclick="return hidecomment(this)" style="text-decoration:none;">[-]</a><span>Le bloc à cacher</span>
            <p>
                TEST1<br/>
                TEST2<br/>
            </p>
        </div>
        
        <form id="formtest" method="post" action="testpage.php">
            <input type="submit" value="Envoyer" />
        </form>
        <form id="formtest2" method="post" action="testpage2.php"><label>Non fonctionnel</label>
            <input type="text" value="Category" name ="table"/>
            <input type="text" value="1|2|3|4" name="id"/>
            <input type="submit" value="Test implode_explode" />
        </form>
        <form id="formtest3" method="post" action="testpage3.php">
            
            <input type="submit" value="Test fat requete search" />
        </form>
        
        <div class="rating-box" style="width: 25%"> 
            <div class="score-container"> 
                <div class="score">4,5</div> 
                <div class="score-container-star-rating">  
                    <div class="small-star star-rating-non-editable-container"> 
                        <div class="current-rating" style="width: 9%;"></div> 
                    </div> 
                </div> 
                <div class="reviews-stats">
                    <span class="reviewers-small"></span> 
                    <span class="reviews-num">203 677</span> au total
                </div> 
            </div> 
            <div class="rating-histogram"> 
                <div class="rating-bar-container five"> 
                    <span class="bar-label"> 
                        <span class="star-tiny star-full"></span>
                        5 
                    </span> 
                    <span class="bar" style="width:100%"></span> 
                    <span class="bar-number">139 938</span> 
                </div>
                <div class="rating-bar-container four"> 
                    <span class="bar-label"> 
                        <span class="star-tiny star-full"></span>
                        4 
                    </span> 
                    <span class="bar" style="width:32%"></span> 
                    <span class="bar-number">44 886</span> 
                </div>
                <div class="rating-bar-container three"> 
                    <span class="bar-label"> 
                        <span class="star-tiny star-full"></span>
                        3 
                    </span> 
                    <span class="bar" style="width:8%"></span> 
                    <span class="bar-number">12 242</span> 
                </div>
                <div class="rating-bar-container two"> 
                    <span class="bar-label"> 
                        <span class="star-tiny star-full"></span>
                        2 
                    </span> 
                    <span class="bar" style="width:1%"></span> 
                    <span class="bar-number">2 664</span> 
                </div>
                <div class="rating-bar-container one"> 
                    <span class="bar-label"> 
                        <span class="star-tiny star-full"></span>
                        1 
                    </span> 
                    <span class="bar" style="width:2%"></span> 
                    <span class="bar-number">3 947</span> 
                </div> 
            </div> 
        </div>
        
        <?php
        // put your code here
        ?>
        
        
        
        
        <script type="text/javascript">
            $(function() {
                
                
                $(".classic").change(function(e){
                    enableCheckBoxChild($(this));
                });
                
                $(".tri-state").change(function(e){
                    enableTriStateCheckBox($(this));
                });
        
                




                //$('body').html('Modification');
                /*alert($('#titre').html());
                $(':input').focus(function(){
                    $(this).css('background-color','#00f');
                });
                $(':input').blur(function(){
                    $(this).css('background-color','#f00');
                });*/
                $('#text').mouseenter(function(){
                    $(this).css('background-color','#f00');
                });
                /*$(':input').change(function(){
                    alert($(this).val());
                });*/
                //Sample de code pour faire du post en ajax.
                $('#formtest').submit(function(){
                    $.post("testpage.php", {table: "Category", nom: "test", description: "description"}, 
                        function(data) {
                            if(data === true){
                                $('body').prepend("Ok c'est ajouter ;)");
                            }
                            else{
                                $('body').prepend("Il y a eu un problème :(");
                            }
                        }
                    );
        
                    
                    return false;
                });
                $('#formtest2').submit(function(){
                    $.post("testpage2.php", {table: $("#formtest2 input[name=table]").val(), id: $("#formtest2 input[name=id]").val()}, 
                        function(data) {
                            $('body').prepend(data);
                            
                        });
        
                    
                    return false;
                });
                $('#formtest3').submit(function(){
                    $.post("testpage2.php", {
                            idCategory: "1|2|3", 
                            idProperty: "4|5", 
                            target: "Designer"
                    },
                    
                    function(data) {
                        $('body').prepend(data);
                        $('#formtest3').prepend('<input type="text" name="request" value=\'' + data + '\'/>');
                        
                    });
        
                    
                    return false;
                });

                var tailles = {}, tailleMax = 0, tailleCourante;
                $('#menu li.premier')
                    .each(function(){
                        // enregistrer la hauteur du menu déroulé complètement
                        tailles[ $(this).attr('id') ] = tailleCourante = $(this).height();
                        // redéfinir la hauteur (par défaut) pour cacher le menu
                        // Note : juste pour ceux qui ont JavaScript activé
                        // donc ceux qui n'ont pas JS activé verront le menu déroulé et non animé
                        $(this).height( 20 );

                        // enregistrer la taille maximale au fur et à mesure
                        if( tailleCourante> tailleMax ){
                            tailleMax = tailleCourante;
                        }
                        // pour ne pas déborder sur le contenu (position:relative et pas absolute)
                        $('#menu').height( tailleMax );
                    })    
                    // la souris rentre..
                    .click(function(){
                        $(this).stop().animate({
                            // hauteur du menu déroulé complètement
                            height: tailles[ $(this).attr('id') ]
                        },500);
                    })
                    // ..et sort
                    .dblclick(function(){
                        $(this).stop().animate({
                            height: '19px' // taille par défaut
                        },500);
                    })
                ;
                //Cache des commentaires.
                hidecomment = function(a){
                    $(a).attr("onclick","return showcomment($(this));");
                    $(a).text("[+]");
                    $(a).parent().children("p").first().hide().end();
                    return!1;
                };
                //Affiche des commentaires.
                showcomment = function(a){
                    $(a).attr("onclick","return hidecomment($(this));");
                    $(a).text("[-]");
                    $(a).parent().children("p").first().show().end();
                    $(a).show();

                    return!1;
                };
                
            }); 
        </script>
    </body>
</html>
