<?php
    $bdd = Database::getConnection();
    $session = Session::getInstance();
    
?>

<script>
    $(function() {
        $(":radio.search_type_target").change(function() {
            $("#search_type_designpattern_target").show("clip");
            $("#search_advancedLink").show("clip");
        });
        $(":radio.search_type_notarget").change(function() {
            $("#search_type_designpattern_target").hide();
            $("#search_advancedLink").hide();
        });
        $("#search_bar_advanced").hide();
        $("#search_sort_Category").hide();
        $("#search_sort_Component").hide();
        $("#search_sort_Platform").hide();
        $("#search_sort_Property").hide();
        $("#search_sort_System").hide();
        <?php
            if(isset($session->typeQuery)){
                if($session->typeQuery != "DesignPattern"){
                    echo "$(\"#search_type_designpattern_target\").hide();";
                    echo "$(\"#search_advancedLink\").hide();";
                }
            }
            if(($session->idCategoryQuery["nb"] > 0) || ($session->idComponentQuery["nb"] > 0) ||
                ($session->idPlatformQuery["nb"] > 0) || ($session->idPropertyQuery["nb"] > 0) ||
                ($session->idSystemQuery["nb"] > 0)
                ){
                echo "$(\"#search_bar_advanced\").show();";
            }
            else{
                if($session->idCategoryQuery["nb"] > 0){ echo "$(\"#search_sort_Category\").show();"; }
                if($session->idComponentQuery["nb"] > 0){ echo "$(\"#search_sort_Component\").show();"; }
                if($session->idPlatformQuery["nb"] > 0){ echo "$(\"#search_sort_Platform\").show();"; }
                if($session->idPropertyQuery["nb"] > 0){ echo "$(\"#search_sort_Property\").show();"; }
                if($session->idSystemQuery["nb"] > 0){ echo "$(\"#search_sort_System\").show();"; }
            }
        ?>
        

        $(".classic").change(function(e) {
            enableCheckBoxChild($(this));

        });
        $(".tri-state").change(function(e) {
            enableTriStateCheckBox($(this));
        });
        
        $(".classic").trigger("change");

    });
</script>

<aside id="search">
    <h3>SEARCH</h3>
    <form id="search_form" method="post" action="/site/controller/search/ctrlSearch.php">
        <input type="text" id="search_keywords" name="search_keywords" style="width:100%" <?php ToolkitDisplay::addValue($session->searchTextQuery); ?>/><br/><br/>
        <input class="search_type_notarget" type="radio" name="search_type_table" value="Conflict" <?php ToolkitDisplay::checkItem($session->typeQuery, "Conflict"); ?>>Conflict<br>
        <input class="search_type_target" type="radio" name="search_type_table" value="DesignPattern" <?php ToolkitDisplay::checkItem($session->typeQuery, "DesignPattern"); ?>>Design Pattern<br>
        <div id="search_type_designpattern_target" style="padding-left:20px;">
            <input type="radio" name="search_type_designpattern_target" value="Designer" <?php ToolkitDisplay::checkItem($session->targetQuery, "Designer"); ?>>Designer<br>
            <input type="radio" name="search_type_designpattern_target" value="Evaluator" <?php ToolkitDisplay::checkItem($session->targetQuery, "Evaluator"); ?>>Evaluator<br>
        </div>
        <input class="search_type_notarget" type="radio" name="search_type_table" value="Solution" <?php ToolkitDisplay::checkItem($session->typeQuery, "Solution"); ?>>Solution<br>
        <br/>
        <div style="text-align:right;">
            <a id="search_advancedLink" href="#" onclick="toggleObject('#search_bar_advanced');return false;">Advanced search [+]</a>
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