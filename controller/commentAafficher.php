<style type="text/css">
    #containerComments .pagination ul li.inactive,
    #containerComments .pagination ul li.inactive:hover{
        background-color:#ededed;
        color:#bababa;
        border:1px solid #bababa;
        cursor: default;
    }
    
    #containerComments .data ul li{
        list-style: none;
        font-family: verdana;
        margin: 5px 0 5px 0;
        color: #000;
        font-size: 13px;
    }

    #containerComments .pagination{
        width: 700px;
        height: 25px;
    }
    
    #containerComments .pagination ul li{
        list-style: none;
        float: left;
        border: 1px solid #006699;
        padding: 2px 6px 2px 6px;
        margin: 0 3px 0 3px;
        font-family: arial;
        font-size: 14px;
        color: #006699;
        font-weight: bold;
        background-color: #f2f2f2;
    }
    
    #containerComments .pagination ul li:hover{
        color: #fff;
        background-color: #006699;
        cursor: pointer;
    }
    
    .go_button {
        background-color:#f2f2f2;border:1px solid #006699;color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;position:absolute;margin-top:-1px;margin-left:5px;
    }
    
    .total{
        float:right;font-family:arial;color:#999;
    }

</style>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();

    if(isset($_POST['table']) && isset($_POST['id'])){

        echo "Here is all comments about ".$_POST['table']." you have selected. You can change page thanks to bar at the bottom of the page.<br/><center><h3>Please also comment !!</h3></center><br/>";
        echo"<div id=\"containerComments\">
                <div class=\"data\"></div>
                <div class=\"pagination\"></div>
            </div>";
        echo 
        "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js\"></script> 
            <script type=\"text/javascript\">
                $(document).ready(function(){
                    function loading_show(){
                    //    $('#loading').html(\"<img src='images/loading.gif'/>\").fadeIn('fast');
                    }
                    function loading_hide(){
                        $('#loading').fadeOut('fast');
                    }                
                    function loadData(page){
                        loading_show();                    
                        $.ajax
                        ({
                            type: \"POST\",
                            url: \"/site/controller/pagination.php\",
                            data: {page: page, table: \"".$_POST['table']."\", id: \"".$_POST['id']."\"},
                            success: function(msg)
                            {
                                $(\"#containerComments\").ajaxComplete(function(event, request, settings)
                                {
                                    loading_hide();
                                    $(\"#containerComments\").html(msg);
                                });
                            }
                        });
                    }
                    loadData(1);  // For first time page load default results
                    $('#containerComments .pagination li.active').live('click',function(){
                        var page = $(this).attr('p');
                        loadData(page);

                    });           
                    $('#go_btn').live('click',function(){
                        var page = parseInt($('.goto').val());
                        var no_of_pages = parseInt($('.total').attr('a'));
                        if(page != 0 && page <= no_of_pages){
                            loadData(page);
                        }else{
                            alert('Enter a PAGE between 1 and '+no_of_pages);
                            $('.goto').val(\"\").focus();
                            return false;
                        }

                    });
                });
            </script>";

} else {
    echo "No comments.";
}