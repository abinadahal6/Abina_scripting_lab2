<?php
// Multidimensional array holding student marks
$students = [
    ["sn"=>1, "name"=>"Rajesh", "roll"=>25, "webtech"=>56, "dbms"=>89, "eco"=>57, "dsa"=>64, "acc"=>98],
    ["sn"=>2, "name"=>"hari",   "roll"=>5,  "webtech"=>56, "dbms"=>89, "eco"=>57, "dsa"=>64, "acc"=>98],
    ["sn"=>3, "name"=>"Shyam",  "roll"=>6,  "webtech"=>54, "dbms"=>79, "eco"=>57, "dsa"=>69, "acc"=>98],
    ["sn"=>4, "name"=>"Rita",   "roll"=>10, "webtech"=>16, "dbms"=>89, "eco"=>56, "dsa"=>64, "acc"=>98],
    ["sn"=>5, "name"=>"Gita",   "roll"=>4,  "webtech"=>56, "dbms"=>89, "eco"=>57, "dsa"=>69, "acc"=>98],
    ["sn"=>6, "name"=>"Sita",   "roll"=>24, "webtech"=>56, "dbms"=>99, "eco"=>57, "dsa"=>24, "acc"=>98],
    ["sn"=>7, "name"=>"Sita",   "roll"=>24, "webtech"=>56, "dbms"=>99, "eco"=>57, "dsa"=>24, "acc"=>98],
    ["sn"=>8, "name"=>"Sita",   "roll"=>24, "webtech"=>56, "dbms"=>99, "eco"=>57, "dsa"=>24, "acc"=>98],
];

// Passing mark for every subject
const PASS_MARK = 50;

// Calculate total marks for one student
function calculateTotal(array $s): int {
    return $s['webtech'] + $s['dbms'] + $s['eco'] + $s['dsa'] + $s['acc'];
}

// Determine pass/fail: fails if ANY subject is below the passing mark
function calculateResult(array $s): string {
    $subjects = [$s['webtech'], $s['dbms'], $s['eco'], $s['dsa'], $s['acc']];
    foreach ($subjects as $mark) {
        if ($mark < PASS_MARK) return "fail";
    }
    return "pass";
}

// Build header row (shared by both tables)
function printHeader(): void {
    echo "<tr>
        <th>SN</th><th>Name</th><th>Roll</th><th>Web Tech II</th>
        <th>DBMS</th><th>Economics</th><th>DSA</th><th>Account</th>
        <th>Total</th><th>Result</th>
    </tr>";
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
    table { border-collapse: collapse; width: 90%; margin-bottom: 30px; }
    th, td { border: 1px solid #333; padding: 6px 10px; text-align: left; }
    th { background: #eee; }
    .pass-row { background: #4caf50; color: #000; }
    .fail-row { background: #e53935; color: #000; }
    .black-row { background: #000; color: #ccc; }
    .gray-row  { background: #b0b0b0; color: #000; }
    .pass-text { color: #2e7d32; font-weight: bold; }
    .fail-text { color: #e53935; font-weight: bold; }
</style>
</head>
<body>

<h2>Mark Ledger</h2>
<table>
<?php
printHeader();
foreach ($students as $s) {
    $total = calculateTotal($s);
    $result = calculateResult($s);
    $rowClass = $result === 'pass' ? 'pass-row' : 'fail-row';

    echo "<tr class='$rowClass'>
        <td>{$s['sn']}</td><td>{$s['name']}</td><td>{$s['roll']}</td>
        <td>{$s['webtech']}</td><td>{$s['dbms']}</td><td>{$s['eco']}</td>
        <td>{$s['dsa']}</td><td>{$s['acc']}</td>
        <td>$total</td><td>$result</td>
    </tr>";
}
?>
</table>

<h2>Alternate color</h2>
<table>
<?php
printHeader();
foreach ($students as $i => $s) {
    $total = calculateTotal($s);
    $result = calculateResult($s);
    $rowClass = ($i % 2 == 0) ? 'black-row' : 'gray-row';
    $resultClass = $result === 'pass' ? 'pass-text' : 'fail-text';

    echo "<tr class='$rowClass'>
        <td>{$s['sn']}</td><td>{$s['name']}</td><td>{$s['roll']}</td>
        <td>{$s['webtech']}</td><td>{$s['dbms']}</td><td>{$s['eco']}</td>
        <td>{$s['dsa']}</td><td>{$s['acc']}</td>
        <td>$total</td><td class='$resultClass'>$result</td>
    </tr>";
}
?>
</table>

</body>
</html>