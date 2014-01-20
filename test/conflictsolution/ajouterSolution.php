<?php
    header('Location: ../pagetestsolution.php');
    require_once($_SERVER['DOCUMENT_ROOT']."site/model/conflictSolution/Solution.php");
    if(isset($_POST['comment']) and isset($_POST['code']) and isset($_POST['user'])){
        $sol = new Solution(0, $_POST['comment'], $_POST['code'], NOW(), 0, $_POST['user']);
        Solution::addDB($sol);
    }
?>