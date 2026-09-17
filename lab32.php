<?php
function calculateGrade(float $percentage): string {
    return match(true) {
        $percentage >= 90 => 'A+',
        $percentage >= 80 => 'A',
        $percentage >= 70 => 'B+',
        $percentage >= 60 => 'B',
        $percentage >= 50 => 'C',
        default => 'F',
    };
}

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $roll = trim($_POST['roll']);
    $eng = (int) $_POST['eng'];
    $math = (int) $_POST['math'];
    $sci = (int) $_POST['sci'];
    $nep = (int) $_POST['nep'];

    $total = $eng + $math + $sci + $nep;
    $percentage = round(($total / 400) * 100, 2);
    $grade = calculateGrade($percentage);

    $result = compact('name', 'roll', 'eng', 'math', 'sci', 'nep', 'total', 'percentage', 'grade');
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Enter Student Marks</h2>
<form method="post">
    Name: <input type="text" name="name" required><br>
    Roll No: <input type="text" name="roll" required><br>
    English: <input type="number" name="eng" required><br>
    Math: <input type="number" name="math" required><br>
    Science: <input type="number" name="sci" required><br>
    Nepali: <input type="number" name="nep" required><br>
    <button type="submit">Generate Mark Sheet</button>
</form>

<?php if ($result): ?>
    <h2>Mark Sheet</h2>
    <table border="1" cellpadding="6">
        <tr><th>Name</th><td><?= $result['name'] ?></td></tr>
        <tr><th>Roll No</th><td><?= $result['roll'] ?></td></tr>
        <tr><th>English</th><td><?= $result['eng'] ?></td></tr>
        <tr><th>Math</th><td><?= $result['math'] ?></td></tr>
        <tr><th>Science</th><td><?= $result['sci'] ?></td></tr>
        <tr><th>Nepali</th><td><?= $result['nep'] ?></td></tr>
        <tr><th>Total</th><td><?= $result['total'] ?>/400</td></tr>
        <tr><th>Percentage</th><td><?= $result['percentage'] ?>%</td></tr>
        <tr><th>Grade</th><td><?= $result['grade'] ?></td></tr>
    </table>
<?php endif; ?>
</body>
</html>