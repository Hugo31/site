<?php

class ToolKitProject {
    public static function searchAllProjects(){
        $requete = "SELECT DISTINCT p.idProject, p.name, p.description, p.date, p.login FROM Project p";
        return $requete;
    }
}
?>