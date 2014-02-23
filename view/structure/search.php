<?php
    $bdd = Database::getConnection();
?>

<script>
    $(function() {
        $(":radio.search_type_target").change(function() {
            $("#search_type_designpattern_target").show("clip");
        });
        $(":radio.search_type_notarget").change(function() {
            $("#search_type_designpattern_target").hide();
        });
        $("#search_type_designpattern_target").hide();
        $("#search_bar_advanced").hide();
        $("#search_sort_Category").hide();
        $("#search_sort_Component").hide();
        $("#search_sort_Platform").hide();
        $("#search_sort_Property").hide();
        $("#search_sort_System").hide();

        $(".classic").change(function(e) {
            enableCheckBoxChild($(this));

        });
        $(".tri-state").change(function(e) {
            enableTriStateCheckBox($(this));
        });

    });
</script>

<aside id="search">
    <h3>SEARCH</h3>
    <form id="search_form" method="post" action="/site/controller/search/ctrlSearch.php">
        <input type="text" id="search_keywords" name="search_keywords" size="23"/><br/><br/>
        <input class="search_type_notarget" type="radio" name="search_type_table" value="Conflict" checked>Conflict<br>
        <input class="search_type_target" type="radio" name="search_type_table" value="DesignPattern">Design Pattern<br>
        <div id="search_type_designpattern_target" style="padding-left:20px;">
            <input type="radio" name="search_type_designpattern_target" value="Designer" checked>Designer<br>
            <input type="radio" name="search_type_designpattern_target" value="Evaluator">Evaluator<br>
        </div>
        <input class="search_type_notarget" type="radio" name="search_type_table" value="Solution">Solution<br>
        <br/>
        <div style="text-align:right;">
            <a href="#" onclick="toggleObject('#search_bar_advanced');return false;">[+] Advanced search</a>
        </div>
        <div id="search_bar_advanced">
            <br/>
            <ul>
                <?php
                ToolkitDisplay::displayCheckboxesComplete($bdd, "Category");
                ToolkitDisplay::displayCheckboxesComplete($bdd, "Component");
                ToolkitDisplay::displayCheckboxesComplete($bdd, "Platform");
                ToolkitDisplay::displayCheckboxesComplete($bdd, "Property");
                ToolkitDisplay::displayCheckboxesComplete($bdd, "System");
                ?>
            </ul>
        </div>
        <br/>
        <input type="submit" value="Search" style="float:right;"/>
    </form>
</aside>