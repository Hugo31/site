<?php

$cdtCat = array();
$cdtCpt = array();
$cdtPrt = array();
$cdtPlt = array();
$cdtSys = array();

$requete = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what FROM DesignPattern dp";
$cond = "";
if(isset($_POST['idCategory'])){
    $var = explode("|", $_POST['idCategory']);
    if(count($var) > 0){
        $requete .= ", CategoryDesignPattern cdp";
        $cond .= "(dp.idDesignPattern = cdp.idDesignPattern AND (";
        for ($i = 0; $i < count($var); $i++) {
            $cond .= "cdp.idCategory = ".$var[$i]." ";
            if($i < count($var) - 1){
                $cond .= "OR ";
            }
        }
        $cond .= "))";
    }
}

if(isset($_POST['idComponent'])){
    $var = explode("|", $_POST['idComponent']);
    if(count($var) > 0){
        if($cond != ""){
            $cond .= " AND ";
        }
        for($i = 0; $i < count($var); $i++){
            $requete .= ", ComponentDesignPattern cpdp".$i."";
            $cond .= "(cpdp".$i.".idComponent = ".$var[$i]." AND dp.idDesignPattern = cpdp".$i.".idDesignPattern) ";
            if($i < count($var) - 1){
                $cond .= "AND";
            }
        }
    }
    
}

if(isset($_POST['idPlatform'])){
    $var = explode("|", $_POST['idPlatform']);
    if(count($var) > 0){
        if($cond != ""){
            $cond .= " AND ";
        }
        $requete .= ", PlatformDesignPattern plt";
        $cond .= "(dp.idDesignPattern = plt.idDesignPattern AND (";
        for($i = 0; $i < count($cdtPlt); $i++){
            $cond .= "(plt.idPlatform = ".$var[$i]." ";
            if($i < count($var) - 1){
                $cond .= "OR ";
            }
        }
        $cond .= "))";
    }    
}


if(isset($_POST['idProperty'])){
    $var = explode("|", $_POST['idProperty']);
    if(count($var) > 0){
        if($cond != ""){
            $cond .= " AND ";
        }
        for($i = 0; $i < count($var); $i++){
            $requete .= ", PropertyDesignPattern prt".$i."";
            $cond .= "(prt".$i.".idProperty = ".$var[$i]." AND dp.idDesignPattern = prt".$i.".idDesignPattern) ";
            if($i < count($var) - 1){
                $cond .= "AND";
            }
        }
    }
}

if(isset($_POST['idSystem'])){
    $var = explode("|", $_POST['idSystem']);
    if(count($var) > 0){
        $requete .= ", SystemDesignPattern sys";
        if($cond != ""){
            $cond .= " AND ";
        }
        $cond .= "(dp.idDesignPattern = sys.idDesignPattern AND (";
        for($i = 0; $i < count($var); $i++){
            $cond .= "(sys.idSystem = ".$var[$i]." ";
            if($i < count($var) - 1){
                $requete .= "OR ";
            }
        }
        $requete .= "))";
    }
}

$requete .= " WHERE ";
$requete .= $cond;

//Category : OU, Component : ET, System : OU, platform : OU, property : ET

echo $requete;
?>