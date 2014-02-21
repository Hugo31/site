<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/AbstractBasicPostedDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/ILink.php");

class Project extends AbstractBasicPostedDB implements IDatabase, ILink{
    
    private $description;
    
    public function __construct($_id, $_name, $_login, $_date, $_desc) {
        parent::__construct($_id, $_name, $_login, $_date);
        $this->setDescription($_desc);
    }
    
    /**
     * Ajoute un projet à la base de données.
     * @param Project $object Le projet à ajouter.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO project (name, description, date, login) VALUES(:name, :description, :date, :login)');
        $rqt->execute(array(
            'name' => $object->getNameProject(),
            'description' => $object->getDescription(),
            'date' => $object->getDate(),
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
        $bdd = Database::getConnection();
        
        $reponse = $bdd->query('SELECT * FROM Project WHERE idProject = '.$id.'');
        $donnees = $reponse->fetch();
        $project = new Project($id, $donnees['name'], $donnees['login'], $donnees['date'], $donnees['description']);
        $project->getFromDB($donnees);
        $reponse->closeCursor();
        return $project;
    }

    /**
     * Modifie un projet dans la base de données.
     * @param Project $object Le projet à modifier.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        
        $rqt = $bdd->prepare('UPDATE Project SET name = :name, description = :description, date = :date, login = :login WHERE idProject = :idProject');
        $rqt->execute(array(
            'name' => $object->getNameProject(),
            'description' => $object->getDescription(),
            'date' => $object->getDate(),
            'login' => $object->getLogin(),
            'idProject' => $object->getID()
        ));
    }

    /**
     * Supprimer un projet de la base de données.
     * @param Project $object Le projet à supprimer.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        
        $bdd->exec('DELETE FROM ProjectDesignPattern WHERE idProject = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM Project WHERE idProject = \''.$object->getID().'\'');
    }

    /**
     * Ajoute un design pattern à un projet.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param Project $sort Le projet où l'on va ajouter un design pattern.
     */
    public static function addLink($tableToSort, $sort) {
        $bdd = Database::getConnection();
        
        $bdd->exec('INSERT INTO ProjectDesignPattern (idProject, idDesignPattern) VALUES ('.$sort->getID().', '.$tableToSort->getID().')');
    }
      
    /**
     * Supprime un design pattern d'un projet.
     * @param DesignPattern $tableToSort Le design pattern à supprimer.
     * @param Project $sort Le projet où l'on va supprimer un design pattern.
     */
    public static function removeLink($tableToSort, $sort) {
        $bdd = Database::getConnection();
        
        $bdd->exec('DELETE FROM ProjectDesignPattern WHERE idProject = '.$sort->getID().' and idDesignPattern = '.$tableToSort->getID());
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($_description) {
        $this->description = $_description;
    }
    
}
