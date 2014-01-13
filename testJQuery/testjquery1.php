<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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
            
        <?php
        // put your code here
        ?>
        <script type="text/javascript">
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
            $(':input').change(function(){
                alert($(this).val());
            });
        </script>
    </body>
</html>
