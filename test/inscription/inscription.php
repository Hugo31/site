
<!DOCTYPE html>

<html>
    <head>
        <link rel="icon" type="image/png" href="./img/favicon.ico" />
        <title> UI Design Pattern Community </title>

        <!-- meta -->
        <meta charset="UTF-8">
        <meta name="author" content="Laurine MARMISSE & Loic VIGUIER & Loic FAURE & Hugo GUIGNARD" />
        <meta name="description" content="Site sur la gestion communautaire de design pattern" />
        <meta name="keywords" content="design pattern, ui, user interface, guideline, community, database" />
        <meta name="robots" content="All" />

        <link rel="stylesheet" type="text/css" href="styles/styleBase.css" media="all" />
        <link rel="stylesheet" type="text/css" href="styles/stylePlus.css" media="all" />
        <link rel="stylesheet" type="text/css" href="styles/styleStructure.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/styleForm.css" media="screen" />

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/site/javascript/toolkit.js"></script>
        <script type="text/javascript" src="signupcontrol.js"></script>
    </head>

    <body>
        <div id="global">
            <header id="header">
                <div id="headercontent">
                    <img src="./img/header/logo_modif_gris.png" style="height:80px">
                    <div id="navigation">
                        <div style="height:40px">
                            <form id="loginForm2" action="#">
                                <input type="text" id="inpUsernameEmail" class="texte" placeholder="Username">
                                <input type="text" id="inpPasswordPlaceholder" class="texte" placeholder="Password">
                                <input value="SIGN IN" class="signin" type="button">
                                <input value="SIGN UP" type="button" class="signup">
                            </form>
                        </div>
                        <nav id="menu">
                            <a href="#">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#">News</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#">My current Design Pattern (0)</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#">Existing Projects</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#">Contact</a>
                        </nav>
                    </div>
                </div>
            </header>

            <div id="centre">
                <aside id="search">
                    <h3>SEARCH</h3>
                </aside><!-- #navigation -->

                <section id="contenu">
                    <h1>Sign up</h1>
                    <div id="formulaire">
                        <form method="post" id="formsignup" name="formsignup"
                              action="./validsignup.php" onsubmit="return valider($(this));">
                            <p>
                                <label for="usernamesignup" class="uname">Your username</label><br/>
                                <input type="text" id="usernamesignup" name="usernamesignup" 
                                       required="required" size="30" maxlength="30" 
                                       placeholder="JeanMichelDu31" />
                            </p>
                            <p>
                                <label for="emailsignup" class="uemail">Your email</label><br/>
                                <input type="email" id="emailsignup" name="emailsignup" 
                                       required="required" size="30" maxlength="30" 
                                       placeholder="jeanmi31@univ-tlse.fr" />
                            </p>
                            <p>
                                <label for="passwordsignup" class="upasswd">Your password</label><br/>
                                <input type="password" id="passwordsignup" name="passwordsignup" 
                                       required="required" size="30" maxlength="30"
                                       placeholder="ex : michmich31" />
                            </p>
                            <p>
                                <label for="passwordsignup_confirm" class="upasswd" data-icon="p">Please confirm your password</label><br/>
                                <input type="password" id="passwordsignup_confirm" name="passwordsignup_confirm" 
                                       required="required" size="30" maxlength="30" 
                                       placeholder="ex : michmich31" />
                            </p>
                            <p>
                                <input type="submit" value="SIGN UP" class="signupform" />
                            </p>
                        </form>
                    </div>
                </section>
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
                    <div style="width:146px;height:230px;float:left;margin-right:4px;padding:0px 10px 0px 10px;">
                        <center><h4>Sitemap</h4></center>
                        <ul>
                            <li><a>Home</a></li>
                            <li><a>My current Design Pattern (0)</a></li>
                            <li><a>Existing Projects</a></li>
                            <li><a>Contact</a></li>
                        </ul>
                    </div>
                    <div style="width:146px;height:230px;float:left;margin-right:4px;padding:0px 10px 0px 10px;">
                        <center><h4>Design Patterns</h4></center>
                        <ul>
                            <li><a>News</a></li>
                            <li><a>Most used</a></li>
                            <li><a>Most popular</a></li>
                        </ul>	
                    </div>
                    <div style="width:146px;height:230px;float:left;padding:0px 10px 0px 10px;margin-right:4px;">
                        <center><h4>Information</h4></center>
                        <ul>
                            <li><a>Developers</a></li>
                            <li><a>Report a problem</a></li>
                            <li><a>Legal notice</a></li>
                            <li><a>Sitemap</a></li>
                        </ul>
                    </div>
                    <div style="width:146px;float:left;padding-top:60px;text-align:center">
                        <input value="SIGN UP" type="button" class="signupfooter">
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
