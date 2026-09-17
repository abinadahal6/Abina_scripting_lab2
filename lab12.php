<?php

function findIndex($array, $string) {
    return array_search($string, $array);
}

$subjects = ["PHP", "Java", "HTML", "CSS"];

echo "Index = " . findIndex($subjects, "HTML");

?>