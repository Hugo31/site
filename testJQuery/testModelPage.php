<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/user/User.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/designpattern/ETarget.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/conflict/Conflict.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/rate/solution/Solution.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/project/Project.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/component/Component.php");	  
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/other/Category.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/other/Platform.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/other/System.php");			  
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/criteria/property/Property.php");
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $bdd = Database::getConnection();
        $sql = file_get_contents($_SERVER['DOCUMENT_ROOT']."/site/projet.sql");
        $bdd->exec($sql);
        echo "<table>";
        
        $userUndef = new User("undefined", "test", "Broman", "Robert", "r.broman@gmail.com", "");
        //echo "<tr><td>User ajouté : </td><td>".User::addDB($userUndef)."</td></tr>";
        $anotherUser = User::getDB($userUndef->getLogin());
        $anotherUser->setLastName("Johnson");
        echo "<tr><td>User modifié : </td><td>".User::modifyDB($anotherUser)."</td></tr>";
        echo "<tr><td>User supprimer : </td><td>".User::removeDB($userUndef)."</td></tr>";
        echo "<tr><td>User ajouté pour la suite des tests : </td><td>".User::addDB($userUndef)."</td></tr>";
        
        $dpFactory = new DesignPattern(0, "Unnamed", $userUndef->getLogin(), date("Y-m-d H:i:s"), "Construit une classe qui construit d'autres classes", 0, ETarget::Designer);
        echo "<tr><td>DP ajouté : </td><td>".DesignPattern::addDB($dpFactory)."</td></tr>";
        $anotherDP = DesignPattern::getDB($dpFactory->getID());
        $anotherDP->setName("Factory");
        echo "<tr><td>DP modifié : </td><td>".DesignPattern::modifyDB($anotherDP)."</td></tr>";
        echo "<tr><td>DP supprimer : </td><td>".DesignPattern::removeDB($anotherDP)."</td></tr>";
        echo "<tr><td>DP ajouté pour la suite des tests : </td><td>".DesignPattern::addDB($dpFactory)."</td></tr>";
        $dpObserver = new DesignPattern(0, "Observer", $userUndef->getLogin(), date("Y-m-d H:i:s"), "Verifie des classes", 0, ETarget::Designer);
        echo "<tr><td>DP 2 ajouter : </td><td>".  DesignPattern::addDB($dpObserver)."</td></tr>";
        
        $conflict1 = new Conflict(0, "Conflict", "undefined", date("Y-m-d H:i:s"), "Description de conflict", "Conflict between design pattern");
        echo "<tr><td>Conflict ajouté : </td><td>".Conflict::addDB($conflict1)."</td></tr>";
        $conflictMod = Conflict::getDB($conflict1->getID());
        $conflictMod->setName("New Conflict");
        echo "<tr><td>Conflict modifié : </td><td>".Conflict::modifyDB($conflictMod)."</td></tr>";
        echo "<tr><td>Conflict supprimé : </td><td>".Conflict::removeDB($conflict1)."</td></tr>";
        echo "<tr><td>Conflict ajouté : </td><td>".Conflict::addDB($conflict1)."</td></tr>";
        
        echo "<tr><td>Lien entre Factory et conflict1 ajouter : </td><td>".$conflict1->addLink($dpFactory)."</td></tr>";
        echo "<tr><td>Lien entre Observer et conflict1 ajouter : </td><td>".$conflict1->addLink($dpObserver)."</td></tr>";
        echo "<tr><td>Lien entre Factory et conflict1 supprimer : </td><td>".$conflict1->removeLink($dpFactory)."</td></tr>";
        echo "<tr><td>Lien entre Factory et conflict1 ajouter : </td><td>".$conflict1->addLink($dpFactory)."</td></tr>";
        
        $solution = new Solution(0, "Sol1", "undefined", date("Y-m-d H:i:s"), "Comment", "Code", $conflict1->getID());
        echo "<tr><td>Solution ajoutée : </td><td>".Solution::addDB($solution)."</td></tr>";
        $otherS = Solution::getDB($solution->getID());
        $otherS->setName("New Sol");
        echo "<tr><td>Solution modifié : </td><td>".Solution::modifyDB($otherS)."</td></tr>";
        echo "<tr><td>Solution supprimé : </td><td>".Solution::removeDB($solution)."</td></tr>";
        echo "<tr><td>Solution ajouté : </td><td>".Solution::addDB($solution)."</td></tr>";
        
        
        $project = new Project(0, "Projet 1", "undefined", date("Y-m-d H:i:s"), "Description du projet");
        echo "<tr><td>Projet ajouté : </td><td>".Project::addDB($project)."</td></tr>";
        $projectS = Project::getDB($project->getID());
        $projectS->setName("New Sol");
        echo "<tr><td>Project modifié : </td><td>".Project::modifyDB($projectS)."</td></tr>";
        echo "<tr><td>Project supprimé : </td><td>".Project::removeDB($project)."</td></tr>";
        echo "<tr><td>Project ajouté : </td><td>".Project::addDB($project)."</td></tr>";
        
        
        $component = new Component(0, "menu", "C'est un menu");
        echo "<tr><td>Component ajouté : </td><td>".Component::addDB($component)."</td></tr>";
        $otherComp = Component::getDB($component->getID());
        $otherComp->setDescription("C'est un menu opé");
        echo "<tr><td>Component modifié : </td><td>".Component::modifyDB($otherComp)."</td></tr>";
        echo "<tr><td>Component supprimé : </td><td>".Component::removeDB($component)."</td></tr>";
        echo "<tr><td>Component ajouté : </td><td>".Component::addDB($component)."</td></tr>";
        echo "<tr><td>Lien component ajouté</td><td>".$component->addLink($dpFactory)."</td></tr>";
        echo "<tr><td>Lien component relatif ajouté</td><td>".$component->addLinkRelated($dpFactory)."</td></tr>";
        echo "<tr><td>Lien component supprimer</td><td>".$component->removeLink($dpFactory)."</td></tr>";
        echo "<tr><td>Lien component relatif supprimer</td><td>".$component->removeLinkRelated($dpFactory)."</td></tr>";
        
        $category = new Category(0, "category", "C'est une category");
        echo "<tr><td>Category ajouté : </td><td>".Category::addDB($category)."</td></tr>";
        $otherCat = Category::getDB($category->getID());
        $otherCat->setDescription("C'est un menu opé");
        echo "<tr><td>Category modifié : </td><td>".Category::modifyDB($otherCat)."</td></tr>";
        echo "<tr><td>Category supprimé : </td><td>".Category::removeDB($category)."</td></tr>";
        echo "<tr><td>Category ajouté : </td><td>".Category::addDB($category)."</td></tr>";
        echo "<tr><td>Lien category ajouté</td><td>".$category->addLink($dpFactory)."</td></tr>";
        echo "<tr><td>Lien category supprimer</td><td>".$category->removeLink($dpFactory)."</td></tr>";
        
        $platform = new Platform(0, "menu", "C'est un menu", "");
        echo "<tr><td>Platform ajouté : </td><td>".Platform::addDB($platform)."</td></tr>";
        $otherPlat = Platform::getDB($platform->getID());
        $otherPlat->setDescription("C'est un menu opé");
        echo "<tr><td>Platform modifié : </td><td>".Platform::modifyDB($otherPlat)."</td></tr>";
        echo "<tr><td>Platform supprimé : </td><td>".Platform::removeDB($platform)."</td></tr>";
        echo "<tr><td>Platform ajouté : </td><td>".Platform::addDB($platform)."</td></tr>";
        echo "<tr><td>Lien platform ajouté</td><td>".$platform->addLink($dpFactory)."</td></tr>";
        echo "<tr><td>Lien platform supprimer</td><td>".$platform->removeLink($dpFactory)."</td></tr>";
        
        $system = new System(0, "menu", "C'est un menu", "");
        echo "<tr><td>System ajouté : </td><td>".System::addDB($system)."</td></tr>";
        $otherSys = System::getDB($system->getID());
        $otherSys->setDescription("C'est un menu opé");
        echo "<tr><td>System modifié : </td><td>".System::modifyDB($otherSys)."</td></tr>";
        echo "<tr><td>System supprimé : </td><td>".System::removeDB($system)."</td></tr>";
        echo "<tr><td>System ajouté : </td><td>".System::addDB($system)."</td></tr>";
        echo "<tr><td>Lien system ajouté</td><td>".$system->addLink($dpFactory)."</td></tr>";
        echo "<tr><td>Lien system supprimer</td><td>".$system->removeLink($dpFactory)."</td></tr>";
        
        $property = new Property(0, "menu", "C'est un menu");
        echo "<tr><td>Property ajouté : </td><td>".Property::addDB($property)."</td></tr>";
        $otherProp = Property::getDB($property->getID());
        $otherProp->setDescription("C'est un menu opé");
        echo "<tr><td>Property modifié : </td><td>".Property::modifyDB($otherProp)."</td></tr>";
        echo "<tr><td>Property supprimé : </td><td>".Property::removeDB($property)."</td></tr>";
        echo "<tr><td>Property ajouté : </td><td>".Property::addDB($property)."</td></tr>";
        echo "<tr><td>Lien property ajouté</td><td>".$property->addLink($dpFactory, 5)."</td></tr>";
        echo "<tr><td>Lien property supprimer</td><td>".$property->removeLink($dpFactory)."</td></tr>";
        
        echo "</table>";
        
        ?>
    </body>
</html>
