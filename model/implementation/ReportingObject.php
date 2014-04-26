<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/abstract/AbstractBasicPostedDB.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/implementation/Database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/IDatabase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/reporting/EReportingObject.php");

class ReportingObject extends AbstractBasicPostedDB implements IDatabase{
    private $message;
    private $typeReported;
    private $idReported;
    
    
    public function __construct($_id, $_message = "", $_typeReport = "", $_idReport = null, $_date = null, $_login = "") {
        parent::__construct($_id, "Reporting_".$_id, $_login, $_date);
        $this->setMessage($_message);
        $this->setTypeReported($_typeReport);
        $this->setIDReported($_idReport);
        
    }
    
    public static function addDB($object) {
        
        $bdd = Database::getConnection();
        
        $rqt = $bdd->prepare('INSERT INTO ReportingObject (name, message, date, typeReported, idReported, login) VALUES(:name, :message, :date, :typeReported, :idReported, :login)');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'message' => $object->getMessage(),
            'typeReported' => EReportingObject::getNameEnum($object->getTypeReported()),
            'idReported' => $object->getIDReported(),   
            'login' => $object->getLogin()
        ));
        
        if ($reussie) {
            $object->setID((int)$bdd->lastInsertId()); 
        }
        
        return $reussie;
    }

    public static function getDB($id) {
        $donnees = Database::getOneData('SELECT * FROM Reporting WHERE idReporting = '.$id.'');
        if ($donnees != false) {
            $donnees['id'] = $id;
            $report = new ReportingObject($id, $donnees['message'], EReportingObject::getValueEnum($donnees['typeReported']), $donnees['idReported'], $donnees['date'], $donnees['login']);
            $report->getFromDB($donnees);
            return $report;
        }
        return false;
    }

    public static function modifyDB($object) {
        $bdd = Database::getConnection();
        
        $rqt = $bdd->prepare('UPDATE Reporting SET name = :name, message = :message, typeReported = :typeReported, idReported = :idReported, date = :date, login = :login WHERE idReporting = :idReporting');
        $reussie = $rqt->execute(array(
            'name' => $object->getName(),
            'message' => $object->getMessage(),
            'typeReported' => EReportingObject::getNameEnum($object->getTypeReported()),
            'idReported' => $object->getIDReported(), 
            'date' => $object->getDate(),
            'login' => $object->getLogin(),
            'idReporting' => $object->getID()
        ));
        
        return $reussie;
    }

    public static function removeDB($object) {
        $bdd = Database::getConnection();
        $nbSuppr = $bdd->exec('DELETE FROM Reporting WHERE idReporting = \''.$object->getID().'\'');
        return ($nbSuppr > 0);
    }
    
    public function getMessage() {
        return $this->message;
    }
    
    public function setMessage($_message) {
        $this->message = $_message;
    }
    
    public function getTypeReported() {
        return $this->typeReported;
    }
    
    public function setTypeReported($_typeReported) {
        $this->typeReported = EReportingObject::getValueEnum($_typeReported);
    }
    
    public function getIDReported() {
        return $this->idReported;
    }
    
    public function setIDReported($_idReported) {
        $this->idReported = $_idReported;
    }
}
