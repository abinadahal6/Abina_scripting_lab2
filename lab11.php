<?php

function area($base, $height, $shape) {
    if ($shape == "triangle") {
        return 0.5 * $base * $height;
    } else {
        return $base * $height;
    }
}

echo "Triangle Area = " . area(10.5, 6.5, "triangle");

?>