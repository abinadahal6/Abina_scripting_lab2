<?php
// crud.php
$conn = mysqli_connect("localhost", "root", "", "abina_scripting_lab_2_q30");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$action = $_GET['action'] ?? 'list';

// DELETE
if ($action === 'delete' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    mysqli_query($conn, "DELETE FROM records WHERE id=$id");
    header("Location: crud.php");
    exit;
}

// SAVE (Insert or Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name'] ?? '');
    $rank   = trim($_POST['rank'] ?? '');
    $status = trim($_POST['status'] ?? '');
    $image  = trim($_POST['image'] ?? '');
    $user   = "admin"; // sample logged-in user

    $errors = [];
    if ($name === '') $errors[] = "Name is required.";
    if ($rank === '') $errors[] = "Rank is required.";
    if ($status === '') $errors[] = "Status is required.";

    if (empty($errors)) {
        $name   = mysqli_real_escape_string($conn, $name);
        $rank   = mysqli_real_escape_string($conn, $rank);
        $status = mysqli_real_escape_string($conn, $status);
        $image  = mysqli_real_escape_string($conn, $image);

        if (!empty($_POST['id'])) {
            $id = (int) $_POST['id'];
            mysqli_query($conn, "UPDATE records SET name='$name', rank_no='$rank',
                status='$status', image='$image', updated_by='$user', updated_at=NOW()
                WHERE id=$id");
        } else {
            mysqli_query($conn, "INSERT INTO records (name, rank_no, status, image,
                created_by, updated_by, created_at, updated_at)
                VALUES ('$name','$rank','$status','$image','$user','$user',NOW(),NOW())");
        }
        header("Location: crud.php");
        exit;
    }
}

// Load record for editing
$editRow = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM records WHERE id=$id");
    $editRow = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Employee Records</h2>

<?php if (!empty($errors)): ?>
    <p style="color:red"><?= implode("<br>", $errors) ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="id" value="<?= $editRow['id'] ?? '' ?>">
    Name: <input type="text" name="name" value="<?= $editRow['name'] ?? '' ?>"><br>
    Rank: <input type="text" name="rank" value="<?= $editRow['rank_no'] ?? '' ?>"><br>
    Status: <input type="text" name="status" value="<?= $editRow['status'] ?? '' ?>"><br>
    Image: <input type="text" name="image" value="<?= $editRow['image'] ?? '' ?>"><br>
    <button type="submit">Save</button>
</form>

<table border="1" cellpadding="6">
<tr><th>ID</th><th>Name</th><th>Rank</th><th>Status</th><th>Image</th><th>Created At</th><th>Action</th></tr>
<?php
$result = mysqli_query($conn, "SELECT * FROM records");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['rank_no']}</td>
        <td>{$row['status']}</td>
        <td>{$row['image']}</td>
        <td>{$row['created_at']}</td>
        <td><a href='crud.php?action=edit&id={$row['id']}'>Edit</a> |
            <a href='crud.php?action=delete&id={$row['id']}'>Delete</a></td>
    </tr>";
}
?>
</table>
</body>
</html>