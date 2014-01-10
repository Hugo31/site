<?php

abstract class SortTable{
    private $idSortTable;
    private $name;
    private $description;
    
    public function __construct($_idSort, $_name, $_description = ""){
        $this->idSortTable = $_idSort;
        $this->name = $_name;
        $this->description = $_description;
    }
    
    public function getID(){
        return $this->idSortTable;
    }

    public function setID($_id) {
        $this->idSortTable = $_id;
    }
    
    public function getName(){
        return $this->name;
    }

    public function setName($_name) {
        $this->name = $_name;
    }
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($_description) {
        $this->description = $_description;
    }
}
