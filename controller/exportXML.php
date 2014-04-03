<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/project.php");
if(isset($_GET['idProject'])){
    
    $project = Project::getDB($_GET['idProject']);
    $nameFile = "project_".$project->getName()."_".$project->getID().".xml";
    $full_path = $_SERVER['DOCUMENT_ROOT']."/site/export/".$nameFile;
    $file = fopen($full_path, 'w+');
    
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
    
    $file_name = basename($full_path);

    ini_set('zlib.output_compression', 0);
    $date = gmdate(DATE_RFC1123);

    header('Pragma: public');
    header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');

    header('Content-Tranfer-Encoding: none');
    header('Content-Length: '.filesize($full_path));
    header('Content-MD5: '.base64_encode(md5_file($full_path)));
    header('Content-Type: application/octetstream; name="'.$file_name.'"');
    header('Content-Disposition: attachment; filename="'.$file_name.'"');

    header('Date: '.$date);
    header('Expires: '.gmdate(DATE_RFC1123, time()+1));
    header('Last-Modified: '.gmdate(DATE_RFC1123, filemtime($full_path)));

    readfile($full_path);
    exit; // nécessaire pour être certain de ne pas envoyer de fichier corrompu

}

