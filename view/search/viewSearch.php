<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
<script type="text/javascript" src="/site/javascript/toolkit.js"></script>

<div id="search_bar">
    <div id="search_bar_basic">
        <form id="search_form" method="post" action="/site/controller/search/ctrlSearch.php">
            <input type="text" id="search_keywords" name="search_keywords" /><br>
            <input class="search_type_notarget" type="radio" name="search_type_table" value="Conflict">Conflict<br>
            <input class="search_type_target" type="radio" name="search_type_table" value="DesignPattern">Design Pattern<br>
            <div id="search_type_designpattern_target">
                <input type="radio" name="search_type_designpattern_target" value="Designer">Designer<br>
                <input type="radio" name="search_type_designpattern_target" value="Evaluator">Evaluator<br>
            </div>
            <input class="search_type_notarget" type="radio" name="search_type_table" value="Solution">Solution<br>
            
            <div>
                <a href="#" onclick="runEffect(); return false;">Advanced search</a>
            </div>
            <div id="search_bar_advanced">
                <div id="search_sort_category">
                    <label>Categories</label>
                </div>

                <div id="search_sort_component">
                    <label>Components</label>
                </div>

                <div id="search_sort_platform">
                    <label>Platforms</label>
                </div>

                <div id="search_sort_property">
                    <label>Properties</label>
                </div>

                <div id="search_sort_system">
                    <label>Systems</label>
                </div>
            </div>
            <input type="submit" value="Search"/>
        </form>
    </div>
    <script>
        $(":radio.search_type_target").change(function () {
            $("#search_type_designpattern_target").show("clip");
        });
        $(":radio.search_type_notarget").change(function(){
            $("#search_type_designpattern_target").hide();
        });
    

    </script>
</div>
