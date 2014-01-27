<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/ILink.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");

class Conflict implements IDataBase, IComment, ILink {
    
    private $idConflict;
    private $name;
    private $description;
    private $typeConflict;
    private $login;
    
    public function __construct($_idConflict, $_name, $_description, $_typeConflict, $_login){
        $this->setID($_idConflict);
        $this->setNameConflict($_name);
        $this->setDescriptionConflict($_description);
        $this->setTypeConflict($_typeConflict);
        $this->setLogin($_login);
    }
    
    /**
     * Ajoute un conflict à la base de données.
     * @param Conflict $object Le conflit à ajouter.
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO conflict (name, description, type, login) VALUES(:name, :description, :type, :login)');
        $rqt->execute(array(
            'name' => $object->getNameConflict(),
            'description' => $object->getDescriptionConflict(),
            'type' => $object->getTypeConflict(),
            'login' => $object->getLogin()
            ));
        $object->setID((int)$bdd->lastInsertId()); 
    }

    /**
     * Donne un conflit issu de la base de données.
     * @param int $id L'identifiant du conflit dans la base de données.
     */
    public static function getDB($id) {
        $bdd = Database::getConnection();
        
        $reponse = $bdd->query('SELECT * FROM Conflict WHERE idConflict = '.$id.'');
        $donnees = $reponse->fetch();

        $conflict = new Conflict($id, $donnees['name'], $donnees['description'], $donnees['type'], $donnees['login']);
        $reponse->closeCursor();
        return $conflict;
    }

    /**
     * Modifie un conflit dans la base de données.
     * @param Conflict $object Le conflit à modifier.
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        
        $rqt = $bdd->prepare('UPDATE Conflict SET name = :name, description = :description, type = :type, login = :login WHERE idConflict = :idConflict');
        $rqt->execute(array(
            'name' => $object->getNameConflict(),
            'description' => $object->getDescriptionConflict(),
            'type' => $object->getTypeConflict(),
            'login' => $object->getLogin(),
            'idConflict' => $object->getID()
            ));
    }

    /**
     * Supprimer un conflit de la base de données.
     * @param Conflict $object Le projet à supprimer.
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        
        $bdd->exec('DELETE FROM CommentConflict WHERE idConflict = \''.$object->getID().'\''); // comment du conflit
        $bdd->exec('DELETE FROM ConflictDesignPattern WHERE idConflict = \''.$object->getID().'\''); //conflit entre les design pattern
        $bdd->exec('DELETE FROM Conflict WHERE idConflict = \''.$object->getID().'\''); // le conflit lui mm
    }

    /**
     * Ajoute un commentaire à un conflict.
     * @param Conflict $object Le conflit auquel serapporte le commentaire.
     * @param User $user L'utilisateur ayant posté.
     * @param String $comment Le commentaire à ajouter.
     */
    public static function addComment($object, $user, $comment) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO CommentConflict (login, idConflict, date, comment) VALUES(:login, :idConflict, :date, :comment)');
        $rqt->execute(array(
            'login' => $user->getLogin(),
            'idConflict' => $object->getID(),
            'date' => 'NOW()',
            'comment' => $comment
            ));
        $object->setID((int)$bdd->lastInsertId());
    }

    /**
     * Supprime un commentaire d'un conflict.
     * @param CommentDesignPattern $object Le commentaire àsupprimer du conflit.
     */
    public static function removeComment($idComment) {
        $bdd = Database::getConnection();
        
        $bdd->exec('DELETE FROM CommentDesignPattern WHERE idComment = \''.$idComment.'\'');
    }
    
    /**
     * Ajoute un design pattern à un conflit.
     * @param DesignPattern $tableToSort Le design pattern à lier.
     * @param Conflict $sort Le conflit où l'on va ajouter un design pattern.
     */
    public static function addLink($tableToSort, $sort) {
        $bdd = Database::getConnection();
        
        $bdd->exec('INSERT INTO ConflictDesignPattern (idConflict, idDesignPattern) VALUES ('.$sort->getID().', '.$tableToSort->getID().')');
    }
      
    /**
     * Supprime un design pattern d'un conflit.
     * @param DesignPattern $tableToSort Le design pattern à supprimer.
     * @param Conflict $sort Le conflit où l'on va supprimer un design pattern.
     */
    public static function removeLink($tableToSort, $sort) {
        $bdd = Database::getConnection();
        
        $bdd->exec('DELETE FROM ConflictDesignPattern WHERE idConflict = '.$sort->getID().' and idDesignPattern = '.$tableToSort->getID());
    }

    public function getID(){
        return $this->idConflict;
    }

    public function setID($_idConflict) {
        $this->idConflict = $_idConflict;
    }
    
    public function getNameConflict(){
        return $this->name;
    }

    public function setNameConflict($_name) {
        $this->name = $_name;
    }
    
    public function getDescriptionConflict(){
        return $this->description;
    }

    public function setDescriptionConflict($_description) {
        $this->description = $_description;
    }
    
    public function getTypeConflict(){
        return $this->typeConflict;
    }

    public function setTypeConflict($_typeConflict) {
        $this->typeConflict = $_typeConflict;
    }
    
    public function getLogin(){
        return $this->login;
    }

    public function setLogin($_login){
        $this->login = $_login;
    }
}

?>
