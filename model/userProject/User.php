<?php
require_once($_SERVER['DOCUMENT_ROOT']."/model/interfaceDB/IDataBase.php");
class User implements IDataBase{
    
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
     * Ajoute à la base de donnée un utilisateur.
     * @param User $object L'utilisateur à rajouter. 
     */
    public static function addDB($object) {
        $bdd = Database::connect();
        $req = $bdd->prepare('INSERT INTO User(login, pwd, lastname, firstname, mail, logo) VALUES(:login, :pwd, :lastname, :firstname, :mail, :logo)');
        $req->execute(array(
                'login' => $this->getLogin(),
                'pwd' => $this->getPwd(),
                'lastname' => $this->getLastName(),
                'firstname' => $this->getFirstName(),
                'mail' => $this->getMail(),
                'logo' => $this->getLogo()
                ));
    }

    /**
     * Donne un utilisateur issus de la base de donnée.
     * @param int $id L'identifiant de l'utilisateur à obtenir.
     * @param NULL $typeTable = NULL ici.
     */
    public static function getDB($id) {
        
    }

    /**
     * Modifie un utilisateur dans la base de donnée
     * @param User $object L'utilisateur à modifier
     */
    public static function modifyDB($object) {
        
    }

    /**
     * Supprime de la base de donnée l'utilisateur passé en paramètre.
     * @param User $object L'utilisateur à supprimer de la base de donnée.
     */
    public static function removeDB($object) {
        
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
