<?php

function upperLastThree($str) {
    if (strlen($str) < 3) {
        return strtoupper($str);
    }

    return substr($str, 0, -3) . strtoupper(substr($str, -3));
}

echo upperLastThree("Nepal") . "<br>";
echo upperLastThree("Npl") . "<br>";
echo upperLastThree("Bca") . "<br>";
echo upperLastThree("Bachelor");

?>