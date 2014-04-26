<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/project.php");
if (isset($_GET['idProject'])) {
    
    $project = Project::getDB($_GET['idProject']);
    $nameFile = "project_".$project->getName()."_".$project->getID().".xml";
    $fullPath = $_SERVER['DOCUMENT_ROOT']."/site/export/".$nameFile;
    $file = fopen($fullPath, 'w+');
    
    fwrite($file, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"); 
    fwrite($file, "<Project>\n");
    fwrite($file, "\t<name>".$project->getName()."</name>\n");
    fwrite($file, "\t<description>".$project->getDescription()."</description>\n");
    fwrite($file, "\t<DesignsPatterns>\n");

    $response = Database::getAllData("SELECT idDesignPattern FROM ProjectDesignPattern WHERE idProject = ".$_GET['idProject']);
    foreach ($response as $row) {
        $dp = DesignPattern::getDB($row['idDesignPattern']);
        fwrite($file, "\t\t<DesignPattern>\n");
        fwrite($file, "\t\t\t<name>".$dp->getName()."</name>\n");
        fwrite($file, "\t\t\t<target>".  ETarget::getNameEnum($dp->getTarget())."</target>\n");
        fwrite($file, "\t\t\t<what>".$dp->getWhat()."</what>\n");
        fwrite($file, "\t\t\t<whenandhow>".$dp->getWhenAndHow()."</whenandhow>\n");
        fwrite($file, "\t\t\t<layout>".$dp->getLayout()."</layout>\n");
        fwrite($file, "\t\t\t<copy>".$dp->getCopy()."</copy>\n");
        fwrite($file, "\t\t\t<implementation>".$dp->getImplementation()."</implementation>\n");
        fwrite($file, "\t\t\t<descriptionImage>".$dp->getDescriptionImage()."</descriptionImage>\n");
        fwrite($file, "\t\t\t<Images>\n");
        $images = Database::getAllData("SELECT * FROM ImageDesignPattern WHERE idDesignPattern = ".$dp->getID());
        foreach ($images as $rowI) {
            fwrite($file, "\t\t\t\t<Image>\n");
            fwrite($file, "\t\t\t\t\t<description>".$rowI['description']."</description>\n");
            $element = pathinfo($rowI['link']);
            fwrite($file, "\t\t\t\t\t<name>".$element['filename'].".".$element['extension']."</name>\n");
            fwrite($file, "\t\t\t\t</Image>\n");
        }
        fwrite($file, "\t\t\t</Images>\n");
        fwrite($file, "\t\t\t<Sources>\n");
        $sources = Database::getAllData("SELECT * FROM Source WHERE idDesignPattern = ".$dp->getID());
        foreach ($sources as $rowS) {
            fwrite($file, "\t\t\t\t<Source>\n");
            fwrite($file, "\t\t\t\t\t<author>".$rowS['author']."</author>\n");
            fwrite($file, "\t\t\t\t\t<link>".$rowS['link']."</link>\n");
            fwrite($file, "\t\t\t\t</Source>\n");
        }
        fwrite($file, "\t\t\t</Sources>\n");
        fwrite($file, "\t\t</DesignPattern>\n");
    }
    fwrite($file, "\t</DesignsPatterns>\n");
    fwrite($file, "</Project>\n");
    fclose($file);
    
    $file_name = basename($fullPath);

    ini_set('zlib.output_compression', 0);
    $date = gmdate(DATE_RFC1123);

    header('Pragma: public');
    header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');

    header('Content-Tranfer-Encoding: none');
    header('Content-Length: '.filesize($fullPath));
    header('Content-MD5: '.base64_encode(md5_file($fullPath)));
    header('Content-Type: application/octetstream; name="'.$file_name.'"');
    header('Content-Disposition: attachment; filename="'.$file_name.'"');

    header('Date: '.$date);
    header('Expires: '.gmdate(DATE_RFC1123, time() + 1));
    header('Last-Modified: '.gmdate(DATE_RFC1123, filemtime($fullPath)));

    readfile($fullPath);
    exit; // nécessaire pour être certain de ne pas envoyer de fichier corrompu

}

