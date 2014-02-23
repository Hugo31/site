<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");

class ToolkitDetails {
    public static function displayDetailsConflict($req){
        
    }
    
    public static function displayDetailsDesignPattern($id){
        $donnees = Database::getOneData("SELECT * FROM DesignPattern WHERE idDesignPattern = ".$id);
        
        if($donnees != false){
            ToolkitDetailsDesignPattern::displayImages($id);
            ToolkitDisplayDesignPattern::displaySources($id);
            ToolkitDetailsDesignPattern::displayCriteria($id);
            
            ToolkitDisplay::displayCommentLittle($id);
            ToolkitDisplay::displayRate($id);
        }
    }
/*    
$requete = "SELECT link FROM ImageDesignPattern WHERE idDesignPattern = :idDP";
$requete = "SELECT author, link FROM Source WHERE idDesignPattern = :idDP";
$requete = "SELECT name FROM Category c, CategoryDesignPattern cdp WHERE idDesignPattern = :idDP AND c.idCategory = cdp.idCategory";
$requete = "SELECT name FROM Component c, ComponentDesignPattern cdp WHERE idDesignPattern = :idDP AND c.idComponent = cdp.idComponent";
$requete = "SELECT name FROM Component c, ComponentRelatedDesignPattern cdp WHERE idDesignPattern = :idDP AND c.idComponent = cdp.idComponent";
$requete = "SELECT name FROM Platform p, PlatformDesignPattern pdp WHERE idDesignPattern = :idDP AND p.idPlatform = pdp.idPlatform";
$requete = "SELECT name, note FROM Property p, PropertyDesignPattern pdp WHERE idDesignPattern = :idDP AND p.idProperty = pdp.idProperty";
$requete = "SELECT name FROM System s, SystemDesignPattern sdp WHERE idDesignPattern = :idDP AND s.idSystem = sdp.idSystem";
$requete = "SELECT * FROM CommentDesignPattern WHERE idDesignPattern = :idDP ORDER BY date DESC LIMIT 0, 3";
$requete = "SELECT COUNT(*), AVG(note) FROM NoteDesignPattern WHERE idDesignPattern = :idDP";
*/
    public static function displayDetailsSolution($req){
        
    }
    
    public static function displayDetailsProject($req){
        
    }
}

?>