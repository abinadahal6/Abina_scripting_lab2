<?php

function ageInDays($age) {
    return $age * 365;
}

$age = 20;

echo "Age = $age years<br>";
echo "Age in days = " . ageInDays($age);

?>