<?php
// courses_students.php
$conn = mysqli_connect("localhost", "root", "", "abina_scripting_lab_2_q31");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$action = $_GET['action'] ?? '';

// Delete course or student
if ($action === 'delete_course' && isset($_GET['id'])) {
    mysqli_query($conn, "DELETE FROM courses WHERE id=" . (int)$_GET['id']);
    header("Location: courses_students.php"); exit;
}
if ($action === 'delete_student' && isset($_GET['id'])) {
    mysqli_query($conn, "DELETE FROM students WHERE id=" . (int)$_GET['id']);
    header("Location: courses_students.php"); exit;
}

// Add course
if (isset($_POST['add_course'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    mysqli_query($conn, "INSERT INTO courses (title, duration, status, created_at, updated_at)
        VALUES ('$title','$duration','active',NOW(),NOW())");
    header("Location: courses_students.php"); exit;
}

// Add student
if (isset($_POST['add_student'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $course_id = (int) $_POST['course_id'];
    $fee = (float) $_POST['fee'];
    $rollno = mysqli_real_escape_string($conn, $_POST['rollno']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);

    mysqli_query($conn, "INSERT INTO students
        (name, course_id, fee, rollno, phone, address, dob, status, created_at, updated_at)
        VALUES ('$name',$course_id,$fee,'$rollno','$phone','$address','$dob','active',NOW(),NOW())");
    header("Location: courses_students.php"); exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Courses</h2>
<form method="post">
    Title: <input type="text" name="title" required>
    Duration: <input type="text" name="duration" required>
    <button type="submit" name="add_course">Add Course</button>
</form>

<table border="1" cellpadding="6">
<tr><th>ID</th><th>Title</th><th>Duration</th><th>Action</th></tr>
<?php
$courses = mysqli_query($conn, "SELECT * FROM courses");
while ($c = mysqli_fetch_assoc($courses)) {
    echo "<tr><td>{$c['id']}</td><td>{$c['title']}</td><td>{$c['duration']}</td>
        <td><a href='courses_students.php?action=delete_course&id={$c['id']}'>Delete</a></td></tr>";
}
?>
</table>

<h2>Students</h2>
<form method="post">
    Name: <input type="text" name="name" required>
    Course:
    <select name="course_id">
        <?php
        $courseList = mysqli_query($conn, "SELECT * FROM courses");
        while ($c = mysqli_fetch_assoc($courseList)) {
            echo "<option value='{$c['id']}'>{$c['title']}</option>";
        }
        ?>
    </select>
    Fee: <input type="number" name="fee" required>
    Roll No: <input type="text" name="rollno" required>
    Phone: <input type="text" name="phone" required>
    Address: <input type="text" name="address" required>
    DOB: <input type="date" name="dob" required>
    <button type="submit" name="add_student">Add Student</button>
</form>

<table border="1" cellpadding="6">
<tr><th>ID</th><th>Name</th><th>Course</th><th>Fee</th><th>Roll No</th><th>Action</th></tr>
<?php
$students = mysqli_query($conn, "SELECT s.*, c.title FROM students s
    LEFT JOIN courses c ON s.course_id = c.id");
while ($s = mysqli_fetch_assoc($students)) {
    echo "<tr><td>{$s['id']}</td><td>{$s['name']}</td><td>{$s['title']}</td>
        <td>{$s['fee']}</td><td>{$s['rollno']}</td>
        <td><a href='courses_students.php?action=delete_student&id={$s['id']}'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html>