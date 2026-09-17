<?php
$errors = [];
$data = [
    'name' => '', 'address' => '', 'username' => '', 'email' => '',
    'website' => '', 'phone' => '', 'gender' => '', 'course' => ''
];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['name']     = trim($_POST['name'] ?? '');
    $data['address']  = trim($_POST['address'] ?? '');
    $data['username'] = trim($_POST['username'] ?? '');
    $data['email']    = trim($_POST['email'] ?? '');
    $password         = trim($_POST['password'] ?? '');
    $data['website']  = trim($_POST['website'] ?? '');
    $data['phone']    = trim($_POST['phone'] ?? '');
    $data['gender']   = trim($_POST['gender'] ?? '');
    $data['course']   = trim($_POST['course'] ?? '');

    // Name: only letters and spaces
    if ($data['name'] === '' || !preg_match('/^[a-zA-Z ]+$/', $data['name'])) {
        $errors['name'] = "Name must contain only letters and spaces, and cannot be empty.";
    }

    // Address: not empty
    if ($data['address'] === '') {
        $errors['address'] = "Address cannot be empty.";
    }

    // Username: letters, numbers, underscore only
    if ($data['username'] === '' || !preg_match('/^[a-zA-Z0-9_]+$/', $data['username'])) {
        $errors['username'] = "Username can only contain letters, numbers, and underscore.";
    }

    // Email: valid format
    if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Password: 8+ chars, upper, lower, digit, special char
    $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if ($password === '' || !preg_match($passwordPattern, $password)) {
        $errors['password'] = "Password must be 8+ characters with uppercase, lowercase, digit, and special character.";
    }

    // Website: valid URL (must include http:// or https://)
    if ($data['website'] === '' || !filter_var($data['website'], FILTER_VALIDATE_URL)) {
        $errors['website'] = "Invalid website URL. Include http:// or https://";
    }

    // Phone: 10 digits, starts with 96, 97, or 98
    if (!preg_match('/^(96|97|98)\d{8}$/', $data['phone'])) {
        $errors['phone'] = "Phone must be 10 digits and start with 96, 97, or 98.";
    }

    // Gender: must be selected
    if (!in_array($data['gender'], ['male', 'female', 'other'])) {
        $errors['gender'] = "Please select a gender.";
    }

    // Course: must be a valid option
    $validCourses = ['BCA', 'BIT', 'BSc.CSIT'];
    if (!in_array($data['course'], $validCourses)) {
        $errors['course'] = "Please select a valid course.";
    }

    if (empty($errors)) {
        $success = true;
    }
}

// Helper to keep dropdown selection after submit
function isSelected(string $current, string $value): string {
    return $current === $value ? 'selected' : '';
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: sans-serif; }
    .error { color: red; font-size: 0.9em; }
    .success { color: green; font-weight: bold; }
    label { display: inline-block; width: 90px; }
</style>
</head>
<body>

<h2>Registration Form</h2>

<?php if ($success): ?>
    <p class="success">Registration successful! All fields are valid.</p>
<?php endif; ?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>"><br>
    <span class="error"><?= $errors['name'] ?? '' ?></span><br><br>

    <label>Address:</label>
    <input type="text" name="address" value="<?= htmlspecialchars($data['address']) ?>"><br>
    <span class="error"><?= $errors['address'] ?? '' ?></span><br><br>

    <label>Username:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($data['username']) ?>"><br>
    <span class="error"><?= $errors['username'] ?? '' ?></span><br><br>

    <label>Email:</label>
    <input type="text" name="email" value="<?= htmlspecialchars($data['email']) ?>"><br>
    <span class="error"><?= $errors['email'] ?? '' ?></span><br><br>

    <label>Password:</label>
    <input type="password" name="password"><br>
    <span class="error"><?= $errors['password'] ?? '' ?></span><br><br>

    <label>Website:</label>
    <input type="text" name="website" value="<?= htmlspecialchars($data['website']) ?>" placeholder="https://example.com"><br>
    <span class="error"><?= $errors['website'] ?? '' ?></span><br><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>"><br>
    <span class="error"><?= $errors['phone'] ?? '' ?></span><br><br>

    <label>Gender:</label>
    <select name="gender">
        <option value="">--Select--</option>
        <option value="male" <?= isSelected($data['gender'], 'male') ?>>Male</option>
        <option value="female" <?= isSelected($data['gender'], 'female') ?>>Female</option>
        <option value="other" <?= isSelected($data['gender'], 'other') ?>>Other</option>
    </select>
    <span class="error"><?= $errors['gender'] ?? '' ?></span><br><br>

    <label>Course:</label>
    <select name="course">
        <option value="">--Select--</option>
        <option value="BCA" <?= isSelected($data['course'], 'BCA') ?>>BCA</option>
        <option value="BIT" <?= isSelected($data['course'], 'BIT') ?>>BIT</option>
        <option value="BSc.CSIT" <?= isSelected($data['course'], 'BSc.CSIT') ?>>BSc.CSIT</option>
    </select>
    <span class="error"><?= $errors['course'] ?? '' ?></span><br><br>

    <button type="submit">Register</button>
</form>

</body>
</html>