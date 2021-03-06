<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/ETypeUser.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/ETypeUser.php");

class User implements IDatabase{
    
    private $login;
    private $pwd;
    private $lastname;
    private $firstname;
    private $mail;
    private $logo;
    private $typeUser;
    
    public function __construct($login, $pwd = "", $lastname = "", $firstname = "", $mail = "", $logo = "") {
        $this->setLogin($login);
    	$this->setPwd($pwd);
    	$this->setLastName($lastname);
    	$this->setFirstName($firstname);
    	$this->setMail($mail);
    	$this->setLogo($logo);
        $this->setTypeUser(ETypeUser::Classic);
    }
    
    /**
     * Add an user to the database
     * @param User $object The user to add
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO User(login, pwd, lastname, firstname, mail, logo, typeUser) VALUES(:login, :pwd, :lastname, :firstname, :mail, :logo, :typeUser)');
        $reussie = $req->execute(array(
            'login' => $object->getLogin(),
            'pwd' => $object->getPwd(),
            'lastname' => $object->getLastName(),
            'firstname' => $object->getFirstName(),
            'mail' => $object->getMail(),
            'logo' => $object->getLogo(),
            'typeUser' => ETypeUser::getNameEnum($object->getTypeUser())
            ));
        return $reussie;
    }

    /**
     * Get an user from the database using his login
     * @param int $id Login of the user wanted
     */
    public static function getDB($id) {
        $donnees = Database::getOneData('SELECT * FROM User WHERE login = \''.$id.'\'');
        $user = null;
        if ($donnees != false) {
           $user = new User($id, $donnees['pwd'], $donnees['lastname'], $donnees['firstname'], $donnees['mail'], $donnees['logo']);
           $user->setTypeUser(ETypeUser::getValueEnum($donnees['typeUser']));
           return $user;
        }
        return false;
    }
        

    /**
     * Modify user data in the database
     * @param User $object The user to modify
     */
    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        
        $req = $bdd->prepare('UPDATE User SET pwd = :pwd, lastname = :lastname, firstname = :firstname, mail = :mail, logo = :logo WHERE login = :login');
        $reussie = $req->execute(array(
            'login' => $object->getLogin(),
            'pwd' => $object->getPwd(),
            'lastname' => $object->getLastName(),
            'firstname' => $object->getFirstName(),
            'mail' => $object->getMail(),
            'logo' => $object->getLogo()
            ));
        return $reussie;
    }

    /**
     * Delete the given user from the database
     * @param User $object The user to delete
     */
    public static function removeDB($object) {
        $bdd = Database::getConnection();
        
        $bdd->exec('UPDATE DesignPattern SET login = "undefined" WHERE login = \''.$object->getLogin().'\'');
        $bdd->exec('UPDATE Conflict SET login = "undefined" WHERE login = \''.$object->getLogin().'\'');
        $bdd->exec('UPDATE Solution SET login = "undefined" WHERE login = \''.$object->getLogin().'\'');
        $bdd->exec('UPDATE CommentDesignPattern SET login = "undefined" WHERE login = \''.$object->getLogin().'\''); //delete user comments
        $bdd->exec('UPDATE CommentSolution SET login = "undefined" WHERE login = \''.$object->getLogin().'\''); //delete user comments
        $bdd->exec('UPDATE CommentConflict SET login = "undefined" WHERE login = \''.$object->getLogin().'\''); //delete user comments
        
        //delete
        $bdd->exec('DELETE FROM NoteDesignPattern WHERE login = \''.$object->getLogin().'\''); //delete user notes on dp
        $bdd->exec('DELETE FROM Project WHERE login = \''.$object->getLogin().'\''); //delete user projects
        $bdd->exec('DELETE FROM NoteSolution WHERE login = \''.$object->getLogin().'\''); //delete user notes on solutions
        $nbLine = $bdd->exec('DELETE FROM User WHERE login = \''.$object->getLogin().'\''); //delete User
        //var_dump($bdd->errorInfo());
        return $nbLine > 0;
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getPwd() {
        return $this->pwd;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function setLastName($lastname) {
        $this->lastname = $lastname;
    }

    public function getFirstName() {
        return $this->firstname;
    }

    public function setFirstName($firstname) {
        $this->firstname = $firstname;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setLogo($logo) {
        $this->logo = $logo;
    }
    
    public function getTypeUser() {
        return $this->typeUser;
    }
    
    public function setTypeUser($_typeUser) {
        $this->typeUser = ETypeUser::getValueEnum($_typeUser);
    }

}

?>
