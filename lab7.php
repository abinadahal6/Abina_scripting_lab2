<!DOCTYPE html>
<html>
<body>

<form method="post">
    Wins: <input type="number" name="wins" min="0"><br><br>
    Draws: <input type="number" name="draws" min="0"><br><br>
    Losses: <input type="number" name="losses" min="0"><br><br>
    <input type="submit" value="Calculate">
</form>

<?php

function calculatePoints($wins, $draws, $losses) {
    return ($wins * 3) + ($draws * 1);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $wins = $_POST["wins"];
    $draws = $_POST["draws"];
    $losses = $_POST["losses"];

    if ($wins < 0 || $draws < 0 || $losses < 0) {
        echo "Invalid input";
    } else {
        $games = $wins + $draws + $losses;
        $points = calculatePoints($wins, $draws, $losses);

        echo "Total Games = $games<br>";
        echo "Total Points = $points";
    }
}

?>

</body>
</html>