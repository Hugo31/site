<?php

interface ILink {
    public static function addLink($tableToSort, $sort);

    public static function removeLink($tableToSort, $sort);
}
