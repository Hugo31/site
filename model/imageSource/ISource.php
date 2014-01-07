<?php

interface ISource {
    public static function addSource($object, $author, $link);
    
    public static function removeSource($src);
}

?>