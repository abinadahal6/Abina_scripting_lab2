<?php

function difference($n) {
    $diff = abs($n - 51);

    if ($n > 51) {
        return $diff * 3;
    }

    return $diff;
}

$n = 60;

echo "Result = " . difference($n);

?>