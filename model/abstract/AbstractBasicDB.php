<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractBasicDB
 *
 * @author loic
 */
abstract class AbstractBasicDB{
    private $identifiant;
    private $name;
    
    public function __construct($_id, $_name) {
        $this->setID($_id);
        $this->setName($_name);
    }
    
    public function getFromDB($donnees) {
        $this->setID($donnees["id"]);
        $this->setName($donnees['name']);
    }
    
    public function getID() {
        return $this->identifiant;
    }

    public function setID($_id) {
        $this->identifiant = $_id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($_name) {
        $this->name = $_name;
    }
}
