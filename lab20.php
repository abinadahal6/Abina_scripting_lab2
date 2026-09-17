<?php

function addFirstThree($str) {
    $first = substr($str, 0, 3);

    return $first . $str . $first;
}

echo addFirstThree("Python") . "<br>";
echo addFirstThree("JS") . "<br>";
echo addFirstThree("Code");

?>