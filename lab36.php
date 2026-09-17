<?php
function calculateTax(float $income): array {
    $slabs = [
        ['limit' => 1000000, 'rate' => 0.01],
        ['limit' => 500000,  'rate' => 0.10],
        ['limit' => 1000000, 'rate' => 0.20],
        ['limit' => 1500000, 'rate' => 0.27],
        ['limit' => INF,     'rate' => 0.29],
    ];

    $remaining = $income;
    $breakdown = [];

    foreach ($slabs as $slab) {
        if ($remaining <= 0) {
            $breakdown[] = 0;
            continue;
        }
        $taxableInSlab = min($remaining, $slab['limit']);
        $breakdown[] = $taxableInSlab * $slab['rate'];
        $remaining -= $taxableInSlab;
    }

    return $breakdown;
}

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = (float) $_POST['income'];
    $gender = $_POST['gender'];

    $breakdown = calculateTax($income);
    $totalTax = array_sum($breakdown);

    if ($gender === 'female') {
        $totalTax = $totalTax * 0.90; // 10% discount
    }

    $netIncome = $income - $totalTax;
    $result = compact('income', 'gender', 'breakdown', 'totalTax', 'netIncome');
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Nepal Income Tax Calculator (FY 2083/84)</h2>
<form method="post">
    Annual Taxable Income: <input type="number" name="income" step="0.01" required><br>
    Gender:
    <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br>
    <button type="submit">Calculate</button>
</form>

<?php if ($result): ?>
    <h3>Result</h3>
    <p>Annual Taxable Income: <?= number_format($result['income'], 2) ?></p>
    <table border="1" cellpadding="6">
        <tr><th>Slab</th><th>Tax Amount</th></tr>
        <?php
        $labels = ["Up to 1,000,000 @1%", "Next 500,000 @10%", "Next 1,000,000 @20%",
                   "Next 1,500,000 @27%", "Above 4,000,000 @29%"];
        foreach ($result['breakdown'] as $i => $tax) {
            echo "<tr><td>{$labels[$i]}</td><td>" . number_format($tax, 2) . "</td></tr>";
        }
        ?>
    </table>
    <p>Total Tax Payable: <?= number_format($result['totalTax'], 2) ?>
       <?= $result['gender'] === 'female' ? '(10% female discount applied)' : '' ?></p>
    <p>Net Income After Tax: <?= number_format($result['netIncome'], 2) ?></p>
<?php endif; ?>
</body>
</html>