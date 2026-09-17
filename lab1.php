<?php

$name = "Ram";
$age = 20;
$price = 99.50;
$passed = true;
$subjects = ["PHP", "Java", "HTML"];

echo "Name: $name<br>";
print "Age: $age<br>";
echo "Price: $price<br>";
print "Passed: $passed<br>";

echo "Array using print_r:<br>";
print_r($subjects);

echo "<br>Array using var_dump:<br>";
var_dump($subjects);

echo "<br><br>";
var_dump(is_string($name));
var_dump(is_int($age));
var_dump(is_float($price));

?>