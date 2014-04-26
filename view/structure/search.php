<?php
    $bdd = Database::getConnection();   
?>

<aside id="search">
    
    <h3>SEARCH</h3> 
    <form id="search_form" method="post" action="/site/controller/search/ctrlSearch.php">
        <input type="text" id="search_keywords" name="search_keywords" <?php ToolkitDisplay::addValue($session->searchTextQuery); ?>/><br/><br/>
        <label><input class="search_type_notarget" type="radio" name="search_type_table" value="Conflict" <?php ToolkitDisplay::checkItem($session->typeQuery, "Conflict"); ?>>Conflict</label><br/>
        <label><input class="search_type_target" type="radio" name="search_type_table" value="DesignPattern" <?php ToolkitDisplay::checkItem($session->typeQuery, "DesignPattern"); if (!isset($session->typeQuery)) { echo "checked"; }?>>Design Pattern</label><br/>
        <div id="search_type_designpattern_target" style="padding-left:20px;">
            <label><input type="radio" name="search_type_designpattern_target" value="Designer" <?php ToolkitDisplay::checkItem($session->targetQuery, "Designer"); if (!isset($session->targetQuery)) { echo "checked"; }?>>Designer</label><br/>
            <label><input type="radio" name="search_type_designpattern_target" value="Evaluator" <?php ToolkitDisplay::checkItem($session->targetQuery, "Evaluator"); ?>>Evaluator</label><br/>
        </div>
        <label><input class="search_type_notarget" type="radio" name="search_type_table" value="Solution" <?php ToolkitDisplay::checkItem($session->typeQuery, "Solution"); ?>>Solution</label><br/>
        <label><input class="search_type_notarget" type="radio" name="search_type_table" value="Project" <?php ToolkitDisplay::checkItem($session->typeQuery, "Project"); ?>>Project</label><br/>
        <br/>
        <div>
            <a id="search_advancedLink" href="#" onclick="toggleObject('#search_bar_advanced');changeValueSpanSearch('#search_advancedLink_span'); return false;">Advanced search <span id="search_advancedLink_span">[+]</span></a>
        </div>
        <div id="search_bar_advanced">
            <br/>
            <ul>
                <?php
                ToolkitDisplay::displayCheckboxesComplete($bdd, "Category", $session->idCategoryQuery);
                ToolkitDisplay::displayCheckboxesComplete($bdd, "Component", $session->idComponentQuery);
                ToolkitDisplay::displayCheckboxesComplete($bdd, "Platform", $session->idPlatformQuery);
                ToolkitDisplay::displayCheckboxesComplete($bdd, "Property", $session->idPropertyQuery);
                ToolkitDisplay::displayCheckboxesComplete($bdd, "System", $session->idSystemQuery);
                ?>
            </ul>
        </div>
        <br/>
        <input type="submit" value="SEARCH" class="search" style="float:right;"/>
    </form>
</aside>

<script>
    $(function() {
        $(".classic").change(function(e) {
            enableCheckBoxChild($(this));

        });
        $(".tri-state").change(function(e) {
            enableTriStateCheckBox($(this));
        });
        $(":radio.search_type_target").change(function() {
            $("#search_type_designpattern_target").show("clip");
            $("#search_advancedLink").show("clip");
        });
        $(":radio.search_type_notarget").change(function() {
            $("#search_type_designpattern_target").hide();
            $("#search_advancedLink").hide();
            $("#search_bar_advanced").hide();
        });
        $("#search_bar_advanced").hide();
        $("#search_sort_Category").hide();
        $("#search_sort_Component").hide();
        $("#search_sort_Platform").hide();
        $("#search_sort_Property").hide();
        $("#search_sort_System").hide();
        <?php
            if (isset($session->typeQuery)) {
                if ($session->typeQuery != "DesignPattern") {
                    echo "$(\"#search_type_designpattern_target\").hide();";
                    echo "$(\"#search_advancedLink\").hide();";
                    
                } else {
                    if (($session->idCategoryQuery["nb"] > 0) || ($session->idComponentQuery["nb"] > 0) ||
                        ($session->idPlatformQuery["nb"] > 0) || ($session->idPropertyQuery["nb"] > 0) ||
                        ($session->idSystemQuery["nb"] > 0)
                        ) {
                        echo "$(\"#search_bar_advanced\").show();";

                        if ($session->idCategoryQuery["nb"] > 0) { echo "$('#search_sort_Category').show();$('#search_sort_Category_a').text('[-]');"; }
                        if ($session->idComponentQuery["nb"] > 0) { echo "$('#search_sort_Component').show();$('#search_sort_Component_a').text('[-]');"; }
                        if ($session->idPlatformQuery["nb"] > 0) { echo "$('#search_sort_Platform').show();$('#search_sort_Platform_a').text('[-]');"; }
                        if ($session->idPropertyQuery["nb"] > 0) { echo "$('#search_sort_Property').show();$('#search_sort_Property_a').text('[-]');"; }
                        if ($session->idSystemQuery["nb"] > 0) { echo "$('#search_sort_System').show();$('#search_sort_System_a').text('[-]');"; }

                    }
                }
            }
            
        ?>
        $(".classic").trigger("change");
    });
</script>