<?php

function minutesToSeconds($minutes) {
    return $minutes * 60;
}

$minutes = 5;

echo "Minutes = $minutes<br>";
echo "Seconds = " . minutesToSeconds($minutes);

?>