<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");

class User implements IDatabase{
    
    private $login;
    private $pwd;
    private $lastname;
    private $firstname;
    private $mail;
    private $logo;
    
    public function __construct($login, $pwd, $lastname, $firstname, $mail, $logo){
        $this->setLogin($login);
    	$this->setPwd($pwd);
    	$this->setLastName($lastname);
    	$this->setFirstName($firstname);
    	$this->setMail($mail);
    	$this->setLogo($logo);
    }
    
    /**
     * Add an user to the database
     * @param User $object The user to add
     */
    public static function addDB($object) {
        $bdd = Database::getConnection();
        $req = $bdd->prepare('INSERT INTO User(login, pwd, lastname, firstname, mail, logo) VALUES(:login, :pwd, :lastname, :firstname, :mail, :logo)');
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
     * Get an user from the database using his login
     * @param int $id Login of the user wanted
     */
    public static function getDB($id) {
        $donnees = Database::getOneData('SELECT * FROM User WHERE login = \''.$id.'\'');
        if($donnees != false){
           return new User($id, $donnees['pwd'], $donnees['lastname'], $donnees['firstname'], $donnees['mail'], $donnees['logo']);
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
        //delete
        $bdd->exec('DELETE FROM NoteDesignPattern WHERE login = \''.$object->getLogin().'\''); //delete user notes on dp
        $bdd->exec('DELETE FROM CommentDesignPattern WHERE login = \''.$object->getLogin().'\''); //delete user comments
        $bdd->exec('DELETE FROM Project WHERE login = \''.$object->getLogin().'\''); //delete user projects
        $bdd->exec('DELETE FROM CommentConflit WHERE login = \''.$object->getLogin().'\''); //delete user comments on conflicts
        $bdd->exec('DELETE FROM CommentSolution WHERE login = \''.$object->getLogin().'\''); //delete user comments on solutions
        $bdd->exec('DELETE FROM NoteSolution WHERE login = \''.$object->getLogin().'\''); //delete user notes on solutions
        $nbLine = $bdd->exec('DELETE FROM User WHERE login = \''.$object->getLogin().'\''); //delete User
        
        return $nbLine > 0;
    }
    
    public function getLogin(){
        return $this->login;
    }

    public function setLogin($login){
        $this->login = $login;
    }

    public function getPwd(){
        return $this->pwd;
    }

    public function setPwd($pwd){
        $this->pwd = $pwd;
    }

    public function getLastName(){
        return $this->lastname;
    }

    public function setLastName($lastname){
        $this->lastname = $lastname;
    }

    public function getFirstName(){
        return $this->firstname;
    }

    public function setFirstName($firstname){
        $this->firstname = $firstname;
    }

    public function getMail(){
        return $this->mail;
    }

    public function setMail($mail){
        $this->mail = $mail;
    }

    public function getLogo(){
        return $this->logo;
    }

    public function setLogo($logo){
        $this->logo = $logo;
    }

}

?>
