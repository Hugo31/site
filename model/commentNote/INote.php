<?php

interface INote {
    public static function addNote($object, $user, $note);
    
    public static function removeNote($object, $user);
}

?>
