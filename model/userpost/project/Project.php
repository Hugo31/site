<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/AbstractBasicPostedDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/ILink.php");

class Project extends AbstractBasicPostedDB implements IDatabase/*, ILink*/{
    
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
        $rqt = $bdd->prepare('INSERT INTO Project (name, description, date, login) VALUES(:name, :description, :date, :login)');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'date' => $object->getDate(),
            'login' => $object->getLogin()
            ));
        if($reussie == true){
            $object->setID((int)$bdd->lastInsertId()); 
        }
        return $reussie;
        
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
        $reponse->closeCursor();
        if($donnees != false){
            $donnees['id'] = $id;
            $project = new Project($id, $donnees['name'], $donnees['login'], $donnees['date'], $donnees['description']);
            $project->getFromDB($donnees);
            return $project;
        }
        return false;

    }

    /**
     * Modifie un projet dans la base de données.
     * @param Project $object Le projet à modifier.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        
        $rqt = $bdd->prepare('UPDATE Project SET name = :name, description = :description, date = :date, login = :login WHERE idProject = :idProject');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'date' => $object->getDate(),
            'login' => $object->getLogin(),
            'idProject' => $object->getID()
        ));
        return $reussie;
    }

    /**
     * Supprimer un projet de la base de données.
     * @param Project $object Le projet à supprimer.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        
        $bdd->exec('DELETE FROM ProjectDesignPattern WHERE idProject = \''.$object->getID().'\'');
        $nbSuppr = $bdd->exec('DELETE FROM Project WHERE idProject = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }

    /**
     * Ajoute un design pattern à un projet.
     * @param DesignPattern $tableToLink Le design pattern à lier.
     */
    public function addLink($tableToLink) {
        $bdd = Database::getConnection();
        $nbAj = $bdd->exec('INSERT INTO ProjectDesignPattern (idProject, idDesignPattern) VALUES ('.$this->getID().', '.$tableToLink->getID().')');
        return ($nbAj > 0);
    }
      
    /**
     * Supprime un design pattern d'un projet.
     * @param DesignPattern $tableToLink Le design pattern à supprimer.
     */
    public function removeLink($tableToLink) {
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM ProjectDesignPattern WHERE idProject = '.$this->getID().' and idDesignPattern = '.$tableToLink->getID());
        return ($nbSuppr > 0);
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($_description) {
        $this->description = $_description;
    }
    
}
