<?php

$table = array();
$cdtCat = array();
$cdtCpt = array();
$cdtPrt = array();
$cdtPlt = array();
$cdtSys = array();
$requete = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what FROM DesignPattern dp";

if(isset($_POST['idCategory'])){
    $var = explode("|", $_POST['idCategory']);
    $i = 0;
    foreach ($var as $elem) {
        $table['cat'.$i] = ", CategoryDesignPattern cdp".$i."";
        $cdtCat[$i] = "(cdp".$i.".idCategory = ".$elem." AND dp.idDesignPattern = cdp".$i.".idDesignPattern) ";
        $i ++;
    }
}

if(isset($_POST['idComponent'])){
    $var = explode("|", $_POST['idComponent']);
    $i = 0;
    foreach ($var as $elem) {
        $table['cpt'.$i] = ", ComponentDesignPattern cpdp".$i."";
        $cdtCpt[$i] = "(cpdp".$i.".idComponent = ".$elem." AND dp.idDesignPattern = cpdp".$i.".idDesignPattern) ";
        $i ++;
    }
}

if(isset($_POST['idPlatform'])){
    $var = explode("|", $_POST['idPlatform']);
    $i = 0;
    foreach ($var as $elem) {
        $table['plt'.$i] = ", PlatformDesignPattern plt".$i."";
        $cdtPlt[$i] = "(plt".$i.".idPlatform = ".$elem." AND dp.idDesignPattern = plt".$i.".idDesignPattern) ";
        $i ++;
    }
}

if(isset($_POST['idProperty'])){
    $var = explode("|", $_POST['idProperty']);
    $i = 0;
    foreach ($var as $elem) {
        $table['prt'.$i] = ", PropertyDesignPattern prt".$i."";
        $cdtPrt[$i] = "(prt".$i.".idProperty = ".$elem." AND dp.idDesignPattern = prt".$i.".idDesignPattern) ";
        $i ++;
    }
}

if(isset($_POST['idSystem'])){
    $var = explode("|", $_POST['idSystem']);
    $i = 0;
    foreach ($var as $elem) {
        $table['sys'.$i] = ", SystemDesignPattern sys".$i."";
        $cdtSys[$i] = "(sys".$i.".idSystem = ".$elem." AND dp.idDesignPattern = sys".$i.".idDesignPattern) ";
        $i ++;
    }
}
foreach($table as $uneT){
    $requete .= $uneT;
}
$requete .= " WHERE ";

if(count($cdtCat) > 0){
    $requete .= "(";
    for($i = 0; $i < count($cdtCat); $i++){
        $requete .= $cdtCat[$i];
        if($i < count($cdtCat) - 1){
            $requete .= "OR";
        }
    }
    $requete .= ")";
}

if(count($cdtCpt) > 0){
    if(count($cdtCat) > 0){
        $requete .= " AND ";
    }
    for($i = 0; $i < count($cdtCpt); $i++){
        $requete .= $cdtCpt[$i];
        if($i < count($cdtCpt) - 1){
            $requete .= "AND";
        }
    }
}

if(count($cdtPlt) > 0){
    if(count($cdtCpt) > 0){
        $requete .= " AND ";
    }else{
        if(count($cdtCat) > 0){
            $requete .= " AND ";
        }
    }
    $requete .= "(";
    for($i = 0; $i < count($cdtPlt); $i++){
        $requete .= $cdtPlt[$i];
        if($i < count($cdtPlt) - 1){
            $requete .= "OR";
        }
    }
    $requete .= ")";
}

if(count($cdtSys) > 0){
    if(count($cdtPlt) > 0){
        $requete .= " AND ";
    }else{
        if(count($cdtCpt) > 0){
            $requete .= " AND ";
        }else{
            if(count($cdtCat) > 0){
                $requete .= " AND ";
            }
        }
    }
    $requete .= "(";
    for($i = 0; $i < count($cdtSys); $i++){
        $requete .= $cdtSys[$i];
        if($i < count($cdtSys) - 1){
            $requete .= "OR";
        }
    }
    $requete .= ")";
}

if(count($cdtPrt) > 0){
    if(count($cdtSys) > 0){
        $requete .= " AND ";
    }else{
        if(count($cdtPlt) > 0){
            $requete .= " AND ";
        }else{
            if(count($cdtCpt) > 0){
                $requete .= " AND ";
            }else{
                if(count($cdtCat) > 0){
                    $requete .= " AND ";
                }
            }
        }
    }
    for($i = 0; $i < count($cdtPrt); $i++){
        $requete .= $cdtPrt[$i];
        if($i < count($cdtPrt) - 1){
            $requete .= "AND";
        }
    }
    
}

//Category : OU, Component : ET, System : OU, platform : OU, property : ET

echo $requete;
?>
