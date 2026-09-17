<?php

session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "admin" && $password == "1234") {

        $_SESSION["username"] = $username;

        setcookie("username", $username, time() + 3600);

        $message = "Login Successful";
    } else {
        $message = "Invalid Username or Password";
    }
}

?>

<form method="post">
    Username:
    <input type="text" name="username"><br><br>

    Password:
    <input type="password" name="password"><br><br>

    <input type="submit" value="Login">
</form>

<p><?php echo $message; ?></p>