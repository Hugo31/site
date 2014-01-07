<?php
require_once($_SERVER['DOCUMENT_ROOT']."/model/EBasicEnum.php");
abstract class ESortTable extends EBasicEnum {
    const CATEGORY = 0;
    const PROPERTY = 1;
    const COMPONENT = 2;
    const PLATFORM = 3;
    const SYSTEM = 4;
}
?>