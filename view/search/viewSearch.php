<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
<script type="text/javascript" src="/site/javascript/toolkit.js"></script>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolKitDisplay.php");
$bdd = Database::getConnection();
?>
<style>
    /*
	 CSS-Tricks Example
	 by Chris Coyier
	 http://css-tricks.com
*/

* { margin: 0; padding: 0; }
body { font: 14px Georgia, serif; }

article, aside, figure, footer, header, hgroup,
menu, nav, section { display: block; }

#page-wrap { width: 960px; margin: 80px auto; }

ul { 
  list-style: none;
  margin: 5px 20px;
}
li {
  margin: 0 0 5px 0;
}
    
</style>
<script>
  	$(function() {
            // Apparently click is better chan change? Cuz IE?
            $('input[type="checkbox"]').change(function(e) {
                var checked = $(this).prop("checked"),
                container = $(this).parent(),
                siblings = container.siblings();

                container.find('input[type="checkbox"]').prop({
                    indeterminate: false,
                    checked: checked
                });

                function checkSiblings(el) {
                    var parent = el.parent().parent(),
                    all = true;

                    el.siblings().each(function() {
                        return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
                    });

                    if (all && checked) {
                        parent.children('input[type="checkbox"]').prop({
                            indeterminate: false,
                            checked: checked
                        });
                        checkSiblings(parent);
                    } else if (all && !checked) {
                        parent.children('input[type="checkbox"]').prop("checked", checked);
                        parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                        checkSiblings(parent);
                    } else {
                        el.parents("li").children('input[type="checkbox"]').prop({
                            indeterminate: true,
                            checked: false
                        });
                    }
                }

                checkSiblings(container);
            });
        });
    </script>
    
    
<div id="search_bar">
    <div id="search_bar_basic">
        <form id="search_form" method="post" action="/site/controller/search/ctrlSearch.php">
            <input type="text" id="search_keywords" name="search_keywords" /><br>
            <input class="search_type_notarget" type="radio" name="search_type_table" value="Conflict" checked>Conflict<br>
            <input class="search_type_target" type="radio" name="search_type_table" value="DesignPattern">Design Pattern<br>
            <div id="search_type_designpattern_target">
                <input type="radio" name="search_type_designpattern_target" value="Designer" checked>Designer<br>
                <input type="radio" name="search_type_designpattern_target" value="Evaluator">Evaluator<br>
            </div>
            <input class="search_type_notarget" type="radio" name="search_type_table" value="Solution">Solution<br>
            
            <div>
                <a href="#" onclick="runEffect('#search_bar_advanced'); return false;">Advanced search</a>
            </div>
            <div id="search_bar_advanced">
                <a href="#" onclick="runEffect('#search_sort_category'); return false;">Categories</a><br>
                <div id="search_sort_category">
                    <?php
                        $req = "SELECT idCategory AS id, name FROM Category";
                        ToolKitDisplay::displayCheckBoxCriteria("Category", $bdd->query($req));
                    ?>
                </div>
                <a href="#" onclick="runEffect('#search_sort_component'); return false;">Components</a><br>
                <div id="search_sort_component">
                    <?php
                        $req = "SELECT idComponent AS id, name FROM Component";
                        ToolKitDisplay::displayCheckBoxCriteria("Component", $bdd->query($req));
                    ?>
                </div>

                <a href="#" onclick="runEffect('#search_sort_platform'); return false;">Platforms</a><br>
                <div id="search_sort_platform">
                    <?php
                        $req = "SELECT idPlatform AS id, name FROM Platform";
                        ToolKitDisplay::displayCheckBoxCriteria("Platform", $bdd->query($req));
                    ?>
                </div>
                <a href="#" onclick="runEffect('#search_sort_property'); return false;">Properties</a><br>
                <div id="search_sort_property">
                    <?php
                        $req = "SELECT idProperty AS id, name FROM Property";
                        ToolKitDisplay::displayCheckBoxCriteria("Property", $bdd->query($req));
                    ?>
                </div>

                <a href="#" onclick="runEffect('#search_sort_system'); return false;">Systems</a><br>
                <div id="search_sort_system">
                    <?php
                        $req = "SELECT idSystem AS id, name FROM System";
                        ToolKitDisplay::displayCheckBoxCriteria("System", $bdd->query($req));
                    ?>
                </div>
                
                <div id="page-wrap">
	
	   <h1>Indeterminate Checkboxes</h1>
		
  	 <ul>
        <li>
            <input type="checkbox" name="tall" id="tall">
            <label for="tall">Tall Things</label>
            
            <ul>
                 <li>
                     <input type="checkbox" name="tall-1" id="tall-1" >
                     <label for="tall-1">Buildings</label>
                 </li>
                 <li>
                     <input type="checkbox" name="tall-2" id="tall-2">
                     <label for="tall-2">Giants</label>
                     
                     <ul>
                         <li>
                             <input type="checkbox" name="tall-2-1" id="tall-2-1">
                             <label for="tall-2-1">Andre</label>
                         </li>
                         <li>
                             <input type="checkbox" name="tall-2-2" id="tall-2-2">
                             <label for="tall-2-2">Paul Bunyan</label>
                         </li>
                     </ul>
                 </li>
                 <li>
                     <input type="checkbox" name="tall-3" id="tall-3">
                     <label for="tall-3">Two sandwiches</label>
                 </li>
            </ul>
        </li>
        <li>
            <input type="checkbox" name="short" id="short">
            <label for="short">Short Things</label>
            
            <ul>
                 <li>
                     <input type="checkbox" name="short-1" id="short-1">
                     <label for="short-1">Smurfs</label>
                 </li>
                 <li>
                     <input type="checkbox" name="short-2" id="short-2">
                     <label for="short-2">Mushrooms</label>
                 </li>
                 <li>
                     <input type="checkbox" name="short-3" id="short-3">
                     <label for="short-3">One Sandwich</label>
                 </li>
            </ul>
        </li>
    </ul>
	
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
        $("#search_type_designpattern_target").hide();
        $("#search_bar_advanced").hide();
        $("#search_sort_category").hide();
        $("#search_sort_component").hide();
        $("#search_sort_platform").hide();
        $("#search_sort_property").hide();
        $("#search_sort_system").hide();
        //enableTriStateCheckBox("#tall");
    </script>
</div>
