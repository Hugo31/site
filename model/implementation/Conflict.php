<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicCommentDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");

class Conflict extends AbstractBasicCommentDB implements IDatabase, IComment{
    
    private $description;
    private $typeConflict;
    
    public function __construct($_id, $_name, $_login, $_date, $_description, $_typeConflict) {
        parent::__construct($_id, $_name, $_login, $_date);
        $this->setDescription($_description);
        $this->setType($_typeConflict);
    }
    
    /**
     * Ajoute un conflict à la base de données.
     * @param Conflict $object Le conflit à ajouter.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO conflict (name, description, date, nbComments, login, idTypeConflict) VALUES(:name, :description, :date, :nbComments, :login, :idTypeConflict)');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'idTypeConflict' => $object->getType(),
            'date' => $object->getDate(),
            'nbComments' => $object->getNbComments(),
            'login' => $object->getLogin()
        ));
        if($reussie){
            $object->setID((int)$bdd->lastInsertId()); 
        }
        return $reussie;
    }

    /**
     * Donne un conflit issu de la base de données.
     * @param int $id L'identifiant du conflit dans la base de données.
     */
    public static function getDB($id) {
        $donnees = Database::getOneData('SELECT * FROM Conflict WHERE idConflict = '.$id.'');
        if($donnees != false){
            $donnees['id'] = $id;
            $conflict = new Conflict($id, $donnees['name'], $donnees['login'], $donnees['date'], $donnees['description'], $donnees['idTypeConflict']);
            $conflict->getFromDB($donnees);
            return $conflict;
        }
        return false;
        
        
    }

    /**
     * Modifie un conflit dans la base de données.
     * @param Conflict $object Le conflit à modifier.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        
        $rqt = $bdd->prepare('UPDATE Conflict SET name = :name, description = :description, idTypeConflict = :type, date = :date, nbComments = :nbComments, login = :login WHERE idConflict = :idConflict');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'idTypeConflict' => $object->getType(),
            'date' => $object->getDate(),
            'nbComments' => $object->getNbComments(),
            'login' => $object->getLogin(),
            'idConflict' => $object->getID()
        ));
        return $reussie;
    }

    /**
     * Supprimer un conflit de la base de données.
     * @param Conflict $object Le projet à supprimer.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        
        $bdd->exec('DELETE FROM CommentConflict WHERE idConflict = \''.$object->getID().'\''); // comment du conflit
        $bdd->exec('DELETE FROM ConflictDesignPattern WHERE idConflict = \''.$object->getID().'\''); //conflit entre les design pattern
        $nbSuppr = $bdd->exec('DELETE FROM Conflict WHERE idConflict = \''.$object->getID().'\''); // le conflit lui mm
        return ($nbSuppr > 0);
    }

    /**
     * Ajoute un commentaire à un conflict.
     * @param User $user L'utilisateur ayant posté.
     * @param String $comment Le commentaire à ajouter.
     */
    public function addComment($user, $comment) {
        return parent::abstractAddComment($user, $comment, "Conflict");
    }

    /**
     * Supprime un commentaire d'un conflict.
     * @param CommentDesignPattern $object Le commentaire àsupprimer du conflit.
     */
    public function removeComment($idComment) {
        return parent::abstractRemoveComment($idComment, "Conflict");
    }
    
    /**
     * Ajoute un design pattern à un conflit.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     */
    public function addLink($id) {
        $bdd = Database::getConnection();
        $nbAj = $bdd->exec('INSERT INTO ConflictDesignPattern (idConflict, idDesignPattern) VALUES ('.$this->getID().', '.$id.')');
        return ($nbAj > 0);
    }
      
    /**
     * Supprime un design pattern d'un conflit.
     * @param DesignPattern $tableToSort Le design pattern à supprimer.
     */
    public function removeLink($id) {
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM ConflictDesignPattern WHERE idConflict = '.$this->getID().' and idDesignPattern = '.$id);
        return ($nbSuppr > 0);
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($_description) {
        $this->description = $_description;
    }
    
    public function getType(){
        return $this->typeConflict;
    }

    public function setType($_typeConflict) {
        $this->typeConflict = $_typeConflict;
    }
}
