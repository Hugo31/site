<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/EBasicEnum.php");
abstract class ETarget extends EBasicEnum {
    const Classic = 0;
    const Admin = 1;
}
?>