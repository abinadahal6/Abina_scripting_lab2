<?php

function getValue($array, $index) {
    return $array[$index];
}

$subjects = ["PHP", "Java", "HTML", "CSS"];

echo "Value = " . getValue($subjects, 2);

?>