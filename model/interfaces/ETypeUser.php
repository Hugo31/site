<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/EBasicEnum.php");
abstract class ETypeUser extends EBasicEnum {
    const Classic = 0;
    const Admin = 1;
}
?>