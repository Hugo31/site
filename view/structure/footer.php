<?php
?>

            </div>

            <footer id="footer">
                <div id ="footercontent">
                    <div style="width:310px;height:230px;float:left;margin-right:4px;padding:0px 10px 0px 10px;">
                        <center><h4>UI Design Pattern Community</h4></center>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This site allows sharing and community management of design patterns. 
                        It allows you to search on several criteria required design patterns 
                        to specific needs related to a project. It should also allow comment 
                        these design patterns, report conflicts between different design patterns 
                        and provide solutions to these conflicts.
                    </div>
                    <div style="text-align:left;width:146px;height:230px;float:left;margin-right:4px;padding:0px 10px 0px 10px;">
                        <center><h4>Sitemap</h4></center>
                        <ul>
                            <li><a href="/site/index.php">Home</a></li>
                            <li><a href="/site/view/currentDP.php">My current Design Pattern (<span class="currentDP_numberIn"><?php ToolKitSearch::getNbCurrentCart($session) ?></span>)</a></li>
                            <li><a href="/site/view/contact.php">Contact</a></li>
                        </ul>
                    </div>
                    <div style="width:146px;height:230px;float:left;margin-right:4px;padding:0px 10px 0px 10px;">
                        <center><h4>Design Patterns</h4></center>
                        <ul>
                            <li href="/site/view/news.php"><a>News</a></li>
                            <li href=""><a>Most used</a></li>
                            <li href=""><a>Most popular</a></li>
                        </ul>	
                    </div>
                    <div style="width:146px;height:230px;float:left;padding:0px 10px 0px 10px;margin-right:4px;">
                        <center><h4>Information</h4></center>
                        <ul>
                            <li href="/site/view/reportProblem.php"><a>Report a problem</a></li>
                            <li href="/site/view/legalNotice.php"><a>Legal notice</a></li>
                            <li href="/site/view/sitemap.php"><a>Sitemap</a></li>
                        </ul>
                    </div>
                    <div style="width:146px;float:left;padding-top:60px;text-align:center">
                        <a href="/site/view/signup.php" style="text-decoration: none">
                            <input value="SIGN UP" type="button" class="signupfooter">
                        </a>
                    </div>
                </div>
            </footer>

        </div>

    </body>
    
</html>
