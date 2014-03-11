<?php
require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/EBasicEnum.php");
abstract class ETarget extends EBasicEnum {
    const Designer = 0;
    const Evaluator = 1;
}
?>