<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Project.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/designpattern/DesignPattern.php");
    $session = Session::getInstance();
    
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/header.php');   
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/search.php');      
?>

<section id="contenu">
    
    <?php
    $reponse = false;
    $req = "";
    if(isset($session->login)){
        $reqP = "SELECT idProject, name, description FROM Project WHERE login = \"".$session->login."\" AND current = 1;";
        $data = Database::getOneData($reqP);
        if(isset($session->currentDP)){
            $proj = Project::getDB($data['idProject']);
            for ($i = 0; $i < count($session->currentDP); $i ++){
                $proj->addLink(new DesignPattern($session->currentDP[$i], "", "", "", "", "", ""));
            }
            unset($session->currentDP);
        }
        echo "<h1>".$data['name']."</h1>";
        echo "<form action=\"/site/controller/saveProject.php\" method=\"post\">";
        echo "<label>Name : </label><input name=\"name_project\" type=\"text\"/><br/>";
        echo "<label>Description : </label><input name=\"desc_project\" type=\"textarea\"/><br/>";
        echo "<input type=\"submit\" value=\"Save it\"/>";
        echo"</form>";
        echo "<article><h2>Description: </h2>".$data['description']."<br/><br/></article>";
        $req = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp, ProjectDesignPattern proj "
                ."WHERE dp.idDesignPattern = proj.idDesignPattern AND proj.idProject = ".$data['idProject'].";";
    }
    else{
        if(count($session->currentDP) > 0){
            echo "<h1> My current Design Pattern </h1>";
            $req = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what, dp.rate, dp.nbRates, dp.nbComments, dp.nbUsage, dp.date, dp.login FROM DesignPattern dp WHERE ";
            for ($i = 0; $i < count($session->currentDP) - 1; $i ++){
                $req .= "dp.idDesignPattern = ".$session->currentDP[$i]." OR ";
                
            }
            $req .= "dp.idDesignPattern = ".$session->currentDP[$i].";";  
        }
        else{
            echo "<h1> My current Design Pattern </h1> No design pattern selected.";
        }
    }
    $reponse = Database::getAllData($req);
    if($reponse != false){
        ToolKitDisplay::displayDesignPatternBox($reponse, true);
    }
    
    
    ?>
    
</section>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/site/view/structure/footer.php');  
?>
