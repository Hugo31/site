<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaceDB/IDataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/commentNote/INote.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/imageSource/IImage.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/imageSource/ISource.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/designPattern/ETarget.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/Database.php");

class DesignPattern implements IDataBase, IComment, INote, IImage, ISource
{

    private $idDP;
    private $nameDP;
    private $what;
    private $whenAndHow;
    private $layout;
    private $copy;
    private $implementation;
    private $target;
    private $login;

    public function __construct($_id, $_name, $_what, $_target, $_login)
    {
        $this->setID($_id);
        $this->setNameDP($_name);
        $this->setWhat($_what);
        $this->setWhenAndHow("");
        $this->setLayout("");
        $this->setCopy("");
        $this->setImplementation("");
        $this->setTarget($_target);
        $this->setLogin($_login);

    }

    public static function addDB($object){
        $bdd = Database::connect();
        
        $champ = 'name, what, whenAndHow, layout, copy, implementation, target, login';
        $value = '\''.$object->getNameDP().'\', \''.$object->getWhat().'\', \''.$object->getWhenAndHow().'\', \''.$object->getLayout().'\', ';
        $value .= '\''.$object->getCopy().'\', \''.$object->getImplementation().'\', \''.ETarget::getNameEnum($object->getTarget()).'\', \''.$object->getLogin().'\'';
        $bdd->exec('INSERT INTO DesignPattern('.$champ.') VALUES('.$value.')');
        $object->setID((int)$bdd->lastInsertId()); 
    }

    public static function modifyDB($object){
        $bdd = Database::connect();
        
        $requete = 'name = \''.$object->getNameDP().'\', what = \''.$object->getWhat().'\', whenAndHow = \''.$object->getWhenAndHow().'\', ';
        $requete .= 'layout = \''.$object->getLayout().'\', copy = \''.$object->getCopy().'\', implementation = \''.$object->getImplementation().'\', ';
        $requete .= 'target = \''.ETarget::getNameEnum($object->getTarget()).'\', login = \''.$object->getLogin().'\'';
        $bdd->exec('UPDATE DesignPattern SET '.$requete.' WHERE idDesignPattern = '.$object->getID().'');
    }

    public static function removeDB($object){
        $bdd = Database::connect();
        //Spprimer les occurences de : 
        $bdd->exec('DELETE FROM SystemDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM PlatformDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM CategoryDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM PropertyDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM ComponentDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM Source WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM ImageDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM NoteDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM ProjectDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM Conflict WHERE idDesignPattern1 = \''.$object->getID().'\' OR idDesignPattern2 = \''.$object->getID().'\'');
        $bdd->exec('DELETE FROM CommentDesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');


        $bdd->exec('DELETE FROM DesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
    }

    public static function getDB($id){
        $bdd = Database::connect();
        $reponse = $bdd->query('SELECT * FROM DesignPattern WHERE idDesignPattern = '.$id.'');
        $donnees = $reponse->fetch();

        $dp = new DesignPattern($donnees['idDesignPattern'], $donnees['name'], $donnees['what'], ETarget::getValueEnum($donnees['target']), $donnees['login']);
        $dp->setWhenAndHow($donnees['whenAndHow']);
        $dp->setLayout($donnees['layout']);
        $dp->setCopy($donnees['copy']);
        $dp->setImplementation($donnees['implementation']);
        $reponse->closeCursor();
        return $dp;
    }
    
    public static function addComment($object, $user, $comment) {
        $bdd = Database::connect();
        $champ = 'login, idDesignPattern, date, comment';
        $value = '\''.$user->getLogin().'\', '.$object->getID().', NOW(), \''.$comment.'\'';
        $bdd->exec('INSERT INTO CommentDesignPattern('.$champ.') VALUES('.$value.')');
    }

    public static function removeComment($idComment) {
        $bdd = Database::connect();
        $bdd->exec('DELETE FROM CommentDesignPattern WHERE idComment = \''.$idComment.'\'');
    }
    
    public static function addNote($object, $user, $note) {
        $bdd = Database::connect();
        $champ = 'login, idDesignPattern, note';
        $value = '\''.$user->getLogin().'\', '.$object->getID().', \''.$note.'';
        $bdd->exec('INSERT INTO NoteDesignPattern('.$champ.') VALUES('.$value.')');
    }

    public static function removeNote($object, $user) {
        $bdd = Database::connect();
        $cond = 'login = \''.$user->getLogin().'\' AND idDesignPattern = '.$object->getID().'';
        $bdd->exec('DELETE FROM NoteDesignPattern WHERE '.$cond.')');
    }
    
    
    public static function addImage($object, $link) {
        $bdd = Database::connect();
        $champ = 'idDesignPattern, link';
        $value = ''.$object->getID().', \''.$link.'\'';
        $bdd->exec('INSERT INTO ImageDesignPattern('.$champ.') VALUES('.$value.')');
    }

    public static function addSource($object, $author, $link) {
        $bdd = Database::connect();
        $champ = 'idDesignPattern, author, link';
        $value = ''.$object->getID().', \''.$author.'\', \''.$link.'\'';
        $bdd->exec('INSERT INTO Source('.$champ.') VALUES('.$value.')');
    }

    public static function removeImage($img) {
        $bdd = Database::connect();
        $cond = 'idImage = '.$img.'';
        $bdd->exec('DELETE FROM ImageDesignPattern WHERE '.$cond.')');
    }

    public static function removeSource($src) {
        $bdd = Database::connect();
        $cond = 'idSource = '.$src.'';
        $bdd->exec('DELETE FROM Source WHERE '.$cond.')');
    }

    public function getID(){
        return $this->idDP;
    }

    public function setID($_id) {
        $this->idDP = $_id;
    }

    public function getNameDP(){
        return $this->nameDP;
    }

    public function setNameDP($_name) {
        $this->nameDP = $_name;
    }

    public function getWhat(){
        return $this->what;
    }

    public function setWhat($_what) {
        $this->what = $_what;
    }

    public function getWhenAndHow(){
        return $this->whenAndHow;
    }

    public function setWhenAndHow($_whenAndHow) {
        $this->whenAndHow = $_whenAndHow;
    }

    public function getLayout(){
        return $this->layout;
    }

    public function setLayout($_layout) {
        $this->layout = $_layout;
    }

    public function getcopy(){
        return $this->copy;
    }

    public function setCopy($_copy){
        $this->copy = $_copy;
    }

    public function getImplementation(){
        return $this->implementation;
    }

    public function setImplementation($_implementation){
        $this->implementation = $_implementation;
    }

    public function getTarget(){
        return $this->target;
    }

    public function setTarget($_target) {
        $this->target = $_target;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($_login){
        $this->login = $_login;
    }

}
?>