<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/project.php");
if(isset($_GET['idProject'])){
    
    $project = Project::getDB($_GET['idProject']);
    $nameFile = "project_".$project->getName()."_".$project->getID().".xml";
    
    $file = fopen($_SERVER['DOCUMENT_ROOT']."/site/export/".$nameFile, 'w+');
    
    fputs($file, "<xml version=\"1.0\">\n"); 
    fputs($file, "<Project>\n");
    fputs($file, "\t<name>".$project->getName()."</name>\n");
    fputs($file, "\t<description>".$project->getDescription()."</description>\n");
    fputs($file, "\t<DesignsPatterns>\n");

    $response = Database::getAllData("SELECT idDesignPattern FROM ProjectDesignPattern WHERE idProject = ".$_GET['idProject']);
    foreach($response as $row){
        $dp = DesignPattern::getDB($row['idDesignPattern']);
        fputs($file, "\t\t<DesignPattern>\n");
        fputs($file, "\t\t\t<name>".$dp->getName()."</name>\n");
        fputs($file, "\t\t\t<target>".  ETarget::getNameEnum($dp->getTarget())."</target>\n");
        fputs($file, "\t\t\t<what>".$dp->getWhat()."</what>\n");
        fputs($file, "\t\t\t<whenandhow>".$dp->getWhenAndHow()."</whenandhow>\n");
        fputs($file, "\t\t\t<layout>".$dp->getLayout()."</layout>\n");
        fputs($file, "\t\t\t<copy>".$dp->getCopy()."</copy>\n");
        fputs($file, "\t\t\t<implementation>".$dp->getImplementation()."</implementation>\n");
        fputs($file, "\t\t\t<descriptionImage>".$dp->getDescriptionImage()."</descriptionImage>\n");
        
        fputs($file, "\t\t</DesignPattern>\n");
    }
    fputs($file, "\t</DesignsPatterns>\n");
    fputs($file, "</Project>\n");
    fclose($file);
}

