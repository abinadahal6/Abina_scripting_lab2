<?php

function addLastChar($str) {
    $last = $str[strlen($str) - 1];

    return $last . $str . $last;
}

echo addLastChar("Red") . "<br>";
echo addLastChar("Green") . "<br>";
echo addLastChar("1");

?>