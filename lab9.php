<?php

function divisibleBy5($num) {
    return $num % 5 == 0;
}

$num = 25;

var_dump(divisibleBy5($num));

?>