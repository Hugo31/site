<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBaseSort.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/ILink.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/ESortTable.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");

class Project implements IDataBase, ILink{
    
    private $idProject;
    private $name;
    private $description;
    private $login;
    
    public function __construct($_idProject, $_name, $_description, $_login){
        $this->setID($_idProject);
        $this->setNameProject($_name);
        $this->setDescriptionProject($_description);
        $this->setLogin($_login);
    }
    
    /**
     * Ajoute un projet à la base de données.
     * @param Project $object Le projet à ajouter.
     */
    public static function addDB($object) {
        $bdd = Database::connect();
        $rqt = $bdd->prepare('INSERT INTO project (name, description, login) VALUES(:name, :description, :login)');
        $rqt->execute(array(
            'name' => $object->getNameProject(),
            'description' => $object->getDescriptionProject(),
            'login' => $object->getLogin()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
    }

    /**
     * Donne un projet issu de la base de données.
     * @param int $id L'identifiant du projet dans la base de données.
     * @param NULL $typeTable = NULL ici.
     */
    public static function getDB($id) {
        $bdd = Database::connect();
        
        $reponse = $bdd->query('SELECT * FROM Project WHERE idProject = '.$id.'');
        $donnees = $reponse->fetch();

        $project = new Project($id, $donnees['name'], $donnees['description'], $donnees['login']);
        $reponse->closeCursor();
        return $project;
    }

    /**
     * Modifie un projet dans la base de données.
     * @param Project $object Le projet à modifier.
     */
    public static function modifyDB($object) {
        $bdd = Database::connect();
        
        $rqt = $bdd->prepare('UPDATE Project SET name = :name, description = :description, login = :login WHERE idProject = :idProject');
        $rqt->execute(array(
            'name' => $object->getNameProject(),
            'description' => $object->getDescriptionProject(),
            'login' => $object->getLogin(),
            'idProject' => $object->getID()
            ));
    }

    /**
     * Supprimer un projet de la base de données.
     * @param Project $object Le projet à supprimer.
     */
    public static function removeDB($object) {
        $bdd = Database::connect();
        
        $bdd->exec('DELETE FROM ProjectDesignPattern WHERE idProject = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM Project WHERE idProject = \''.$object->getID().'\'');
    }

    /**
     * Ajoute un design pattern à un projet.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param Project $sort Le projet où l'on va ajouter un design pattern.
     */
    public static function addLink($tableToSort, $sort) {
        $bdd = Database::connect();
        
        $bdd->exec('INSERT INTO ProjectDesignPattern (idProject, idDesignPattern) VALUES ('.$sort->getID().', '.$tableToSort->getID().')');
    }
      
    /**
     * Supprime un design pattern d'un projet.
     * @param DesignPattern $tableToSort Le design pattern à supprimer.
     * @param Project $sort Le projet où l'on va supprimer un design pattern.
     */
    public static function removeLink($tableToSort, $sort) {
        $bdd = Database::connect();
        
        $bdd->exec('DELETE FROM ProjectDesignPattern WHERE idProject = '.$sort->getID().' and idDesignPattern = '.$tableToSort->getID());
    }

    public function getID(){
        return $this->idProject;
    }

    public function setID($_idProject) {
        $this->idProject = $_idProject;
    }
    
    public function getNameProject(){
        return $this->name;
    }

    public function setNameProject($_name) {
        $this->name = $_name;
    }
    
    public function getDescriptionProject(){
        return $this->description;
    }

    public function setDescriptionProject($_description) {
        $this->description = $_description;
    }
    
    public function getLogin(){
        return $this->login;
    }

    public function setLogin($_login){
        $this->login = $_login;
    }
    
}
?>
