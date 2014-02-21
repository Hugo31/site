<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/AbstractBasicCommentDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/userpost/comment/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");

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
        $rqt = $bdd->prepare('INSERT INTO conflict (name, description, type, date, nbComments, login) VALUES(:name, :description, :type, :date, :nbComments, :login)');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'type' => $object->getType(),
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
        $bdd = Database::getConnection();
        
        $reponse = $bdd->query('SELECT * FROM Conflict WHERE idConflict = '.$id.'');
        $donnees = $reponse->fetch();
        $donnees['id'] = $id;
        $conflict = new Conflict($id, $donnees['name'], $donnees['login'], $donnees['date'], $donnees['description'], $donnees['type']);
        $conflict->getFromDB($donnees);
        $reponse->closeCursor();
        return $conflict;
    }

    /**
     * Modifie un conflit dans la base de données.
     * @param Conflict $object Le conflit à modifier.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        
        $rqt = $bdd->prepare('UPDATE Conflict SET name = :name, description = :description, type = :type, date = :date, nbComments = :nbComments, login = :login WHERE idConflict = :idConflict');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'type' => $object->getType(),
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
     * @param Conflict $sort Le conflit où l'on va ajouter un design pattern.
     */
    public function addLink($tableToLink) {
        $bdd = Database::getConnection();
        $nbAj = $bdd->exec('INSERT INTO ConflictDesignPattern (idConflict, idDesignPattern) VALUES ('.$this->getID().', '.$tableToLink->getID().')');
        return ($nbAj > 0);
    }
      
    /**
     * Supprime un design pattern d'un conflit.
     * @param DesignPattern $tableToSort Le design pattern à supprimer.
     * @param Conflict $sort Le conflit où l'on va supprimer un design pattern.
     */
    public function removeLink($tableToLink) {
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM ConflictDesignPattern WHERE idConflict = '.$this->getID().' and idDesignPattern = '.$tableToLink->getID());
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
