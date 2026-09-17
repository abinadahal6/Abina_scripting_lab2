<?php

function repeatTwo($str) {
    if (strlen($str) < 2) {
        return $str;
    }

    return substr($str, 0, 2) . substr($str, 0, 2) .
           substr($str, 0, 2) . substr($str, 0, 2);
}

echo repeatTwo("C Sharp") . "<br>";
echo repeatTwo("JS") . "<br>";
echo repeatTwo("a");

?>