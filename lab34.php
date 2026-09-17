<?php
$si = null;
$amount = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $principal = (float) $_POST['principal'];
    $rate = (float) $_POST['rate'];
    $time = (float) $_POST['time'];

    if ($principal <= 0 || $rate <= 0 || $time <= 0) {
        $error = "All values must be positive numbers.";
    } else {
        $si = ($principal * $rate * $time) / 100;
        $amount = $principal + $si;
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Simple Interest Calculator</h2>
<form method="post">
    Principal: <input type="number" name="principal" step="0.01" required><br>
    Rate (%): <input type="number" name="rate" step="0.01" required><br>
    Time (years): <input type="number" name="time" step="0.01" required><br>
    <button type="submit">Calculate</button>
</form>

<?php if ($error): ?>
    <p style="color:red"><?= $error ?></p>
<?php elseif ($si !== null): ?>
    <p>Simple Interest: <?= number_format($si, 2) ?></p>
    <p>Total Amount: <?= number_format($amount, 2) ?></p>
<?php endif; ?>
</body>
</html>