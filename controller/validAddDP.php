<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/ToolkitDetails.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/site/controller/toolkit/Session.php");
    $session = Session::getInstance();
    
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/DesignPattern.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/Image.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/designpattern/Source.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/Category.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/Component.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/Platform.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/Property.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/model/implementation/criteria/System.php");
    
    if (isset($_POST['namee']) AND isset($_POST['what']) AND isset($_POST['wah']) AND isset($_POST['layout']) AND isset($_POST['copy']) AND isset($_POST['impl']) AND isset($_POST['thetarget'])) {
        
        $dp = new DesignPattern(-1, $_POST['namee'], $session->login, date("Y-m-d H:i:s"), $_POST['what'], 0, $_POST['thetarget']);
        $dp->setWhenAndHow($_POST['wah']);
        $dp->setLayout($_POST['layout']);
        $dp->setCopy($_POST['copy']);
        $dp->setImplementation($_POST['impl']);
        
        DesignPattern::addDB($dp);
        
        if (isset($_POST['image'])) {foreach ($_POST['image'] as $img) {
            Image::addImage($dp, $img, 'NULL');//todo description
        }}
        if (isset($_POST['source'])) {foreach ($_POST['source'] as $src) {
            Source::addSource($dp, "undefined", $src);//todo ajout auteur
        }}
        if (isset($_POST['CategoryDP'])) {foreach ($_POST['CategoryDP'] as $idcat) {
            $category = new Category($idcat, "", "", "");
            $category->addLink($dp);
        }}
        if (isset($_POST['ComponentDP'])) {foreach ($_POST['ComponentDP'] as $idcompo) {
            $component = new Component($idcompo, "", "", "");
            $component->addLink($dp);
        }}
        if (isset($_POST['PlatformDP'])) {foreach ($_POST['PlatformDP'] as $idplat) {
            $platform = new Platform($idplat, "", "", "");
            $platform->addLink($dp);
        }}
        if (isset($_POST['PropertyDP'])) {foreach ($_POST['PropertyDP'] as $idprop) {
            $property = new Property($idprop, "", "", "");
            $property->addLink($dp);
        }}
        if (isset($_POST['SystemDP'])) {foreach ($_POST['SystemDP'] as $idsyst) {
            $system = new System($idsyst, "", "", "");
            $system->addLink($dp);
        }}
        
        //upload images
        $imagesCount = 0;
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        if ($_FILES['file']['name'] != "") {foreach ($_FILES["file"]["error"] as $key => $error) {
            $temp = explode(".", $_FILES["file"]["name"][$key]);
            $extension = end($temp);
            if ((($_FILES["file"]["type"][$key] == "image/gif")
            || ($_FILES["file"]["type"][$key] == "image/jpeg")
            || ($_FILES["file"]["type"][$key] == "image/jpg")
            || ($_FILES["file"]["type"][$key] == "image/pjpeg")
            || ($_FILES["file"]["type"][$key] == "image/x-png")
            || ($_FILES["file"]["type"][$key] == "image/png"))
            && ($_FILES["file"]["size"][$key] < 20000000)
            && $error == UPLOAD_ERR_OK
            && in_array($extension, $allowedExts)) {
                if ($_FILES["file"]["error"][$key] == 0) {
                    move_uploaded_file($_FILES["file"]["tmp_name"][$key], "../img/designPattern/imgDP" . $dp->getID() . "NB" . $imagesCount . "." . pathinfo($_FILES["file"]["name"][$key], PATHINFO_EXTENSION));
                    Image::addImage($dp, "/site/img/designPattern/imgDP" . $dp->getID() . "NB" . $imagesCount . "." . pathinfo($_FILES["file"]["name"][$key], PATHINFO_EXTENSION), 'NULL');//todo description
                    $imagesCount+=1;
                }
            }
        }}
        
        header('Location: /site/view/details.php?type=DesignPattern&id=' . $dp->getID());
    } else {
        echo '<h3>Error</h3>';
    }
    
    
    
    //on renvoi vers la page du nouveau DP
    //TODO: ajout notification ajout OK
    

