<?php
require_once($_SERVER['DOCUMENT_ROOT']."/model/EBasicEnum.php");
abstract class ETarget extends EBasicEnum {
    const Designer = 0;
    const Evaluator = 1;
}
?>