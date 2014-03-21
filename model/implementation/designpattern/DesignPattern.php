<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IComment.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IRate.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/designpattern/ETarget.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicRateDB.php");
    
class DesignPattern extends AbstractBasicRateDB implements IDataBase, IComment, IRate
{
    
    private $what;
    private $whenAndHow;
    private $layout;
    private $copy;
    private $implementation;
    private $descriptionImage;
    private $nbUsage;
    private $target;
    
    public function __construct($_id, $_name, $_login, $_date, $_what, $_nbUsage, $_target) {
        parent::__construct($_id, $_name, $_login, $_date);
        $this->setWhat($_what);
        $this->setWhenAndHow("");
        $this->setLayout("");
        $this->setCopy("");
        $this->setImplementation("");
        $this->setDescriptionImage("");
        $this->setNbUsage($_nbUsage);
        $this->setTarget($_target);
    }
    
    /**
     * Ajoute à la base de donnée un design pattern passé en paramètre.
     * @param DesignPattern $object Le design pattern à sauvegarder.
     * @return bool True si l'ajout à réussi, False sinon.
     */
    public static function addDB($object){
        $bdd = Database::getConnection();
        $rqt = $bdd->prepare('INSERT INTO DesignPattern (name, what, whenAndHow, layout, copy, implementation, nbUsage, nbComments, nbRates, rate, date, target, login) '
                            .'VALUES(:name, :what, :whenAndHow, :layout, :copy, :implementation, :nbUsage, :nbComments, :nbRates, :rate, :date, :target, :login)');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'what' => $object->getWhat(),
            'whenAndHow' => $object->getWhenAndHow(),
            'layout' => $object->getLayout(),
            'copy' => $object->getCopy(),
            'implementation' => $object->getImplementation(),
            'descriptionImage' => $object->getDescriptionImage(),
            'nbUsage' => $object->getNbUsage(),
            'nbComments' => $object->getNbComments(), 
            'nbRates' => $object->getNbRates(), 
            'rate' => $object->getRate(), 
            'date' => $object->getDate(),
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
                            .'copy = :copy, implementation = :implementation, nbUsage = :nbUsage, '
                            .'nbComments = :nbComments, nbRates = :nbRates, rate = :rate, '
                            .'date = :date,target = :target, login = :login '
                            .'WHERE idDesignPattern = :idDesignPattern');
        $reussie = $req->execute(array(
            'name' => $object->getName(),
            'what' => $object->getWhat(),
            'whenAndHow' => $object->getWhenAndHow(),
            'layout' => $object->getLayout(),
            'copy' => $object->getCopy(),
            'implementation' => $object->getImplementation(),
            'descriptionImage' => $object->getDescriptionImage(),
            'nbUsage' => $object->getNbUsage(),
            'nbComments' => $object->getNbComments(), 
            'nbRates' => $object->getNbRates(), 
            'rate' => $object->getRate(), 
            'date' => $object->getDate(),
            'target' => ETarget::getNameEnum($object->getTarget()),
            'login' => $object->getLogin(),
            'idDesignPattern' => $object->getID()
            ));
        return $reussie;
    }

    /**
     * Supprime de la base de donnée un design pattern.
     * @param DesignPattern $object Le design pattern à supprimer.
     * @return bool True si la suppression a réussi, False sinon.
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


        $nbSuppr = $bdd->exec('DELETE FROM DesignPattern WHERE idDesignPattern = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }

    /**
     * Donne un design pattern selon son identifiant dans la base de donnée.
     * @param int $id L'identifiant du design pattern.
     * @return DesignPattern Le design pattern issus de la base de donnée.
     */
    public static function getDB($id){
        $donnees = Database::getOneData('SELECT * FROM DesignPattern WHERE idDesignPattern = '.$id.'');
        if($donnees != false){
            $donnees['id'] = $id;
            $dp = new DesignPattern($donnees['idDesignPattern'], $donnees['name'], $donnees['login'], 
                                    $donnees['date'], $donnees['what'], $donnees['nbUsage'], 
                                    ETarget::getValueEnum($donnees['target'])
            );
            $dp->setWhenAndHow($donnees['whenAndHow']);
            $dp->setLayout($donnees['layout']);
            $dp->setCopy($donnees['copy']);
            $dp->setImplementation($donnees['implementation']);
            $dp->setDescriptionImage($donnees['descriptionImage']);
            $dp->getFromDB($donnees);
            return $dp;
        }
        return false;
    }
    
    /**
     * Ajoute un commentaire à un design pattern.
     * @param User $user L'utilisateur qui commente.
     * @param string $comment Le commentaire fournit par l'utilisateur.
     * @return bool True si l'ajout a réussi, False sinon.
     */
    public function addComment($user, $comment) {
        return parent::abstractAddComment($user, $comment, "DesignPattern");
    }

    /**
     * Supprime un commentaire pour un design pattern.
     * @param int $idComment L'identifiant du commentaire.
     */
    public function removeComment($idComment) {
        return parent::abstractRemoveComment($idComment, "DesignPattern");
    }
    
    /**
     * Ajoute une note à un design pattern.
     * @param User $user L'utilisateur qui commente.
     * @param int $note La note de l'utilisateur.
     * @return bool True si l'ajout a réussi, False sinon.
     */
    public function addRate($user, $note) {
        return parent::abstractAddRate($user, $note, "DesignPattern");
    }

    /**
     * Supprime une note de la base de donnée.
     * @param DesignPattern $object Le design pattern concerné.
     * @param User $user L'utilisateur concerné.
     */
    public function removeRate($user) {
        return parent::abstractRemoveRate($user, "DesignPattern");
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

    public function getCopy(){
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
    
    public function getDescriptionImage(){
        return $this->descriptionImage;
    }

    public function setDescriptionImage($_descriptionImage){
        $this->descriptionImage = $_descriptionImage;
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


}
