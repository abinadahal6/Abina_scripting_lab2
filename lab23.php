<?php

$info = [
    'name' => 'Ram Bahadur',
    'address' => 'Lalitpur',
    'email' => 'info@ram.com',
    'phone' => 98454545,
    'website' => 'www.ram.com'
];

echo "<table border='1'>";
echo "<tr><th>Name</th><th>Value</th></tr>";

foreach ($info as $key => $value) {
    echo "<tr>";
    echo "<td>" . ucfirst($key) . "</td>";
    echo "<td>" . $value . "</td>";
    echo "</tr>";
}

echo "</table>";

?>