<?php

require_once($_SERVER['DOCUMENT_ROOT']."/site/model/interfaces/EBasicEnum.php");
class EReportingObject extends EBasicEnum {
    const Conflict = 0;
    const DesignPattern = 1;
    const Solution = 2;
    const CommentConflict = 3;
    const CommentDesignPattern = 4;
    const CommentSolution = 5;
}
