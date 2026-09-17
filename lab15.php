<?php

function calculateSum($a, $b) {
    if ($a == $b) {
        return 3 * ($a + $b);
    }

    return $a + $b;
}

echo "Result = " . calculateSum(10, 10);

?>