<?php
//header("Location: ../index.php");
$requete = "SELECT DISTINCT dp.idDesignPattern, dp.name, dp.what FROM DesignPattern dp";
$cond = "";
if (isset($_POST['idCategory'])) {
    $var = explode("|", $_POST['idCategory']);
    if (count($var) > 0 && $var[0] != "") {
        $requete .= ", CategoryDesignPattern cdp";
        $cond .= "(dp.idDesignPattern = cdp.idDesignPattern AND (";
        for ($i = 0; $i < count($var) - 1; $i++) {
            $cond .= "cdp.idCategory = ".$var[$i]." ";
            $cond .= "OR ";
        }
        $cond .= "cdp.idCategory = ".$var[$i]." ";
        $cond .= "))";
    }
}

if (isset($_POST['idComponent'])) {
    $var = explode("|", $_POST['idComponent']);
    if (count($var) > 0 && $var[0] != "") {
        if ($cond != "") {
            $cond .= " AND ";
        }
        for ($i = 0; $i < count($var) - 1; $i++) {
            $requete .= ", ComponentDesignPattern cpdp".$i."";
            $cond .= "(cpdp".$i.".idComponent = ".$var[$i]." AND dp.idDesignPattern = cpdp".$i.".idDesignPattern) ";
            $cond .= "AND";
        }
        $requete .= ", ComponentDesignPattern cpdp".$i."";
        $cond .= "(cpdp".$i.".idComponent = ".$var[$i]." AND dp.idDesignPattern = cpdp".$i.".idDesignPattern) ";
            
    }
    
}

if (isset($_POST['idPlatform'])) {
    $var = explode("|", $_POST['idPlatform']);
    if (count($var) > 0 && $var[0] != "") {
        if ($cond != "") {
            $cond .= " AND ";
        }
        $requete .= ", PlatformDesignPattern plt";
        $cond .= "(dp.idDesignPattern = plt.idDesignPattern AND (";
        for ($i = 0; $i < count($var) - 1; $i++) {
            $cond .= "(plt.idPlatform = ".$var[$i]." ";
            $cond .= "OR ";
        }
        $cond .= "(plt.idPlatform = ".$var[$i]." ";
        $cond .= "))";
    }    
}


if (isset($_POST['idProperty'])) {
    $var = explode("|", $_POST['idProperty']);
    if (count($var) > 0 && $var[0] != "") {
        if ($cond != "") {
            $cond .= " AND ";
        }
        for ($i = 0; $i < count($var) - 1; $i++) {
            $requete .= ", PropertyDesignPattern prt".$i."";
            $cond .= "(prt".$i.".idProperty = ".$var[$i]." AND dp.idDesignPattern = prt".$i.".idDesignPattern) ";
            $cond .= "AND";
        }
        $requete .= ", PropertyDesignPattern prt".$i."";
        $cond .= "(prt".$i.".idProperty = ".$var[$i]." AND dp.idDesignPattern = prt".$i.".idDesignPattern) ";
    }
}

if (isset($_POST['idSystem'])) {
    $var = explode("|", $_POST['idSystem']);
    if (count($var) > 0 && $var[0] != "") {
        $requete .= ", SystemDesignPattern sys";
        if ($cond != "") {
            $cond .= " AND ";
        }
        $cond .= "(dp.idDesignPattern = sys.idDesignPattern AND (";
        for ($i = 0; $i < count($var); $i++) {
            $cond .= "(sys.idSystem = ".$var[$i]." ";
            $cond .= "OR ";
        }
        $cond .= "(sys.idSystem = ".$var[$i]." ";
        $cond .= "))";
    }
}

$requete .= " WHERE target = \"".$_POST['target']. "\" AND ";
$requete .= $cond;

//Category : OU, Component : ET, System : OU, platform : OU, property : ET

echo $requete;
?>