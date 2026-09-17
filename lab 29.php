<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $phone = $_POST["phone"];

    if (strlen($username) < 8) {
        $message = "Username must be at least 8 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    } elseif (empty($dob)) {
        $message = "Date of birth is required.";
    } elseif (strlen($phone) != 10) {
        $message = "Phone number must be 10 digits.";
    } else {
        $message = "User registered successfully.";
    }
}

?>

<form method="post">

    Username:
    <input type="text" name="username"><br><br>

    Email:
    <input type="text" name="email"><br><br>

    Date of Birth:
    <input type="date" name="dob"><br><br>

    Phone:
    <input type="text" name="phone"><br><br>

    <input type="submit" value="Register">

</form>

<p><?php echo $message; ?></p>