<?php

function carsNeeded($people) {
    return ceil($people / 5);
}

$people = 12;

echo "Cars Needed = " . carsNeeded($people);

?>