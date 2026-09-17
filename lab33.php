<?php
$sent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } else {
        $headers = "From: noreply@example.com\r\n";
        $sent = mail($to, $subject, $message, $headers);
        if (!$sent) {
            $error = "Mail could not be sent. Check server mail configuration.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Send Email Notification</h2>
<form method="post">
    To Email: <input type="email" name="email" required><br>
    Subject: <input type="text" name="subject" required><br>
    Message: <textarea name="message" required></textarea><br>
    <button type="submit">Send</button>
</form>

<?php if ($sent): ?>
    <p style="color:green">Email sent successfully to <?= htmlspecialchars($to) ?>.</p>
<?php elseif ($error): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>
</body>
</html>