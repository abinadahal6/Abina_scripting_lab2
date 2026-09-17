<?php

function compareLength($str1, $str2) {
    return strlen($str1) == strlen($str2);
}

$str1 = "Hello";
$str2 = "World";

var_dump(compareLength($str1, $str2));

?>