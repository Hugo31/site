<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/sortTable/category/Category.php");
$cat = new Category(0, $_POST['nom'], $_POST['description']);
echo Category::addDB($cat);

?>
