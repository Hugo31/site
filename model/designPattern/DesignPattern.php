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
    private $nbUsage;
    private $target;
    private $login;

    /**
     * Construit un design pattern.
     * @param int $_id L'identifiant du design pattern.
     * @param string $_name Le nom.
     * @param string $_what L'attribut what.
     * @param ETarget $_target La cible, c'est à dire "Designer" ou "Evaluator".
     * @param string $_login Le login du posteur.
     */
    public function __construct($_id, $_name, $_what, $_nbUsage, $_target, $_login)
    {
        $this->setID($_id);
        $this->setNameDP($_name);
        $this->setWhat($_what);
        $this->setWhenAndHow("");
        $this->setLayout("");
        $this->setCopy("");
        $this->setImplementation("");
        $this->setNbUsage($_nbUsage);
        $this->setTarget($_target);
        $this->setLogin($_login);

    }

    /**
     * Ajoute à la base de donnée un design pattern passé en paramètre.
     * @param DesignPattern $object Le design pattern à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object){
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO DesignPattern (name, what, whenAndHow, layout, copy, implementation, nbUsage, target, login) '
                            .'VALUES(:name, :what, :whenAndHow, :layout, :copy, :implementation, :nbUsage, :target, :login)');
        $reussie = $rqt->execute(array(
            'name' => $object->getNameDP(),
            'what' => $object->getWhat(),
            'whenAndHow' => $object->getWhenAndHow(),
            'layout' => $object->getLayout(),
            'copy' => $object->getCopy(),
            'implementation' => $object->getImplementation(),
            'nbUsage' => $object->getNbUsage(),
            'target' => ETarget::getNameEnum($object->getTarget()),
            'login' => $object->getLogin()
            ));
        if($reussie == true){
            $object->setID((int)$bdd->lastInsertId()); 
        }
        
        return $reussie;
    }

    /**
     * Modifie un design pattern de la base de donnée.
     * @param DesignPattern $object Le nouveau design pattern à modifier avec un identifiant valide.
     * @return bool True si la modification a réussi, False sinon.
     */
    public static function modifyDB($object){
        $bdd = Database::getConnection();
        $req = $bdd->prepare('UPDATE DesignPattern SET '
                            .'name = :name, what = :what, whenAndHow = :whenAndHow, layout = :layout, '
                            .'copy = :copy, implementation = :implementation, nbUsage = :nbUsage, target = :target, login = :login '
                            .'WHERE idDesignPattern = :idDesignPattern');
        $reussie = $req->execute(array(
            'name' => $object->getNameDP(),
            'what' => $object->getWhat(),
            'whenAndHow' => $object->getWhenAndHow(),
            'layout' => $object->getLayout(),
            'copy' => $object->getCopy(),
            'implementation' => $object->getImplementation(),
            'nbUsage' => $object->getNbUsage(),
            'target' => ETarget::getNameEnum($object->getTarget()),
            'login' => $object->getLogin(),
            'idDesignPattern' => $object->getID()
            ));
        return $reussie;
    }

    /**
     * Supprime de la base de donnée un design pattern.
     * @param DesignPattern $object Le design pattern à supprimer.
     */
    public static function removeDB($object){
        $bdd = Database::getConnection();
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


        $nbReussie = $bdd->exec('DELETE FROM DesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        return $nbReussie > 0;
    }

    /**
     * Donne un design pattern selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant du design pattern.
     * @return \DesignPattern Le design pattern issus de la base de donnée.
     */
    public static function getDB($id){
        $bdd = Database::getConnection();
        $reponse = $bdd->query('SELECT * FROM DesignPattern WHERE idDesignPattern = '.$id.'');
        $donnees = $reponse->fetch();

        $dp = new DesignPattern($donnees['idDesignPattern'], $donnees['name'], $donnees['what'], $donnees['nbUsage'], ETarget::getValueEnum($donnees['target']), $donnees['login']);
        $dp->setWhenAndHow($donnees['whenAndHow']);
        $dp->setLayout($donnees['layout']);
        $dp->setCopy($donnees['copy']);
        $dp->setImplementation($donnees['implementation']);
        $reponse->closeCursor();
        return $dp;
    }
    
    /**
     * Ajoute un commentaire à un design pattern.
     * @param DesignPattern $object Le design pattern à commenter.
     * @param User $user L'utilisateur qui commente.
     * @param string $comment Le commentaire fournit par l'utilisateur.
     * @return bool True si l'ajout a réussi, False sinon.
     */
    public static function addComment($object, $user, $comment) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO CommentDesignPattern (login, idDesignPattern, date, comment) '
                            .'VALUES(:login, :idDesignPattern, NOW(), :comment)');
        $reussie = $rqt->execute(array(
            'login' => $user->getLogin(),
            'idDesignPattern' => $object->getID(),
            'comment' => $comment
            ));
        return $reussie;
    }

    /**
     * Supprime un commentaire pour un design pattern.
     * @param int $idComment L'identifiant du commentaire.
     */
    public static function removeComment($idComment) {
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM CommentDesignPattern WHERE idComment = \''.$idComment.'\'');
        return $nbLine > 0;
    }
    
    /**
     * Ajoute une note à un design pattern.
     * @param DesignPattern $object Le design pattern à commenter.
     * @param User $user L'utilisateur qui commente.
     * @param int $note La note de l'utilisateur.
     * @return bool True si l'ajout a réussi, False sinon.
     */
    public static function addNote($object, $user, $note) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO NoteDesignPattern (login, idDesignPattern, note) '
                            .'VALUES(:login, :idDesignPattern, :note)');
        $reussie = $rqt->execute(array(
            'login' => $user->getLogin(),
            'idDesignPattern' => $object->getID(),
            'note' => $note
            ));
        return $reussie;
    }

    /**
     * Supprime une note de la base de donnée.
     * @param DesignPattern $object Le design pattern concerné.
     * @param User $user L'utilisateur concerné.
     */
    public static function removeNote($object, $user) {
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM NoteDesignPattern WHERE '
                    .'login = \''.$user->getLogin().'\' AND idDesignPattern = '.$object->getID().'');
        return $nbLine > 0;
    }
    
    /**
     * Ajoute une image au design pattern.
     * @param DesignPattern $object Le design pattern concerné.
     * @param string $link Le lien de l'image.
     * @return bool True si l'ajout a réussi, False sinon.
     */
    public static function addImage($object, $link) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO ImageDesignPattern (idDesignPattern, link) '
                            .'VALUES(:idDesignPattern, :link)');
        $reussie = $rqt->execute(array(
            'idDesignPattern' => $object->getID(),
            'link' => $link
            ));
        return $reussie;
    }

    /**
     * Ajoute une source au design pattern.
     * @param DesignPattern $object Le design pattern concerné.
     * @param string $author L'auteur de l'image.
     * @param string $link Le lien de l'image.
     * @return bool True si l'ajout a réussi, False sinon.
     */
    public static function addSource($object, $author, $link) {
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO Source (idDesignPattern, author, link) '
                            .'VALUES(:idDesignPattern, :author, :link)');
        $reussie = $rqt->execute(array(
            'idDesignPattern' => $object->getID(),
            'author' => $author,
            'link' => $link
            ));
        return $reussie;
    }

    /**
     * Supprime une image.
     * @param int $img L'identifiant de l'image.
     */
    public static function removeImage($img) {
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM ImageDesignPattern WHERE idImage = '.$img.'');
        return $nbLine > 0;
    }

    /**
     * Supprime une source.
     * @param int $src L'identifant de la source.
     */
    public static function removeSource($src) {
        $bdd = Database::getConnection();
        $nbLine = $bdd->exec('DELETE FROM Source WHERE idSource = '.$src.'');
        return $nbLine > 0;
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
    
    public function getNbUsage(){
        return $this->nbUsage;
    }

    public function setNbUsage($_nbUsage){
        $this->nbUsage = $_nbUsage;
    }

    public function getTarget(){
        return $this->target;
    }

    public function setTarget($_target) {
        $this->target = ETarget::getValueEnum($_target);
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($_login){
        $this->login = $_login;
    }

}
?>