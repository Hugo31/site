<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
<script type="text/javascript" src="/site/javascript/toolkit.js"></script>
<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolKitDisplay.php");
$bdd = Database::getConnection();
?>    
    
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
                <?php
                $req = "SELECT COUNT(*) AS nb FROM Category";
                $data = $bdd->query($req);
                echo "<input type=\"checkbox\" name=\"idCategory\" value=\"".$data->fetch()["nb"]."\"/>";
                ?>
                
                <a href="#" onclick="runEffect('#search_sort_category'); return false;">Categories</a><br>
                <div id="search_sort_category">
                    <?php
                        ToolKitDisplay::displayCheckBoxCriteria("Category", $bdd->query("SELECT idCategory AS id, name FROM Category"));
                    ?>
                </div>
                <input type="checkbox" name="idComponent" value=""/>
                <a href="#" onclick="runEffect('#search_sort_component'); return false;">Components</a><br>
                <div id="search_sort_component">
                    <?php
                        ToolKitDisplay::displayCheckBoxCriteria("Component", $bdd->query("SELECT idComponent AS id, name FROM Component"));
                    ?>
                </div>
                <input type="checkbox" name="idPlatform" value=""/>
                <a href="#" onclick="runEffect('#search_sort_platform'); return false;">Platforms</a><br>
                <div id="search_sort_platform">
                    <?php
                        ToolKitDisplay::displayCheckBoxCriteria("Platform", $bdd->query("SELECT idPlatform AS id, name FROM Platform"));
                    ?>
                </div>
                <input type="checkbox" name="idProperty" value=""/>
                <a href="#" onclick="runEffect('#search_sort_property'); return false;">Properties</a><br>
                <div id="search_sort_property">
                    <?php
                        ToolKitDisplay::displayCheckBoxCriteria("Property", $bdd->query("SELECT idProperty AS id, name FROM Property"));
                    ?>
                </div>
                <input type="checkbox" name="idSystem" value=""/>
                <a href="#" onclick="runEffect('#search_sort_system'); return false;">Systems</a><br>
                <div id="search_sort_system">
                    <?php
                        ToolKitDisplay::displayCheckBoxCriteria("System", $bdd->query("SELECT idSystem AS id, name FROM System"));
                    ?>
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
    </script>
</div>
